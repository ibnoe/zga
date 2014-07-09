<?php

class purchase_invoice_linelist extends Controller {

	function purchase_invoice_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchaseinvoiceline');
$this->db->join('item', 'item.id = purchaseinvoiceline.item_id', 'left');
$this->db->join('uom', 'uom.id = purchaseinvoiceline.uom_id', 'left');
$this->db->where('purchaseinvoiceline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('purchaseinvoiceline.item_id as purchaseinvoiceline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchaseinvoiceline.uom_id as purchaseinvoiceline__uom_id', false);
$this->db->select('purchaseinvoiceline.id as id', false);
$this->db->select('purchaseinvoiceline.quantity as purchaseinvoiceline__quantity', false);
$this->db->select('purchaseinvoiceline.price as purchaseinvoiceline__price', false);
$this->db->select('purchaseinvoiceline.purchaseorderline_id as purchaseinvoiceline__purchaseorderline_id', false);
$this->db->select('purchaseinvoiceline.subtotal as purchaseinvoiceline__subtotal', false);
$this->db->select('purchaseinvoiceline.lastupdate as purchaseinvoiceline__lastupdate', false);
$this->db->select('purchaseinvoiceline.updatedby as purchaseinvoiceline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoiceline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoiceline.price like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoiceline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoiceline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoiceline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchaseinvoiceline__item_id', 'asc');
$this->db->order_by('purchaseinvoiceline__lastupdate', 'desc');
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
		
		$data['fields'] = array('item__name' => 'Item', 'purchaseinvoiceline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'purchaseinvoiceline__price' => 'Price', 'purchaseinvoiceline__subtotal' => 'SubTotal', 'purchaseinvoiceline__lastupdate' => 'Last Update', 'purchaseinvoiceline__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_invoice_line_list_view', $data);
	}
}

?>