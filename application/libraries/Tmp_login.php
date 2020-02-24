<?php
class tmp_login {
    protected $_ci = '';
    private $layout ='templates/login_tmp';
    private $data = array();
    
    function __construct()
    {
        $this->_ci =& get_instance();
    }

    function setLayout($var)
    {
    	$this->layout = $var;
    }
    
    function getLayout()
    {   
    	return $this->layout;
    }
    
    function set($name, $var)
    {
    	$this->data[$name]=$var;
    }
    
    function cleanData()
    {
    	$this->data=array();
    }
    
    function get_settings()
    {
        $this->settings['fron']='default';
        return $this->settings;
    }
    
    function render($body,$menu='login')
    {
        $this->data['body'] =   $this->_ci->load->view($body, $this->data, true);
    	$this->data['menu']	=	$menu;
        $this->_ci->load->view($this->getLayout(),$this->data);
        $this->cleanData();
    }
}
?>