<?php

class sales_return_delivery_for_invoicelist extends Controller {

	function sales_return_delivery_for_invoicelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesreturndelivery');
$this->db->join('customer', 'customer.id = salesreturndelivery.customer_id', 'left');
$this->db->join('warehouse', 'warehouse.id = salesreturndelivery.warehouse_id', 'left');
$this->db->join('salesreturninvoice', 'salesreturndelivery.id = salesreturninvoice.salesreturndelivery_id', 'left');
$this->db->where('salesreturndelivery.disabled = 0');
$this->db->where('salesreturninvoice.salesreturndelivery_id is NULL');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesreturndelivery.customer_id as salesreturndelivery__customer_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('salesreturndelivery.warehouse_id as salesreturndelivery__warehouse_id', false);
$this->db->select('salesreturndelivery.id as id', false);
$this->db->select('DATE_FORMAT(salesreturndelivery.date, "%d-%m-%Y") as salesreturndelivery__date', false);
$this->db->select('salesreturndelivery.salesreturndeliveryid as salesreturndelivery__salesreturndeliveryid', false);
$this->db->select('salesreturndelivery.notes as salesreturndelivery__notes', false);
$this->db->select('salesreturndelivery.lastupdate as salesreturndelivery__lastupdate', false);
$this->db->select('salesreturndelivery.updatedby as salesreturndelivery__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesreturndelivery.date like '%".$_POST['searchtext']."%'";$where .= " || salesreturndelivery.salesreturndeliveryid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturndelivery.notes like '%".$_POST['searchtext']."%'";$where .= " || salesreturndelivery.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturndelivery.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturndelivery__date', 'asc');
$this->db->order_by('salesreturndelivery__date', 'desc');
$this->db->order_by('salesreturndelivery__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesreturndelivery__date' => 'Date', 'salesreturndelivery__salesreturndeliveryid' => 'Delivery No', 'customer__firstname' => 'Customer', 'warehouse__name' => 'Warehouse', 'salesreturndelivery__notes' => 'Notes', 'salesreturndelivery__lastupdate' => 'Last Update', 'salesreturndelivery__updatedby' => 'Last Update By');
		
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
		$this->load->view('sales_return_delivery_for_invoice_list_view', $data);
	}
}

?>