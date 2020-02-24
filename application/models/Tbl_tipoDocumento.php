<?php

class Tbl_tipoDocumento extends CI_Model{
    private $tabla = 'tipo_documento';
  
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
            $query = $this->db->get($this->tabla);
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