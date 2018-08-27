<?php 
 
class Connect extends CI_Model{
	function found_point(){
		$data = $this->db->query("SELECT * from point");
		return $data->result();
	}
	function pembangkitan_populasi(){
		$this->db->select('*');
		$this->db->from('point');
		$this->db->order_by('PointName', 'RANDOM');
		$data = $this->db->get();
        return $data->result();
	}
	function distance_report(){
		$this->db->select('*');
		$this->db->from('point');
		$data = $this->db->get();
        return $data->result();
	}
	function distance_insert(){
		$dari = $_GET['dari'];
		$distance = $_GET['distance'];
		$data = array(
        'Other' => $distance,
		);
		$this->db->where('PointID', $dari);
		$this->db->update('point', $data);
	}
		
}
