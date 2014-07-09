<?php

class accumulated_accountslookup extends Controller {

	function accumulated_accountslookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('coa');
$this->db->join('coatype', 'coatype.id = coa.coatype_id', 'left');
$this->db->where('coa.disabled = 0');
$this->db->select('coatype.name as coatype__name', false);
$this->db->select('coa.coatype_id as coa__coatype_id', false);
$this->db->select('coa.id as id', false);
$this->db->select('coa.idstring as coa__idstring', false);
$this->db->select('coa.name as coa__name', false);
$this->db->select('coa.lastupdate as coa__lastupdate', false);
$this->db->select('coa.updatedby as coa__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "coa.idstring like '%".$_POST['searchtext']."%'";$where .= " || coa.name like '%".$_POST['searchtext']."%'";$where .= " || coatype.name like '%".$_POST['searchtext']."%'";$where .= " || coa.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || coa.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('coa__idstring', 'asc');
$this->db->order_by('coa__lastupdate', 'desc');
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
		
		$data['fields'] = array('coa__idstring' => 'Acc No', 'coa__name' => 'Name', 'coatype__name' => 'Type', 'coa__lastupdate' => 'Last Update', 'coa__updatedby' => 'Last Update By');
		
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
		$this->load->view('accumulated_accounts_lookup_view', $data);
	}
}

?>