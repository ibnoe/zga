<?php

class giro_out_clearance_linelist extends Controller {

	function giro_out_clearance_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $girooutclearance_id)
	{
		
$this->db->where('girooutclearanceline.girooutclearance_id', $girooutclearance_id);$this->db->from('girooutclearanceline');
$this->db->join('giroout', 'giroout.id = girooutclearanceline.giroout_id', 'left');
$this->db->where('girooutclearanceline.disabled = 0');
$this->db->select('giroout.girooutid as giroout__girooutid', false);
$this->db->select('girooutclearanceline.giroout_id as girooutclearanceline__giroout_id', false);
$this->db->select('girooutclearanceline.id as id', false);
$this->db->select('girooutclearanceline.lastupdate as girooutclearanceline__lastupdate', false);
$this->db->select('girooutclearanceline.updatedby as girooutclearanceline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "giroout.girooutid like '%".$_POST['searchtext']."%'";$where .= " || girooutclearanceline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || girooutclearanceline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('girooutclearanceline__giroout_id', 'asc');
$this->db->order_by('girooutclearanceline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($girooutclearance_id=0)
	{
		$data = array();
		
		
		
		$data['pageno'] = 0;
		if (isset($_POST['pageno'])) 
		{
			$data['pageno'] = $_POST['pageno'];
		}
		//echo $data['pageno'];
		$data['perpage'] = 20;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['foreign_id'] = $girooutclearance_id;$data['fields'] = array('giroout__girooutid' => 'Giro Out', 'girooutclearanceline__lastupdate' => 'Last Update', 'girooutclearanceline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $girooutclearance_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $girooutclearance_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('giro_out_clearance_line_list_view', $data);
	}
}

?>