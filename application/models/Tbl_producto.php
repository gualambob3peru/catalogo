<?php

class Tbl_producto extends CI_Model{
    private $tabla = 'producto';

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
            $this->db->from("producto p");
            $this->db->select("p.*");
  
            $this->db->where("p.idEstados","1");
            $this->db->order_by("p.fechaRegistro","desc");

            $query = $this->db->get();
            return $query->result();
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_imagen($id_producto){
        try {
            $this->db->from("producto_imagen pi");
            $this->db->select("pi.*");
  
            $this->db->where("pi.id_producto",$id_producto);
            $this->db->where("pi.idEstados","1");
            $this->db->order_by("pi.fechaRegistro","desc");

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



    public function update_campo($data,$campo,$valor){
        try {
            $this->db->where($campo,$valor);
            $this->db->update($this->tabla, $data);
            
            return $this->db->affected_rows();
           
        } catch (Exception $exc) {
            return FALSE; 
        }
    }

    public function update($data,$id){
        try {
            $this->db->where("id",$id);
            $this->db->update($this->tabla, $data);
            
            return $this->db->affected_rows();
           
        } catch (Exception $exc) {
            return FALSE; 
        }
    }

    public function insert($data){
        try {
            $this->db->insert($this->tabla, $data);
           
            return $this->db->insert_id();
        } catch (Exception $exc) {
            return FALSE; 
        }
    }
} 
?>