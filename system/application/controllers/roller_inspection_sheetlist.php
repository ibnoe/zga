<?php

class roller_inspection_sheetlist extends Controller {

	function roller_inspection_sheetlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('rollerinspectionsheet');
$this->db->join('customer', 'customer.id = rollerinspectionsheet.customer_id', 'left');
$this->db->join('mesin', 'mesin.id = rollerinspectionsheet.mesin_id', 'left');
$this->db->join('item', 'item.id = rollerinspectionsheet.roll_id', 'left');
$this->db->join('item as item1', 'item1.id = rollerinspectionsheet.compound_id', 'left');
$this->db->where('rollerinspectionsheet.disabled = 0');
$this->db->select('customer.idstring as customer__idstring', false);
$this->db->select('rollerinspectionsheet.customer_id as rollerinspectionsheet__customer_id', false);
$this->db->select('mesin.typename as mesin__typename', false);
$this->db->select('rollerinspectionsheet.mesin_id as rollerinspectionsheet__mesin_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('rollerinspectionsheet.roll_id as rollerinspectionsheet__roll_id', false);
$this->db->select('item1.name as item1__name', false);
$this->db->select('rollerinspectionsheet.compound_id as rollerinspectionsheet__compound_id', false);
$this->db->select('rollerinspectionsheet.id as id', false);
$this->db->select('rollerinspectionsheet.idstring as rollerinspectionsheet__idstring', false);
$this->db->select('DATE_FORMAT(rollerinspectionsheet.date, "%d-%m-%Y") as rollerinspectionsheet__date', false);
$this->db->select('rollerinspectionsheet.orderno as rollerinspectionsheet__orderno', false);
$this->db->select('rollerinspectionsheet.lastupdate as rollerinspectionsheet__lastupdate', false);
$this->db->select('rollerinspectionsheet.updatedby as rollerinspectionsheet__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "rollerinspectionsheet.idstring like '%".$_POST['searchtext']."%'";$where .= " || rollerinspectionsheet.date like '%".$_POST['searchtext']."%'";$where .= " || customer.idstring like '%".$_POST['searchtext']."%'";$where .= " || mesin.typename like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || rollerinspectionsheet.orderno like '%".$_POST['searchtext']."%'";$where .= " || item1.name like '%".$_POST['searchtext']."%'";$where .= " || rollerinspectionsheet.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || rollerinspectionsheet.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('rollerinspectionsheet__idstring', 'asc');
$this->db->order_by('rollerinspectionsheet__date', 'desc');
$this->db->order_by('rollerinspectionsheet__lastupdate', 'desc');
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
		
		$data['fields'] = array('rollerinspectionsheet__idstring' => 'ID', 'rollerinspectionsheet__date' => 'Date', 'customer__idstring' => 'Customer', 'mesin__typename' => 'Mesin', 'item__name' => 'Roll', 'rollerinspectionsheet__orderno' => 'Order No', 'item1__name' => 'Compound', 'rollerinspectionsheet__lastupdate' => 'Last Update', 'rollerinspectionsheet__updatedby' => 'Last Update By');
		
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
		$this->load->view('roller_inspection_sheet_list_view', $data);
	}
}

?>