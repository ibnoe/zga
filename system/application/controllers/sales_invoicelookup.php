<?php

class sales_invoicelookup extends Controller {

	function sales_invoicelookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesinvoice');
$this->db->join('deliveryorder', 'deliveryorder.id = salesinvoice.deliveryorder_id', 'left');
$this->db->where('salesinvoice.disabled = 0');
$this->db->select('deliveryorder.orderid as deliveryorder__orderid', false);
$this->db->select('salesinvoice.deliveryorder_id as salesinvoice__deliveryorder_id', false);
$this->db->select('salesinvoice.id as id', false);
$this->db->select('DATE_FORMAT(salesinvoice.date, "%d-%m-%Y") as salesinvoice__date', false);
$this->db->select('salesinvoice.orderid as salesinvoice__orderid', false);
$this->db->select('salesinvoice.donum as salesinvoice__donum', false);
$this->db->select('salesinvoice.customer_id as salesinvoice__customer_id', false);
$this->db->select('salesinvoice.currency_id as salesinvoice__currency_id', false);
$this->db->select('salesinvoice.currencyrate as salesinvoice__currencyrate', false);
$this->db->select('salesinvoice.total as salesinvoice__total', false);
$this->db->select('salesinvoice.top as salesinvoice__top', false);
$this->db->select('salesinvoice.lastupdate as salesinvoice__lastupdate', false);
$this->db->select('salesinvoice.updatedby as salesinvoice__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesinvoice.date like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.orderid like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.donum like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.orderid like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.total like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.top like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesinvoice.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesinvoice__date', 'asc');
$this->db->order_by('salesinvoice__date', 'desc');
$this->db->order_by('salesinvoice__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesinvoice__date' => 'Date', 'salesinvoice__orderid' => 'Sales Invoice No', 'salesinvoice__donum' => 'DO No', 'deliveryorder__orderid' => 'Delivery Order', 'salesinvoice__total' => 'Total', 'salesinvoice__top' => 'Payment Term', 'salesinvoice__lastupdate' => 'Last Update', 'salesinvoice__updatedby' => 'Last Update By');
		
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
		$this->load->view('sales_invoice_lookup_view', $data);
	}
}

?>