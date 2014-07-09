<?php

class blanket_inspection_sheetlist extends Controller {

	function blanket_inspection_sheetlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('blanketinspectionsheet');
$this->db->join('customer', 'customer.id = blanketinspectionsheet.customer_id', 'left');
$this->db->where('blanketinspectionsheet.disabled = 0');
$this->db->select('customer.idstring as customer__idstring', false);
$this->db->select('blanketinspectionsheet.customer_id as blanketinspectionsheet__customer_id', false);
$this->db->select('blanketinspectionsheet.id as id', false);
$this->db->select('DATE_FORMAT(blanketinspectionsheet.date, "%d-%m-%Y") as blanketinspectionsheet__date', false);
$this->db->select('blanketinspectionsheet.productname as blanketinspectionsheet__productname', false);
$this->db->select('blanketinspectionsheet.presstype as blanketinspectionsheet__presstype', false);
$this->db->select('blanketinspectionsheet.barsize as blanketinspectionsheet__barsize', false);
$this->db->select('blanketinspectionsheet.lastupdate as blanketinspectionsheet__lastupdate', false);
$this->db->select('blanketinspectionsheet.updatedby as blanketinspectionsheet__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "blanketinspectionsheet.date like '%".$_POST['searchtext']."%'";$where .= " || customer.idstring like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheet.productname like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheet.presstype like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheet.barsize like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheet.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheet.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('blanketinspectionsheet__date', 'asc');
$this->db->order_by('blanketinspectionsheet__date', 'desc');
$this->db->order_by('blanketinspectionsheet__lastupdate', 'desc');
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
		
		$data['fields'] = array('blanketinspectionsheet__date' => 'Date', 'customer__idstring' => 'Customer', 'blanketinspectionsheet__productname' => 'Product Name', 'blanketinspectionsheet__presstype' => 'Press Type', 'blanketinspectionsheet__barsize' => 'Bar Size', 'blanketinspectionsheet__lastupdate' => 'Last Update', 'blanketinspectionsheet__updatedby' => 'Last Update By');
		
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
		$this->load->view('blanket_inspection_sheet_list_view', $data);
	}
}

?>