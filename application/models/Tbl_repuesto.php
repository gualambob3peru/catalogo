<?php

class Tbl_repuesto extends CI_Model{
    private $tabla = 'repuesto';

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

    public function get_all($id_producto=""){
        try {
            $this->db->from("repuesto r");
            $this->db->select("r.id,r.sku,r.descripcion descripcion_repuesto,r.um,r.stock,p.descripcion descripcion_producto, p.sku sku_producto");
  
            $this->db->join("producto p","p.id = r.id_producto");
            

            if($id_producto!=""){
                $this->db->where("r.id_producto",$id_producto);
            }

            $this->db->where("r.idEstados","1");
            $this->db->order_by("r.fechaRegistro","desc");

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

    public function get_campo_all($campo,$valor){
        try {
            $this->db->where($campo,$valor);
            $query = $this->db->get($this->tabla);
            return $query->result();
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

    public function insert_batch($data){
        try {

            $this->db->insert_batch("repuesto_solicitud", $data);
            return $this->db->affected_rows();

        } catch (Exception $exc) {
            return FALSE; 
        }
    }
} 
?>