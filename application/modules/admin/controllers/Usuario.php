<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MX_Controller {
    public function __construct(){
        parent::__construct();


        $this->load->model('Tbl_usuario','obj_usuario');    
        $this->load->model('Tbl_tipoDocumento','obj_tipoDocumento');    
        
       
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

    public function nuevoAdministrador(){ 
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required');

        $this->form_validation->set_rules('apellidoPaterno', 'Apellido Paterno', 'trim|required');

        $this->form_validation->set_rules('apellidoMaterno', 'Apellido Materno', 'trim|required');

        $this->form_validation->set_rules('nroDocumento', 'Número de documento', 'trim|required');

        $this->form_validation->set_rules('usuario', 'Correo electrónico', 'trim|required|callback_usuarioNoRepetido',
        array(
            'required' => 'El usuario es requerido',
            'usuarioNoRepetido' => 'Este correo ya está registrado'
        ));

        $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required');

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

        $this->form_validation->set_rules('nroDocumento', 'Número de documento', 'trim|required',
        array(
            'required' => 'El nro de documento es requerido'
        ));

        $this->form_validation->set_rules('usuario', 'Correo electrónico', 'trim|required',
        array(
            'required' => 'El correo electrónico es requerido'
        ));

        $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required',
        array(
            'required' => 'La contraseña es requerida'
        ));
        
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
        
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required');
        $this->form_validation->set_rules('apellidoPaterno', 'Apellido Paterno', 'trim|required');
        $this->form_validation->set_rules('apellidoMaterno', 'Apellido Materno', 'trim|required');
        $this->form_validation->set_rules('idTipoDocumento', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('nroDocumento', 'Número de documento', 'trim|required');
        $this->form_validation->set_rules('usuario', 'Correo electrónico', 'trim|required|callback_usuarioNoRepetido',
        array(
            'required' => 'El usuario es requerido',
            'usuarioNoRepetido' => 'Este correo ya está registrado'
        ));

        $tipoDocumentos = $this->obj_tipoDocumento->get_all();

        $this->tmp_admin->set('error','No se pudo Registrar');
        
        if ($this->form_validation->run($this) == FALSE)
        {   
            $usuario = $this->obj_usuario->get($id);
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
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('usuario/administraNotificacion.php');
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
    
    public function logout(){                     
        $this->session->unset_userdata('logged');
        session_destroy();
        $this->session->sess_destroy();
        redirect('admin');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
 