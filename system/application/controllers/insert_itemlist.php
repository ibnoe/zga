<?php

class insert_itemlist extends Controller {

	function insert_itemlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('insertitem');
$this->db->where('insertitem.disabled = 0');
$this->db->select('insertitem.id as id', false);
$this->db->select('insertitem.idstring as insertitem__idstring', false);
$this->db->select('DATE_FORMAT(insertitem.date, "%d-%m-%Y") as insertitem__date', false);
$this->db->select('insertitem.notes as insertitem__notes', false);
$this->db->select('insertitem.lastupdate as insertitem__lastupdate', false);
$this->db->select('insertitem.updatedby as insertitem__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "insertitem.idstring like '%".$_POST['searchtext']."%'";$where .= " || insertitem.date like '%".$_POST['searchtext']."%'";$where .= " || insertitem.notes like '%".$_POST['searchtext']."%'";$where .= " || insertitem.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || insertitem.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('insertitem__idstring', 'asc');
$this->db->order_by('insertitem__date', 'desc');
$this->db->order_by('insertitem__lastupdate', 'desc');
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
		
		$data['fields'] = array('insertitem__idstring' => 'ID', 'insertitem__date' => 'Date', 'insertitem__notes' => 'Description', 'insertitem__lastupdate' => 'Last Update', 'insertitem__updatedby' => 'Last Update By');
		
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
		$this->load->view('insert_item_list_view', $data);
	}
}

?>