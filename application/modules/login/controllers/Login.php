<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Tbl_usuario','obj_usuario');
        
        if($this->session->userdata('logged') == 'true'){
            redirect('admin');
        }
    }
    
    public function index(){
        //  echo md5(helper_get_semilla()."123456");

        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required',
        array(
            'required' => 'El usuario es requerido'
        ));

        $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required',
        array(
            'required' => 'La contraseña es requerida'
        ));
        $this->tmp_login->set('error','');
        
        if ($this->form_validation->run($this) == FALSE)
        {
            $this->load->tmp_login->setLayout('templates/login_tmp');
            $this->load->tmp_login->render('login/login_view.php');
        }
        else
        {
            $usuario =  $this->input->post('usuario');  
            $contrasena =  $this->input->post('contrasena');  

            if($this->obj_usuario->validar_usuario($usuario,$contrasena)){
                redirect('admin');
            }else{
                $data['error'] = 'Usuario o contraseña incorrectos';
                $this->tmp_login->set('error','Usuario o contraseña incorrectos');
                $this->load->tmp_login->setLayout('templates/login_tmp');
                $this->load->tmp_login->render('login/login_view.php');
            }
        }
    }

    public function login_admin(){
        // echo md5(helper_get_semilla()."admin");

        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required',
        array(
            'required' => 'El usuario es requerido'
        ));

        $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required',
        array(
            'required' => 'La contraseña es requerida'
        ));
        
        if ($this->form_validation->run($this) == FALSE)
        {
            $this->load->tmp_login->setLayout('templates/login_tmp');
            $this->load->tmp_login->render('login/login_admin.php');
        }
        else
        {
            $usuario =  $this->input->post('usuario');  
            $contrasena =  $this->input->post('contrasena');  

            if($this->obj_usuario->validar_usuario($usuario,$contrasena)){
                redirect('admin');
            }else{
                $data['error'] = 'Usuario o contraseña incorrectos';
                $this->tmp_login->set('error','Usuario o contraseña incorrectos');
                $this->load->tmp_login->setLayout('templates/login_tmp');
                $this->load->tmp_login->render('login/login_admin.php');
            }
        }
    }

    public function esUsuario($usuario){
        $usuario = $this->obj_usuario->get_campo("usuario",$usuario);
        if($usuario==NULL)
            return false;
        else 
            return true;
       
    }

    public function recuperar(){
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|callback_esUsuario',
        array(
            'required' => 'El usuario es requerido',
            'esUsuario' => 'Este correo no esta registrado'
        ));
      
        $this->form_validation->set_message('required', 'Este campo es requerido');

        $this->tmp_login->set('error','');
        
        if ($this->form_validation->run($this) == FALSE)
        {
            $this->load->tmp_login->setLayout('templates/login_tmp');
            $this->load->tmp_login->render('login/recuperar.php');
        }
        else
        {
            $usuario =  $this->input->post('usuario');  
            $this->load->library('email');
            
            $config['protocol'] = 'smtp';
            $config["smtp_host"] = 'mail.b3peru.com';
            $config["smtp_user"] = 'notificaciones@b3peru.com';
            $config["smtp_pass"] = 'Dl*T4v,LZH1,';   
            $config["smtp_port"] = '587';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $config['validate'] = true;
        
            $this->email->initialize($config);
            $this->email->from('notificaciones@b3peru.com', 'B3');
            $this->email->to($usuario, 'Usuario');
            $this->email->subject("Recuperar Contraseña");
            $this->email->message(
                    "Ingresa en el enlace para cambiar la contraseña - ".base_url()."login/nuevaContrasena/".md5(helper_get_semilla().date("Y-m-d"))
                    );
            
            if($this->email->send()){
                $this->session->set_userdata('correo', $usuario);
                redirect("login/correoExito");
            }else{
                $this->tmp_login->set('error','No se pudo enviar el correo, inténtelo nuevamente');
                $this->load->tmp_login->setLayout('templates/login_tmp');
                $this->load->tmp_login->render('login/recuperar.php');
            }
        }
    }

    public function nuevaContrasena($dato){
        $correo = $this->session->userdata('correo');
        $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required');
        $this->form_validation->set_rules('contrasena2', 'Contraseña', 'trim|required|matches[contrasena]');
        $this->form_validation->set_message('required', 'Este campo es requerido');
        
        if ($this->form_validation->run($this) == FALSE)
        {
            $this->tmp_login->set('correo',$correo);
            $this->load->tmp_login->setLayout('templates/login_tmp');
            $this->load->tmp_login->render('login/nuevaContrasena.php');
        }
        else
        {
            $contrasena = $this->input->post("contrasena");
            $data = array();
            $data["contrasena"] = md5(helper_get_semilla().$contrasena);
            $this->obj_usuario->update_campo($data,"usuario",$correo);
        }
    }


    public function correoExito(){
        $this->load->tmp_login->setLayout('templates/login_tmp');
        $this->load->tmp_login->render('login/correoExito.php');
    }

    public function usuariocheck($correo){
        $usuario = $this->obj_usuario->get_campo("usuario",$correo);

        if(is_object($usuario)){
            $this->form_validation->set_message('usuariocheck', 'Este usuario ya fue registrado');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function nuevoUsuario(){
        $this->form_validation->set_rules('usuario', 'Correo', 'trim|required|callback_usuariocheck');
        $this->form_validation->set_rules('apellidoPaterno', 'apellidoPaterno', 'trim|required');
        $this->form_validation->set_rules('apellidoMaterno', 'apellidoMaterno', 'trim|required');
        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
        $this->form_validation->set_rules('tipoDocumento', 'tipoDocumento', 'trim|required');
        $this->form_validation->set_rules('nroDocumento', 'nroDocumento', 'trim|required');
        $this->form_validation->set_rules('telefono', 'telefono', 'trim|required');
        $this->form_validation->set_rules('contrasena', 'contrasena', 'trim|required');
    
        $this->form_validation->set_message('usuariocheck', 'Este usuario ya fue registrado');
        $this->form_validation->set_message('required', 'Este campo es requerido %s');
        
        if ($this->form_validation->run($this) == FALSE)
        {
            $tipo_documentos = $this->obj_tipo_documento->get_all();
            
            $this->tmp_login->set('tipo_documentos',$tipo_documentos);
            $this->load->tmp_login->setLayout('templates/login_tmp');
            $this->load->tmp_login->render('login/nuevoUsuario.php');
        }
        else
        {
            $data = array();
            $data["usuario"] = $this->input->post("usuario");
            $data["contrasena"] = md5(helper_get_semilla().$this->input->post("contrasena"));
            $data["nombres"] = $this->input->post("nombre");
            $data["apellidoPaterno"] = $this->input->post("apellidoPaterno");
            $data["apellidoMaterno"] = $this->input->post("apellidoMaterno");
            $data["nombresCompletos"] = $this->input->post("nombre")." ".$this->input->post("apellidoPaterno")." ".$this->input->post("apellidoMaterno");
            $data["idTipoDocumentos"] = $this->input->post("tipoDocumento");
            $data["nroDocumento"] = $this->input->post("nroDocumento");
            $data["telefono"] = $this->input->post("telefono");
            
           

            if($this->obj_usuario->insert($data)){
                redirect("login");
            }else{
                redirect("login/nuevoUsuario");
            }
        }

        
    }

    public function logout(){                     
        $this->session->unset_userdata('logged');
        
        redirect('login');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */