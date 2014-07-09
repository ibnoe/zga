<?php

class purchase_return_delivery_for_invoicelookup extends Controller {

	function purchase_return_delivery_for_invoicelookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturndelivery');
$this->db->join('supplier', 'supplier.id = purchasereturndelivery.supplier_id', 'left');
$this->db->join('warehouse', 'warehouse.id = purchasereturndelivery.warehouse_id', 'left');
$this->db->join('purchasereturninvoice', 'purchasereturndelivery.id = purchasereturninvoice.purchasereturndelivery_id', 'left');
$this->db->where('purchasereturndelivery.disabled = 0');
$this->db->where('purchasereturninvoice.purchasereturndelivery_id is NULL');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchasereturndelivery.supplier_id as purchasereturndelivery__supplier_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('purchasereturndelivery.warehouse_id as purchasereturndelivery__warehouse_id', false);
$this->db->select('purchasereturndelivery.id as id', false);
$this->db->select('DATE_FORMAT(purchasereturndelivery.date, "%d-%m-%Y") as purchasereturndelivery__date', false);
$this->db->select('purchasereturndelivery.purchasereturndeliveryid as purchasereturndelivery__purchasereturndeliveryid', false);
$this->db->select('purchasereturndelivery.notes as purchasereturndelivery__notes', false);
$this->db->select('purchasereturndelivery.lastupdate as purchasereturndelivery__lastupdate', false);
$this->db->select('purchasereturndelivery.updatedby as purchasereturndelivery__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasereturndelivery.date like '%".$_POST['searchtext']."%'";$where .= " || purchasereturndelivery.purchasereturndeliveryid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturndelivery.notes like '%".$_POST['searchtext']."%'";$where .= " || purchasereturndelivery.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturndelivery.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturndelivery__date', 'asc');
$this->db->order_by('purchasereturndelivery__date', 'desc');
$this->db->order_by('purchasereturndelivery__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchasereturndelivery__date' => 'Date', 'purchasereturndelivery__purchasereturndeliveryid' => 'Delivery No', 'supplier__firstname' => 'Supplier', 'warehouse__name' => 'Warehouse', 'purchasereturndelivery__notes' => 'Notes', 'purchasereturndelivery__lastupdate' => 'Last Update', 'purchasereturndelivery__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_return_delivery_for_invoice_lookup_view', $data);
	}
}

?>