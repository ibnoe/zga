<?php

class sales_payment_line_viewlist extends Controller {

	function sales_payment_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salespaymentline');
$this->db->join('salesinvoice', 'salesinvoice.id = salespaymentline.salesinvoice_id', 'left');
$this->db->where('salespaymentline.disabled = 0');
$this->db->select('salesinvoice.orderid as salesinvoice__orderid', false);
$this->db->select('salespaymentline.salesinvoice_id as salespaymentline__salesinvoice_id', false);
$this->db->select('salespaymentline.id as id', false);
$this->db->select('salespaymentline.lastupdate as salespaymentline__lastupdate', false);
$this->db->select('salespaymentline.updatedby as salespaymentline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesinvoice.orderid like '%".$_POST['searchtext']."%'";$where .= " || salespaymentline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salespaymentline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salespaymentline__salesinvoice_id', 'asc');
$this->db->order_by('salespaymentline__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesinvoice__orderid' => 'Sales Invoice', 'salespaymentline__lastupdate' => 'Last Update', 'salespaymentline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		///
		$this->load->view('sales_payment_line_view_list_view', $data);
	}
}

?>