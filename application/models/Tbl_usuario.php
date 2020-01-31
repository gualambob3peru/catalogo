<?php

class Tbl_usuario extends CI_Model{
    private $tabla = 'usuario';
    private $contrasena = 'contrasena';
    private $usuario = 'usuario';

    public function __construct() {
        parent::__construct();
    }

    public function get($id){
        try {
            $this->db->where('id',$id);
            $query = $this->db->get($this->tabla);
            return $query->row();
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_all(){
        try {
            $this->db->from("usuario u");
            $this->db->select("u.*,tu.descripcion tipo_usuario_desc");
            $this->db->join("tipo_usuario tu","tu.id=u.idTipo_usuario");
            $this->db->order_by("fechaRegistro","desc");

            $query = $this->db->get();
            return $query->result();
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_campo($campo,$valor){
        try {
            $this->db->where($campo,$valor);
            $query = $this->db->get($this->tabla);
            return $query->row();
        } catch (Exception $exc) {
            return FALSE; 
        }
    }

    public function validar_usuario($usuario,$contrasena){
        try { 
            $this->db->where($this->usuario,$usuario);
            $this->db->where($this->contrasena,md5(helper_get_semilla().$contrasena));
            $query = $this->db->get($this->tabla);

            if($query->num_rows() > 0){
         
                $this->session->set_userdata('logged','true');
                $row = $query->row_array();
                $this->session->set_userdata($row);
            
            }
            return $query->row();
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function update_campo($data,$campo,$valor){
        try {
            $this->db->where($campo,$valor);
            $this->db->update($this->tabla, $data);
           
           
        } catch (Exception $exc) {
            return FALSE; 
        }
    }

    public function insert($data){
        try {
            $this->db->insert($this->tabla, $data);
           
            return $this->db->affected_rows();
        } catch (Exception $exc) {
            return FALSE; 
        }
    }
} 
?>