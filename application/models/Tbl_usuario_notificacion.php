<?php

class Tbl_usuario_notificacion extends CI_Model{
    private $tabla = 'usuario_notificacion';


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

    public function get_tn($id){
        try {
            $this->db->where('id',$id);
            $query = $this->db->get("tipo_notificacion");
            return $query->row();
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_all(){
        try {
            $this->db->from("usuario_notificacion u");
            $this->db->select("u.*,tu.descripcion tipo_usuario_desc");
            $this->db->join("tipo_notificacion tu","tu.id=u.id_tipo_notificacion","left");
            $this->db->where("u.idEstados","1");
            $this->db->order_by("fechaRegistro","desc");

            $query = $this->db->get();
            return $query->result();
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_all_tn(){
        try {
            $this->db->where("idEstados","1");
            $query = $this->db->get("tipo_notificacion");
            return $query->result();
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_row_tipo($tipo){
        try {
            $this->db->where("id_tipo_notificacion",$tipo);
            $query = $this->db->get($this->tabla);
            return $query->row();
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function get_all_tipo($tipo){
        try {
            $this->db->where("id_tipo_notificacion",$tipo);
            $this->db->where("idEstados","1");
            $query = $this->db->get($this->tabla);
            return $query->result();
        } catch (Exception $exc) {
            return FALSE;
        }
    }



    public function get_campo($campo,$valor){
        try {
            $this->db->where($campo,$valor);
            $this->db->where("idEstados","1");
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