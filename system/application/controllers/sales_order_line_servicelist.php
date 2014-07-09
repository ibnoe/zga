<?php

class sales_order_line_servicelist extends Controller {

	function sales_order_line_servicelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $salesorder_id)
	{
		
$this->db->where('salesorderline.salesorder_id', $salesorder_id);$this->db->from('salesorderline');
$this->db->join('rcn', 'rcn.id = salesorderline.rcn_id');
$this->db->select('rcn.norcn as rcn__norcn');
$this->db->select('salesorderline.rcn_id as salesorderline__rcn_id');
$this->db->select('salesorderline.id as id');
$this->db->select('salesorderline.orderid as salesorderline__orderid');
$this->db->select('salesorderline.date as salesorderline__date');
$this->db->select('salesorderline.notes as salesorderline__notes');
$this->db->select('salesorderline.customer_id as salesorderline__customer_id');
$this->db->select('salesorderline.currency_id as salesorderline__currency_id');
$this->db->select('salesorderline.currencyrate as salesorderline__currencyrate');
$this->db->select('salesorderline.warehouse_id as salesorderline__warehouse_id');
$this->db->select('salesorderline.status as salesorderline__status');
$this->db->select('salesorderline.quantity as salesorderline__quantity');
$this->db->select('salesorderline.price as salesorderline__price');
$this->db->select('salesorderline.pdisc as salesorderline__pdisc');
$this->db->select('salesorderline.modulename as salesorderline__modulename');
$this->db->select('salesorderline.subtotal as salesorderline__subtotal');
$this->db->select('salesorderline.lastupdate as salesorderline__lastupdate');
$this->db->select('salesorderline.updatedby as salesorderline__updatedby');
$this->db->select('salesorderline.created as salesorderline__created');
$this->db->select('salesorderline.createdby as salesorderline__createdby');
$this->db->order_by('salesorderline__orderid', 'asc');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "rcn.norcn like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.quantity like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.price like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.pdisc like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.updatedby like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.created like '%".$_POST['searchtext']."%'";$where .= " || salesorderline.createdby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		return $data;
	}
	
	function index($salesorder_id=0)
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
		
		$data['foreign_id'] = $salesorder_id;$data['fields'] = array('rcn__norcn' => 'RCN', 'salesorderline__quantity' => 'Quantity', 'salesorderline__price' => 'Price', 'salesorderline__pdisc' => 'Disc %', 'salesorderline__subtotal' => 'SubTotal', 'salesorderline__lastupdate' => 'Last Update', 'salesorderline__updatedby' => 'Last Update By', 'salesorderline__created' => 'Created', 'salesorderline__createdby' => 'Created By');
		
		$data = $this->_qhelp($data, $salesorder_id);
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $salesorder_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		///
		$this->load->view('sales_order_line_service_list_view', $data);
	}
}

?>