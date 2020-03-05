<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tecnico extends MX_Controller {
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
        if($_POST){
            $datosWhere = array();
            $datosLike  = array();

            $fechaInicio =          $this->input->post("fechaInicio");
            $fechaFinal =           $this->input->post("fechaFinal");
            $id_estado_solicitud =  $this->input->post("id_estado_solicitud");


            if($fechaInicio!="") $datosWhere["s.fechaRegistro >="] = $fechaInicio;
            if($fechaFinal!="") $datosWhere["s.fechaRegistro <="] = $fechaFinal;
            if($id_estado_solicitud!="") $datosWhere["s.id_estado_solicitud"] = $id_estado_solicitud;



            $solicitud_all = $this->obj_solicitud->where_like($datosWhere,$datosLike);
            $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));
            $usuarios = $this->obj_usuario->get_all();
            $estado_solicitud_all = $this->obj_solicitud->get_all_estado_solicitud();
            
            $this->tmp_admin->set('solicitud_all',$solicitud_all);
            $this->tmp_admin->set('estado_solicitud_all',$estado_solicitud_all);
            
            $this->tmp_admin->set('usuarios',$usuarios);
            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('tecnico/lista.php');
        }else{
            $solicitud_all = $this->obj_solicitud->get_all();
            $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));
            $usuarios = $this->obj_usuario->get_all();
            $estado_solicitud_all = $this->obj_solicitud->get_all_estado_solicitud();
            
            $this->tmp_admin->set('solicitud_all',$solicitud_all);
            $this->tmp_admin->set('estado_solicitud_all',$estado_solicitud_all);

            $this->tmp_admin->set('usuarios',$usuarios);
            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('tecnico/lista.php');
        }

        
    }

    public function elegirProducto(){ 
        $producto_all = $this->obj_producto->get_all();
     
        
        $this->tmp_admin->set('producto_all',$producto_all);

        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('tecnico/elegirProducto.php');
    }

    public function nuevaSolicitud($id=1){
        $this->session->set_userdata("id_producto",$id);
        
        $solicitud_all = $this->obj_solicitud->get_all();
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));
        $usuarios = $this->obj_usuario->get_all();
        
        $this->tmp_admin->set('solicitud_all',$solicitud_all);
        $this->tmp_admin->set('usuarios',$usuarios);
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('tecnico/nuevaSolicitud.php');
    }

    public function listadoRep(){
        

        if($_POST && $_POST["orden"] && $_POST["cliente"]){
            $this->session->set_userdata("orden",$this->input->post("orden"));
            $this->session->set_userdata("cliente",$this->input->post("cliente"));
            $this->session->set_userdata("garantia",$this->input->post("garantia"));
            
        }

        

        if($_FILES["miFile"]["name"]==""){

        }else{
            $nombre = uniqid();
            $this->session->set_userdata("carpeta",$nombre);
            
            $config = helper_config_upload("static/images/usuario/tempo/".$nombre);
    
            $this->load->library('upload', $config);
    
            if ( ! $this->upload->do_upload('miFile')){
                $error = array('error' => $this->upload->display_errors());
            }
            else{
                $data = array('upload_data' => $this->upload->data());
    
                // $newDatos = array();
                // $newDatos["archivo_garantia"] = $data["upload_data"]["file_name"];
                // $this->obj_solicitud->update_campo($newDatos,"id",$id_solicitud);
            }
        }


        
        $id_producto = $this->session->userdata("id_producto");
        $producto = $this->obj_producto->get($id_producto);

        $repuesto_all =  $this->obj_repuesto->get_all($id_producto);
    
        $this->tmp_admin->set('producto',$producto);
        $this->tmp_admin->set('repuesto_all',$repuesto_all);
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('tecnico/listadoRep.php');
        
    }

    public function resumenSolicitud(){
       
        if($_POST){
            $cantidad = $this->input->post("cantidad");
            $check = $this->input->post("check");

            $this->session->set_userdata("cantidad",$cantidad);
            $this->session->set_userdata("check",$check);
            $this->session->set_userdata("garantia",$this->input->post("check"));
            
            $producto = $this->obj_producto->get($this->session->userdata("id_producto"));
            
            $repuesto_all = array();
            foreach ($check as $key => $value) {
                $repuesto = $this->obj_repuesto->get($key);
                $repuesto->cantidad = $cantidad[$key];

                array_push($repuesto_all,$repuesto);
            }

            $this->tmp_admin->set('orden',$this->session->userdata("orden"));
            $this->tmp_admin->set('cliente',$this->session->userdata("cliente"));
            $this->tmp_admin->set('repuesto_all',$repuesto_all);
            $this->tmp_admin->set('producto',$producto);

            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('tecnico/resumenSolicitud.php');

        }
    }

    public function enviarSolicitud(){
            
            if($this->session->userdata("id_producto")==""){
                redirect("admin/tecnico");
            }
          
            $dataSolicitud["id_usuario"] = $this->session->userdata("id");
            $dataSolicitud["id_cliente"] = 1;
            $dataSolicitud["id_producto"] = $this->session->userdata("id_producto");
            $dataSolicitud["id_estado_solicitud"] = 4;
            $dataSolicitud["id_ubigeo"] = "12451414";
            $dataSolicitud["orden"] = $this->session->userdata("orden");
            $dataSolicitud["cliente"] = $this->session->userdata("cliente");
            $dataSolicitud["archivo_garantia"] = $this->session->userdata("carpeta");

            $id_solicitud = $this->obj_solicitud->insert($dataSolicitud);
            $this->session->set_userdata("carpeta","");
          
            


            $cantidad = $this->session->userdata("cantidad");
            $check = $this->session->userdata("check");

            $data = array();
            foreach ($check as $key => $value) {
                $repuesto = array();
                $repuesto["id_solicitud"] = $id_solicitud;
                $repuesto["cantidad"] = $cantidad[$key];
                $repuesto["id_repuesto"] = $key;
                array_push($data,$repuesto);
            }

            $this->obj_repuesto->insert_batch($data);


            //unset($_SESSION['id_producto']);


            $this->tmp_admin->set('id_solicitud',$id_solicitud);
            $this->load->tmp_admin->setLayout('templates/admin_tmp');
            $this->load->tmp_admin->render('tecnico/enviarSolicitud.php');
        
       
     
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
 