<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehiculo extends MX_Controller {
    public function __construct(){
        parent::__construct();

        $this->load->model('Tbl_usuario','obj_usuario');    
        $this->load->model('Tbl_vehiculo','obj_vehiculo');    
       
        if($this->session->userdata('logged') != 'true'){
            redirect('login');
          
        }
        date_default_timezone_set("America/Lima");
    }
	 
	public function index(){ 
        $vehiculos = $this->obj_vehiculo->get_all();
        

        $this->tmp_admin->set('vehiculos',$vehiculos);
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('vehiculo/vehiculo.php');
    }

    public function agregar(){ 
        
        $this->load->tmp_admin->setLayout('templates/admin_tmp');
        $this->load->tmp_admin->render('vehiculo/agregar.php');
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
 