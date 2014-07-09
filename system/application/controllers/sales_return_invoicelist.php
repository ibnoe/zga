<?php

class sales_return_invoicelist extends Controller {

	function sales_return_invoicelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesreturninvoice');
$this->db->join('salesreturndelivery', 'salesreturndelivery.id = salesreturninvoice.salesreturndelivery_id', 'left');
$this->db->where('salesreturninvoice.disabled = 0');
$this->db->select('salesreturndelivery.salesreturndeliveryid as salesreturndelivery__salesreturndeliveryid', false);
$this->db->select('salesreturninvoice.salesreturndelivery_id as salesreturninvoice__salesreturndelivery_id', false);
$this->db->select('salesreturninvoice.id as id', false);
$this->db->select('DATE_FORMAT(salesreturninvoice.date, "%d-%m-%Y") as salesreturninvoice__date', false);
$this->db->select('salesreturninvoice.salesreturninvoiceid as salesreturninvoice__salesreturninvoiceid', false);
$this->db->select('salesreturninvoice.customer_id as salesreturninvoice__customer_id', false);
$this->db->select('salesreturninvoice.currency_id as salesreturninvoice__currency_id', false);
$this->db->select('salesreturninvoice.currencyrate as salesreturninvoice__currencyrate', false);
$this->db->select('salesreturninvoice.total as salesreturninvoice__total', false);
$this->db->select('salesreturninvoice.lastupdate as salesreturninvoice__lastupdate', false);
$this->db->select('salesreturninvoice.updatedby as salesreturninvoice__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesreturninvoice.date like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoice.salesreturninvoiceid like '%".$_POST['searchtext']."%'";$where .= " || salesreturndelivery.salesreturndeliveryid like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoice.total like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoice.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturninvoice.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturninvoice__date', 'asc');
$this->db->order_by('salesreturninvoice__date', 'desc');
$this->db->order_by('salesreturninvoice__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesreturninvoice__date' => 'Date', 'salesreturninvoice__salesreturninvoiceid' => 'Invoice No', 'salesreturndelivery__salesreturndeliveryid' => 'Sales Return Delivery', 'salesreturninvoice__total' => 'Total', 'salesreturninvoice__lastupdate' => 'Last Update', 'salesreturninvoice__updatedby' => 'Last Update By');
		
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
		$this->load->view('sales_return_invoice_list_view', $data);
	}
}

?>