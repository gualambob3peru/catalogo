<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MX_Controller {
    public function __construct(){
        parent::__construct();


        $this->load->model('Tbl_usuario','obj_usuario');    
        
       
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

    public function nuevoAdministrador(){ 
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));

        

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required',
        array(
            'required' => 'El nombre es requerido'
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
            $this->load->tmp_admin->render('usuario/nuevoAdministrador.php');
        }
        else
        {
            $dato = array();
            $dato["nombres"] =  $this->input->post('nombres');  
            $dato["apellidoPaterno"] =  $this->input->post('apellidoPaterno');  
            $dato["apellidoMaterno"] =  $this->input->post('apellidoMaterno');  
            $dato["nroDocumento"] =  $this->input->post('nroDocumento');  
            $dato["usuario"] =  $this->input->post('usuario');  
            $dato["contrasena"] =  md5(helper_get_semilla().$this->input->post('contrasena'));  
            $dato["idTipo_usuario"] =  1;  
            

            if($this->obj_usuario->insert($dato)){
                redirect('admin');
            }else{
                $data['error'] = 'No se pudo Registrar';
                $this->tmp_login->set('error','No se pudo Registrar');
                $this->load->tmp_login->setLayout('templates/admin_tmp');
                $this->load->tmp_admin->render('usuario/nuevoAdministrador.php');
            }
        }
    }

    public function nuevoTecnico(){ 
        $this->tmp_admin->set('usuario',$this->session->userdata('usuario'));

        

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required',
        array(
            'required' => 'El nombre es requerido'
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
            $dato["nroDocumento"] =  $this->input->post('nroDocumento');  
            $dato["usuario"] =  $this->input->post('usuario');  
            $dato["contrasena"] =  md5(helper_get_semilla().$this->input->post('contrasena'));  
            $dato["idTipo_usuario"] =  1;  
            

            if($this->obj_usuario->insert($dato)){
                redirect('admin');
            }else{
                $data['error'] = 'No se pudo Registrar';
                $this->tmp_login->set('error','No se pudo Registrar');
                $this->load->tmp_login->setLayout('templates/admin_tmp');
                $this->load->tmp_admin->render('usuario/nuevoTecnico.php');
            }
        }
    }

    public function administraNotificacion(){                     
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('usuario/administraNotificacion.php');
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
 