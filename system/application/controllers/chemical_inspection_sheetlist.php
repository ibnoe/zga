<?php

class chemical_inspection_sheetlist extends Controller {

	function chemical_inspection_sheetlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('chemicalinspectionsheet');
$this->db->join('customer', 'customer.id = chemicalinspectionsheet.customer_id', 'left');
$this->db->where('chemicalinspectionsheet.disabled = 0');
$this->db->select('customer.idstring as customer__idstring', false);
$this->db->select('chemicalinspectionsheet.customer_id as chemicalinspectionsheet__customer_id', false);
$this->db->select('chemicalinspectionsheet.id as id', false);
$this->db->select('DATE_FORMAT(chemicalinspectionsheet.date, "%d-%m-%Y") as chemicalinspectionsheet__date', false);
$this->db->select('chemicalinspectionsheet.productname as chemicalinspectionsheet__productname', false);
$this->db->select('chemicalinspectionsheet.batchno as chemicalinspectionsheet__batchno', false);
$this->db->select('chemicalinspectionsheet.chemicaltype as chemicalinspectionsheet__chemicaltype', false);
$this->db->select('chemicalinspectionsheet.lastupdate as chemicalinspectionsheet__lastupdate', false);
$this->db->select('chemicalinspectionsheet.updatedby as chemicalinspectionsheet__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "chemicalinspectionsheet.date like '%".$_POST['searchtext']."%'";$where .= " || customer.idstring like '%".$_POST['searchtext']."%'";$where .= " || chemicalinspectionsheet.productname like '%".$_POST['searchtext']."%'";$where .= " || chemicalinspectionsheet.batchno like '%".$_POST['searchtext']."%'";$where .= " || chemicalinspectionsheet.chemicaltype like '%".$_POST['searchtext']."%'";$where .= " || chemicalinspectionsheet.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || chemicalinspectionsheet.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('chemicalinspectionsheet__date', 'asc');
$this->db->order_by('chemicalinspectionsheet__date', 'desc');
$this->db->order_by('chemicalinspectionsheet__lastupdate', 'desc');
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
		
		$data['fields'] = array('chemicalinspectionsheet__date' => 'Date', 'customer__idstring' => 'Customer', 'chemicalinspectionsheet__productname' => 'Product Name', 'chemicalinspectionsheet__batchno' => 'Batch No', 'chemicalinspectionsheet__chemicaltype' => 'Chemical Type', 'chemicalinspectionsheet__lastupdate' => 'Last Update', 'chemicalinspectionsheet__updatedby' => 'Last Update By');
		
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
		$this->load->view('chemical_inspection_sheet_list_view', $data);
	}
}

?>