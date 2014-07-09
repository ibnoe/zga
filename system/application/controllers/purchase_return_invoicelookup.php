<?php

class purchase_return_invoicelookup extends Controller {

	function purchase_return_invoicelookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturninvoice');
$this->db->join('purchasereturndelivery', 'purchasereturndelivery.id = purchasereturninvoice.purchasereturndelivery_id', 'left');
$this->db->where('purchasereturninvoice.disabled = 0');
$this->db->select('purchasereturndelivery.purchasereturndeliveryid as purchasereturndelivery__purchasereturndeliveryid', false);
$this->db->select('purchasereturninvoice.purchasereturndelivery_id as purchasereturninvoice__purchasereturndelivery_id', false);
$this->db->select('purchasereturninvoice.id as id', false);
$this->db->select('DATE_FORMAT(purchasereturninvoice.date, "%d-%m-%Y") as purchasereturninvoice__date', false);
$this->db->select('purchasereturninvoice.purchasereturninvoiceid as purchasereturninvoice__purchasereturninvoiceid', false);
$this->db->select('purchasereturninvoice.supplier_id as purchasereturninvoice__supplier_id', false);
$this->db->select('purchasereturninvoice.currency_id as purchasereturninvoice__currency_id', false);
$this->db->select('purchasereturninvoice.currencyrate as purchasereturninvoice__currencyrate', false);
$this->db->select('purchasereturninvoice.total as purchasereturninvoice__total', false);
$this->db->select('purchasereturninvoice.lastupdate as purchasereturninvoice__lastupdate', false);
$this->db->select('purchasereturninvoice.updatedby as purchasereturninvoice__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasereturninvoice.date like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.purchasereturninvoiceid like '%".$_POST['searchtext']."%'";$where .= " || purchasereturndelivery.purchasereturndeliveryid like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.total like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturninvoice__date', 'asc');
$this->db->order_by('purchasereturninvoice__date', 'desc');
$this->db->order_by('purchasereturninvoice__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchasereturninvoice__date' => 'Date', 'purchasereturninvoice__purchasereturninvoiceid' => 'Invoice No', 'purchasereturndelivery__purchasereturndeliveryid' => 'Purchase Return Delivery', 'purchasereturninvoice__total' => 'Total', 'purchasereturninvoice__lastupdate' => 'Last Update', 'purchasereturninvoice__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_return_invoice_lookup_view', $data);
	}
}

?>