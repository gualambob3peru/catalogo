<?php
class Tbl_vehiculo extends CI_Model{
    private $tabla = 'vehiculo';
    private $id = 'id';

    public function __construct() {
        parent::__construct();        
    }
    
    public function get($id){
        try {
            $this->db->where($this->id,$id);
            
            $query = $this->db->get($this->tabla);
            return $query->row();
        } catch (Exception $exc) {
            return FALSE;   
        }
    }


    public function get_all($estado="1"){
        try {

            $this->db->from("vehiculo v");
            $this->db->select("v.*,c.nombresCompletos,m.descripcion descripcion_marca,mo.descripcion descripcion_modelo");

            $this->db->join("cliente c","c.id=v.idCliente");
            $this->db->join("marca m","m.id=v.idMarca");
            $this->db->join("modelo mo","mo.id=v.idModelo");
            $this->db->where("v.estado", $estado);   


            $query = $this->db->get();
            return $query->result();
        } catch (Exception $exc) {
            return FALSE;   
        }
    }

    public function insert($data){
        try {
            $this->db->insert($this->tabla, $data);
        } catch (Exception $exc) {
            return FALSE;   
        }
    }

    public function insert_pago($data){
        try {
            $this->db->insert("pagoClientes", $data);
        } catch (Exception $exc) {
            return FALSE;   
        }
    }

    public function update($data,$id){
        try {
            $this->db->where($this->id, $id);
            $this->db->update($this->tabla, $data);
        } catch (Exception $exc) {
            return FALSE;   
        }
    }

    public function update_pago($data,$id){
        try {
            $this->db->where($this->id, $id);
            $this->db->update("pagoClientes", $data);
        } catch (Exception $exc) {
            return FALSE;   
        }
    }

    public function update_saldo($id,$monto,$aumenta ="1"){
        try {
            if($aumenta=="1"){
                $this->db->set("saldo","saldo+".$monto,FALSE);
            }else{
                $this->db->set("saldo","saldo-".$monto,FALSE);
            }
            $this->db->where($this->id, $id);
            $this->db->update($this->tabla);
            return $this->db->last_query();
        } catch (Exception $exc) {
            return FALSE;   
        }
    }

} 
?>