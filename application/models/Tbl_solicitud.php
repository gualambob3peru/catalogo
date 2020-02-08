<?php

class Tbl_solicitud extends CI_Model{
    private $tabla = 'solicitud';

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
            $this->db->from("solicitud s");
            $this->db->select("s.*,c.nombresCompletos nombresCompletos_cliente,u.nombresCompletos nombresCompletos_usuario,p.descripcion producto_descripcion,es.descripcion estado_solicitud_escripcion,ub.distrito");
            $this->db->join("usuario u","u.id=s.id_usuario");
            $this->db->join("cliente c","c.id=s.id_cliente");
            $this->db->join("producto p","p.id=s.id_producto");
            $this->db->join("estado_solicitud es","es.id=s.id_estados_solicitud");
            $this->db->join("ubigeo ub","ub.id=s.id_ubigeo");
            $this->db->where("u.idEstados","1");
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
            $this->db->from("usuario u");
            $this->db->select("u.*,tu.*");
            $this->db->where("u.usuario",$usuario);
            $this->db->where("u.contrasena",md5(helper_get_semilla().$contrasena));
            $this->db->join("tipo_usuario tu","tu.id = u.idTipo_usuario");

            $query = $this->db->get();

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