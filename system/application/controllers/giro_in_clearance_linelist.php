<?php

class giro_in_clearance_linelist extends Controller {

	function giro_in_clearance_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $giroinclearance_id)
	{
		
$this->db->where('giroinclearanceline.giroinclearance_id', $giroinclearance_id);$this->db->from('giroinclearanceline');
$this->db->join('giroin', 'giroin.id = giroinclearanceline.giroin_id', 'left');
$this->db->where('giroinclearanceline.disabled = 0');
$this->db->select('giroin.giroinid as giroin__giroinid', false);
$this->db->select('giroinclearanceline.giroin_id as giroinclearanceline__giroin_id', false);
$this->db->select('giroinclearanceline.id as id', false);
$this->db->select('giroinclearanceline.lastupdate as giroinclearanceline__lastupdate', false);
$this->db->select('giroinclearanceline.updatedby as giroinclearanceline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "giroin.giroinid like '%".$_POST['searchtext']."%'";$where .= " || giroinclearanceline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || giroinclearanceline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('giroinclearanceline__giroin_id', 'asc');
$this->db->order_by('giroinclearanceline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($giroinclearance_id=0)
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
		
		$data['foreign_id'] = $giroinclearance_id;$data['fields'] = array('giroin__giroinid' => 'Giro In', 'giroinclearanceline__lastupdate' => 'Last Update', 'giroinclearanceline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $giroinclearance_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $giroinclearance_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('giro_in_clearance_line_list_view', $data);
	}
}

?>