<?php

class purchase_return_invoice_line_viewlist extends Controller {

	function purchase_return_invoice_line_viewlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $purchasereturninvoice_id)
	{
		
$this->db->where('purchasereturninvoiceline.purchasereturninvoice_id', $purchasereturninvoice_id);$this->db->from('purchasereturninvoiceline');
$this->db->join('item', 'item.id = purchasereturninvoiceline.item_id', 'left');
$this->db->join('uom', 'uom.id = purchasereturninvoiceline.uom_id', 'left');
$this->db->where('purchasereturninvoiceline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('purchasereturninvoiceline.item_id as purchasereturninvoiceline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchasereturninvoiceline.uom_id as purchasereturninvoiceline__uom_id', false);
$this->db->select('purchasereturninvoiceline.id as id', false);
$this->db->select('purchasereturninvoiceline.quantity as purchasereturninvoiceline__quantity', false);
$this->db->select('purchasereturninvoiceline.price as purchasereturninvoiceline__price', false);
$this->db->select('purchasereturninvoiceline.purchasereturnorderline_id as purchasereturninvoiceline__purchasereturnorderline_id', false);
$this->db->select('purchasereturninvoiceline.subtotal as purchasereturninvoiceline__subtotal', false);
$this->db->select('purchasereturninvoiceline.lastupdate as purchasereturninvoiceline__lastupdate', false);
$this->db->select('purchasereturninvoiceline.updatedby as purchasereturninvoiceline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoiceline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoiceline.price like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoiceline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoiceline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoiceline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturninvoiceline__item_id', 'asc');
$this->db->order_by('purchasereturninvoiceline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($purchasereturninvoice_id=0)
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
		
		$data['foreign_id'] = $purchasereturninvoice_id;$data['fields'] = array('item__name' => 'Item', 'purchasereturninvoiceline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'purchasereturninvoiceline__price' => 'Price', 'purchasereturninvoiceline__subtotal' => 'SubTotal', 'purchasereturninvoiceline__lastupdate' => 'Last Update', 'purchasereturninvoiceline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $purchasereturninvoice_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $purchasereturninvoice_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		///
		$this->load->view('purchase_return_invoice_line_view_list_view', $data);
	}
}

?>