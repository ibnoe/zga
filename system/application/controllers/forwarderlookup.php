<?php

class forwarderlookup extends Controller {

	function forwarderlookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('forwarder');
$this->db->where('forwarder.disabled = 0');
$this->db->select('forwarder.id as id', false);
$this->db->select('forwarder.name as forwarder__name', false);
$this->db->select('forwarder.address as forwarder__address', false);
$this->db->select('forwarder.rating as forwarder__rating', false);
$this->db->select('forwarder.notes as forwarder__notes', false);
$this->db->select('forwarder.lastupdate as forwarder__lastupdate', false);
$this->db->select('forwarder.updatedby as forwarder__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "forwarder.name like '%".$_POST['searchtext']."%'";$where .= " || forwarder.address like '%".$_POST['searchtext']."%'";$where .= " || forwarder.rating like '%".$_POST['searchtext']."%'";$where .= " || forwarder.notes like '%".$_POST['searchtext']."%'";$where .= " || forwarder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || forwarder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('forwarder__name', 'asc');
$this->db->order_by('forwarder__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($edit_module_id=0)
	{
		$data = array();
		
		
		
		$data['pageno'] = 0;
		if (isset($_POST['pageno'])) 
		{
			$data['pageno'] = $_POST['pageno'];
		}
		//echo $data['pageno'];
		$data['perpage'] = 10000;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('forwarder__name' => 'Name', 'forwarder__address' => 'Address', 'forwarder__rating' => 'Rating', 'forwarder__notes' => 'Notes', 'forwarder__lastupdate' => 'Last Update', 'forwarder__updatedby' => 'Last Update By');
		
		if (count($_POST) == 0)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('forwarder_lookup_view', $data);
	}
}

?>