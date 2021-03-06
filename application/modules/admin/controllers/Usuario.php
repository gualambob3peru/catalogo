<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MX_Controller {
    public function __construct(){
        parent::__construct();


        $this->load->model('Tbl_usuario','obj_usuario');    
        $this->load->model('Tbl_usuario_notificacion','obj_usuario_notificacion');    
        $this->load->model('Tbl_tipoDocumento','obj_tipoDocumento');    
        $this->load->model('Tbl_solicitud','obj_solicitud');    
        $this->load->model('Tbl_producto','obj_producto');    
        $this->load->model('Tbl_repuesto','obj_repuesto');    
        
       
        if($this->session->userdata('logged') != 'true'){
            redirect('login');
        }

        date_default_timezone_set("America/Lima");
    }
	 
	public function index(){ 
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));
        $usuarios = $this->obj_usuario->get_all();
        
        $this->tmp_admin->set('usuarios',$usuarios);
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('usuario/lista.php');
    }

    public function menu(){ 
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));
        $usuarios = $this->obj_usuario->get_all();
        
        $this->tmp_admin->set('usuarios',$usuarios);
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('usuario/menu.php');
    }

    public function nuevoUsuario(){ 
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));
   
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('usuario/nuevoUsuario.php');
    }

    public function usuarioNoRepetido($usuario){
        $usuario = $this->obj_usuario->get_campo("usuario",$usuario);
        if($usuario==NULL)
            return true;
        else 
            return false;
    }

    public function nroDocumentoNoRepetido($nroDocumento){
        $usuario = $this->obj_usuario->get_campo("nroDocumento",$nroDocumento);
        if($usuario==NULL)
            return true;
        else 
            return false;
    }

    public function nuevoAdministrador(){ 
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required');

        $this->form_validation->set_rules('apellidoPaterno', 'Apellido Paterno', 'trim|required');

        $this->form_validation->set_rules('apellidoMaterno', 'Apellido Materno', 'trim|required');

        $this->form_validation->set_rules('nroDocumento', 'Número de documento', 'trim|required|callback_nroDocumentoNoRepetido',
        array(
            'required' => 'El Nro de documento es requerido',
            'nroDocumentoNoRepetido' => 'El Nro de documento ya fue registrado'
        ));

        $this->form_validation->set_rules('usuario', 'Correo electrónico', 'trim|required|callback_usuarioNoRepetido',
        array(
            'required' => 'El usuario es requerido',
            'usuarioNoRepetido' => 'Este correo ya está registrado'
        ));

        $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required|min_length[6]',
        array(
            'required' => 'La contraseña es requerida',
            'min_length' => 'La contraseña debe tener mínimo 6 caracteres'
        ));;

        $tipoDocumentos = $this->obj_tipoDocumento->get_all();

        $this->tmp_admin->set('error','No se pudo Registrar');
        
        if ($this->form_validation->run($this) == FALSE)
        {
            $this->tmp_admin->set('tipoDocumentos',$tipoDocumentos);
            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('usuario/nuevoAdministrador.php');
        }
        else
        {
            
            $dato = array();
            $dato["nombres"] =  $this->input->post('nombres');  
            $dato["apellidoPaterno"] =  $this->input->post('apellidoPaterno');  
            $dato["apellidoMaterno"] =  $this->input->post('apellidoMaterno'); 
            $dato["nombresCompletos"] =  $this->input->post('nombres') . " " . $this->input->post('apellidoPaterno') . " " . $this->input->post('apellidoMaterno');  
            $dato["nroDocumento"] =  $this->input->post('nroDocumento');  
            $dato["usuario"] =  $this->input->post('usuario');  
            $dato["contrasena"] =  md5(helper_get_semilla().$this->input->post('contrasena'));  
            $dato["idTipo_usuario"] =  1;  
            
            
            $id = $this->obj_usuario->insert($dato);
            if($id){
              
                $config = helper_config_upload("static/images/usuario/".$id);

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('miFile')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else{
                    $data = array('upload_data' => $this->upload->data());

                    $newDatos = array();
                    $newDatos["foto"] = $data["upload_data"]["file_name"];
                    $this->obj_usuario->update_campo($newDatos,"id",$id);
                }

                redirect('admin/usuario');
            }else{
                $data['error'] = 'No se pudo Registrar';
                $this->tmp_admin->set('error','No se pudo Registrar');
                $this->load->tmp_admin->setLayout('templates/admin_tmp');
                $this->load->tmp_admin->render('usuario/nuevoAdministrador.php');
            }
        }
    }

    public function nuevoTecnico(){ 
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));

        

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|callback_usuarioNoRepetido',
        array(
            'required' => 'El usuario es requerido',
            'usuarioNoRepetido' => 'Este correo ya está registrado'
        ));

        $this->form_validation->set_rules('apellidoPaterno', 'Apellido Paterno', 'trim|required',
        array(
            'required' => 'El apellido paterno es requerido'
        ));

        $this->form_validation->set_rules('apellidoMaterno', 'Apellido Materno', 'trim|required',
        array(
            'required' => 'El apellido materno es requerido'
        ));

        $this->form_validation->set_rules('nroDocumento', 'Número de documento', 'trim|required|callback_nroDocumentoNoRepetido',
        array(
            'required' => 'El Nro de documento es requerido',
            'nroDocumentoNoRepetido' => 'El Nro de documento ya fue registrado'
        ));

        $this->form_validation->set_rules('usuario', 'Correo electrónico', 'trim|required|callback_usuarioNoRepetido',
        array(
            'required' => 'El usuario es requerido',
            'usuarioNoRepetido' => 'Este correo ya está registrado'
        ));

        $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required|min_length[6]',
        array(
            'required' => 'La contraseña es requerida',
            'min_length' => 'La contraseña debe tener mínimo 6 caracteres'
        ));

        $tipoDocumentos = $this->obj_tipoDocumento->get_all();
        $this->tmp_admin->set('tipoDocumentos',$tipoDocumentos);
        
        if ($this->form_validation->run($this) == FALSE)
        {
            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('usuario/nuevoTecnico.php');
        }
        else
        {
            $dato = array();
            $dato["nombres"] =  $this->input->post('nombres');  
            $dato["apellidoPaterno"] =  $this->input->post('apellidoPaterno');  
            $dato["apellidoMaterno"] =  $this->input->post('apellidoMaterno');  
            $dato["nombresCompletos"] =  $this->input->post('nombres') . " " . $this->input->post('apellidoPaterno') . " " . $this->input->post('apellidoMaterno');  
            $dato["nroDocumento"] =  $this->input->post('nroDocumento');  
            $dato["usuario"] =  $this->input->post('usuario');  
            $dato["contrasena"] =  md5(helper_get_semilla().$this->input->post('contrasena'));  
            $dato["idTipo_usuario"] =  2;  
            

            if($this->obj_usuario->insert($dato)){
                redirect('admin/usuario');
            }else{
                $data['error'] = 'No se pudo Registrar';
                $this->tmp_login->set('error','No se pudo Registrar');
                $this->load->tmp_login->setLayout('templates/admin_tmp');
                $this->load->tmp_admin->render('usuario/nuevoTecnico.php');
            }
        }
    }

    public function editar($id){ 
        //HALLANDO USUARIO/////////////////
        $usuario = $this->obj_usuario->get($id);
        /////////////////////////////////////
        
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required');
        $this->form_validation->set_rules('apellidoPaterno', 'Apellido Paterno', 'trim|required');
        $this->form_validation->set_rules('apellidoMaterno', 'Apellido Materno', 'trim|required');
        $this->form_validation->set_rules('idTipoDocumento', 'Tipo de Documento', 'trim|required');

        if($this->input->post('nroDocumento')!=$usuario->nroDocumento){
            $this->form_validation->set_rules('nroDocumento', 'Número de documento', 'trim|required|callback_nroDocumentoNoRepetido',
            array(
                'required' => 'El Nro de documento es requerido',
                'nroDocumentoNoRepetido' => 'El Nro de documento ya fue registrado'
            ));;
        }


        

        if($this->input->post('contrasena')!=""){
            $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required|min_length[6]',
            array(
                'required' => 'La contraseña es requerida',
                'min_length' => 'La contraseña debe tener mínimo 6 caracteres'
            ));
        }

        if($this->input->post('usuario')!=$usuario->usuario){
            $this->form_validation->set_rules('usuario', 'Correo electrónico', 'trim|required|callback_usuarioNoRepetido', array(
                'required' => 'El usuario es requerido',
                'usuarioNoRepetido' => 'Este correo ya está registrado'
            ));
        }


        $tipoDocumentos = $this->obj_tipoDocumento->get_all();

        $this->tmp_admin->set('error','No se pudo Registrar');
        
        if ($this->form_validation->run($this) == FALSE)
        {   
            
            $this->tmp_admin->set('usuario',$usuario);
            $this->tmp_admin->set('tipoDocumentos',$tipoDocumentos);
            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('usuario/editar.php');
        }
        else
        {
            
            $dato = array();
            $dato["nombres"] =  $this->input->post('nombres');  
            $dato["apellidoPaterno"] =  $this->input->post('apellidoPaterno');  
            $dato["apellidoMaterno"] =  $this->input->post('apellidoMaterno'); 
            $dato["nombresCompletos"] =  $this->input->post('nombres') . " " . $this->input->post('apellidoPaterno') . " " . $this->input->post('apellidoMaterno');  
            $dato["idTipoDocumento"] =  $this->input->post('idTipoDocumento');  
            $dato["nroDocumento"] =  $this->input->post('nroDocumento');  
            $dato["usuario"] =  $this->input->post('usuario');  

            if($this->input->post('contrasena')!="")
                $dato["contrasena"] =  md5(helper_get_semilla().$this->input->post('contrasena'));  
            
            $this->obj_usuario->update($dato,$id);
           
            if($_FILES){

                $config = helper_config_upload("static/images/usuario/".$id);
    
                $this->load->library('upload', $config);
    
                if ( ! $this->upload->do_upload('miFile')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else{
                    $data = array('upload_data' => $this->upload->data());
    
                    $newDatos = array();
                    $newDatos["foto"] = $data["upload_data"]["file_name"];
                    $this->obj_usuario->update_campo($newDatos,"id",$id);
                }
    
                
            }
              
            redirect('admin/usuario');
        }
    }

    

    public function administraNotificacion(){    
        $un_all = $this->obj_usuario_notificacion->get_all();
        $tn = $this->obj_usuario_notificacion->get_all_tn();
        
        
        foreach ($tn as $key => $value) {
            $usuarioun =  $this->obj_usuario_notificacion->get_row_tipo($value->id);
            if($usuarioun==NULL) $usuarioun="";
            else $usuarioun=$usuarioun->email;

            
            $tn[$key]->email = $usuarioun;
        }
    
        $this->tmp_admin->set('tn',$tn);
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('usuario/administraNotificacion.php');
    }

    public function existeCorreoNoti($correo){
        $usuario = $this->obj_usuario_notificacion->get_campo("email",$correo);
        if($usuario==NULL)
            return true;
        else 
            return false;
    }

    public function agregaNoti($tn="1"){   
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_existeCorreoNoti', array(
            'required' => 'El Correo es requerido',
            'existeCorreoNoti' => 'No se puede agregar un correo ya registrado'
        ));

        if ($this->form_validation->run($this) == FALSE)
        {   
            
            
        }
        else
        {
            $data["email"] = $this->input->post("email");
            $data["id_tipo_notificacion"] = $tn;
            $this->obj_usuario_notificacion->insert($data);
        }

        $tipo = $this->obj_usuario_notificacion->get_tn($tn);

        $correos = $this->obj_usuario_notificacion->get_all_tipo($tn);
        

        $this->tmp_admin->set('tipo',$tipo);
        $this->tmp_admin->set('correos',$correos);
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('usuario/agregaNoti.php');
    }

    public function elegirProducto(){ 
        $producto_all = $this->obj_producto->get_all();
     
        
        $this->tmp_admin->set('producto_all',$producto_all);

        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('usuario/elegirProducto.php');
    }

    public function grafica($id_producto){   
        $producto = $this->obj_producto->get($id_producto);
        $imagenes = $this->obj_producto->get_imagen($id_producto);
        
        foreach($imagenes as $key => $value){
            $repuestos = $this->obj_repuesto->get_campo_all("id_imagen",$value->id);
            $imagenes[$key]->repuesto = $repuestos;
        }

     
        $this->tmp_admin->set('producto',$producto);
        $this->tmp_admin->set('imagenes',$imagenes);
        $this->load->tmp_admin->setLayout('templates/grafica_tmp');
        $this->load->tmp_admin->render('usuario/grafica.php');
    }

    public function ajaxAddRepuesto(){   
        if($this->input->is_ajax_request()){
            $data["sku"] = $this->input->post("sku");
            $data["id_imagen"] = $this->input->post("ipi");
            $data["id_producto"] = $this->input->post("id_producto");
            $data["descripcion"] = $this->input->post("descripcion");
            $data["x"] = $this->input->post("x");
            $data["y"] = $this->input->post("y");

            $id_repuesto = $this->insertRepuesto($data);

            if($id_repuesto){
                echo json_encode(array("respuesta" => 1,"id_repuesto" => $id_repuesto));
            }else{
                echo json_encode(array("respuesta" => 0));
            }   
        }  
    }

    public function ajaxUpdateRepuesto(){   
        if($this->input->is_ajax_request()){
            $data["sku"] = $this->input->post("sku");
            $data["descripcion"] = $this->input->post("descripcion");
           


            $num = $this->obj_repuesto->update($data,$this->input->post("id_repuesto"));

            if($num){
                echo json_encode(array("respuesta" => 1));
            }else{
                echo json_encode(array("respuesta" => 0));
            }   
        }  
    }

    public function ajaxRemoveRepuesto(){   
        if($this->input->is_ajax_request()){
            $data["idEstados"] = "0";
      
            $num = $this->obj_repuesto->update($data,$this->input->post("id_repuesto"));

            if($num){
                echo json_encode(array("respuesta" => 1));
            }else{
                echo json_encode(array("respuesta" => 0));
            }   
        }  
    }

    public function insertRepuesto($data){     
        $id_repuesto = $this->obj_repuesto->insert($data);
        if($id_repuesto){
            return $id_repuesto;
        }else{
            return false;
        }
    }

    public function ajaxDelete(){   
        if($this->input->is_ajax_request()){
            $id = $this->input->post("id");

            if($this->deleteUsuario($id)){
                echo json_encode(array("respuesta" => 1));
            }else{
                echo json_encode(array("respuesta" => 0));
            }   
        }  
    }


    public function deleteUsuario($id){     
        $data = array();
        $data["idEstados"] = 0;                
        if($this->obj_usuario->update_campo($data,"id",$id)){
            return true;
        }else{
            return false;
        }
    }

    public function eliminarCorreo($id){   
        $tipo_notificacion = $this->obj_usuario_notificacion->get($id);
        
        $data = array();
        $data["idEstados"] = 0;               
        if($this->obj_usuario_notificacion->update_campo($data,"id",$id)){
            redirect("admin/usuario/agregaNoti/".$tipo_notificacion->id_tipo_notificacion);
        }else{
            redirect("admin/usuario/agregaNoti/".$tipo_notificacion->id_tipo_notificacion);
        }
    }

    public function gestionSolicitud(){   
        if($_POST){
        

            $datosWhere = array();
            $datosLike  = array();

            $fechaInicio =          $this->input->post("fechaInicio");
            $fechaFinal =           $this->input->post("fechaFinal");
            $solicitud =            $this->input->post("solicitud");
            $id_estado_solicitud =  $this->input->post("id_estado_solicitud");
            $tecnico =              $this->input->post("tecnico");
            $cliente =              $this->input->post("cliente");


            if($fechaInicio!="") $datosWhere["s.fechaRegistro >="] = $fechaInicio;
            if($fechaFinal!="") $datosWhere["s.fechaRegistro <="] = $fechaFinal;
            if($solicitud!="") $datosWhere["s.id"] = $solicitud;
            if($id_estado_solicitud!="") $datosWhere["s.id_estado_solicitud"] = $id_estado_solicitud;
            if($tecnico!="") $datosLike["u.nombresCompletos"] = $tecnico;
            if($cliente!="") $datosLike["c.nombresCompletos"] = $cliente;


            $solicitud_all = $this->obj_solicitud->where_like($datosWhere,$datosLike);
            $estado_solicitud_all = $this->obj_solicitud->get_all_estado_solicitud();
           
            
            $this->tmp_admin->set('solicitud_all',$solicitud_all);
            $this->tmp_admin->set('estado_solicitud_all',$estado_solicitud_all);
            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('usuario/gestionSolicitud.php');
        }else{
            $solicitud_all = $this->obj_solicitud->get_all();
            $estado_solicitud_all = $this->obj_solicitud->get_all_estado_solicitud();
            
            
            
            $this->tmp_admin->set('solicitud_all',$solicitud_all);
            $this->tmp_admin->set('estado_solicitud_all',$estado_solicitud_all);
            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('usuario/gestionSolicitud.php');
        }
       

    }

    public function ajaxCambioEstadoSolicitud(){
        if($this->input->is_ajax_request()){
            $id_solicitud = $this->input->post("id_solicitud");
            $datos["id_estado_solicitud"] = $this->input->post("id_estado_solicitud");
            $datos["fechaEstado"] = date("Y-m-d H:i:s");
           
            if($this->obj_solicitud->update($datos,$id_solicitud)){
                echo json_encode(array("respuesta"=>1));
            }else{
                echo json_encode(array("respuesta"=>0));
            }

        }
    }
    
    public function logout(){                     
        $this->session->unset_userdata('logged');
        session_destroy();
        $this->session->sess_destroy();
        redirect('admin');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
 