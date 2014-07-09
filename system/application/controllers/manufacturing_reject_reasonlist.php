<?php

class manufacturing_reject_reasonlist extends Controller {

	function manufacturing_reject_reasonlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('manufacturingrejectreason');
$this->db->where('manufacturingrejectreason.disabled = 0');
$this->db->select('manufacturingrejectreason.id as id', false);
$this->db->select('manufacturingrejectreason.name as manufacturingrejectreason__name', false);
$this->db->select('manufacturingrejectreason.name as manufacturingrejectreason__name', false);
$this->db->select('manufacturingrejectreason.lastupdate as manufacturingrejectreason__lastupdate', false);
$this->db->select('manufacturingrejectreason.updatedby as manufacturingrejectreason__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "manufacturingrejectreason.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingrejectreason.name like '%".$_POST['searchtext']."%'";$where .= " || manufacturingrejectreason.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || manufacturingrejectreason.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('manufacturingrejectreason__name', 'asc');
$this->db->order_by('manufacturingrejectreason__lastupdate', 'desc');
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
		$data['perpage'] = 20;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('manufacturingrejectreason__name' => 'Name', 'manufacturingrejectreason__name' => 'Notes', 'manufacturingrejectreason__lastupdate' => 'Last Update', 'manufacturingrejectreason__updatedby' => 'Last Update By');
		
		if (false)
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
		$this->load->view('manufacturing_reject_reason_list_view', $data);
	}
}

?>