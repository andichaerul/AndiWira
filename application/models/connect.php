<?php 
 
class Connect extends CI_Model{
	function found_point(){
		$data = $this->db->query("SELECT * from point");
		return $data->result();
	}
	function pembangkitan_populasi(){
		$this->db->select('*');
		$this->db->from('point');
		$data = $this->db->get();
        return $data->result();
	}
		
}
