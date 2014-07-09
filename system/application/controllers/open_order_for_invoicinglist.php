<?php

class open_order_for_invoicinglist extends Controller {

	function open_order_for_invoicinglist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchaseorderline');
$this->db->join('supplier', 'supplier.id = purchaseorderline.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchaseorderline.currency_id', 'left');
$this->db->join('item', 'item.id = purchaseorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = purchaseorderline.uom_id', 'left');
$this->db->join('purchaseinvoiceline', 'purchaseorderline.id = purchaseinvoiceline.purchaseorderline_id', 'left');
$this->db->where('purchaseorderline.disabled = 0');
$this->db->where('purchaseinvoiceline.purchaseorderline_id is NULL');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchaseorderline.supplier_id as purchaseorderline__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchaseorderline.currency_id as purchaseorderline__currency_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('purchaseorderline.item_id as purchaseorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchaseorderline.uom_id as purchaseorderline__uom_id', false);
$this->db->select('purchaseorderline.id as id', false);
$this->db->select('purchaseorderline.id as purchaseorderline__id', false);
$this->db->select('DATE_FORMAT(purchaseorderline.date, "%d-%m-%Y") as purchaseorderline__date', false);
$this->db->select('purchaseorderline.orderid as purchaseorderline__orderid', false);
$this->db->select('purchaseorderline.quantity as purchaseorderline__quantity', false);
$this->db->select('purchaseorderline.price as purchaseorderline__price', false);
$this->db->select('purchaseorderline.subtotal as purchaseorderline__subtotal', false);
$this->db->select('purchaseorderline.lastupdate as purchaseorderline__lastupdate', false);
$this->db->select('purchaseorderline.updatedby as purchaseorderline__updatedby', false);if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('purchaseorderline.supplier_id', $_POST['supplier_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('purchaseorderline.currency_id', $_POST['currency_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchaseorderline.id like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.date like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.orderid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.price like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchaseorderline__id', 'asc');
$this->db->order_by('purchaseorderline__date', 'desc');
$this->db->order_by('purchaseorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchaseorderline__date' => 'Date', 'purchaseorderline__orderid' => 'PO ID', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'item__name' => 'Item', 'purchaseorderline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'purchaseorderline__price' => 'Price', 'purchaseorderline__subtotal' => 'SubTotal', 'purchaseorderline__lastupdate' => 'Last Update', 'purchaseorderline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		$this->db->from('purchaseorderline');$this->db->join('supplier', 'supplier.id = purchaseorderline.supplier_id');$this->db->select('supplier_id as id, supplier.firstname as name');$q = $this->db->get();$supplier_opt = array('-1' => 'All');foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->name; }$data['supplier_opt'] = $supplier_opt;foreach ($supplier_opt as $k=>$v) { $data['supplier_id'] = $k; break; }if (isset($_POST['supplier_id']))$data['supplier_id'] = $_POST['supplier_id'];$this->db->from('purchaseorderline');$this->db->join('currency', 'currency.id = purchaseorderline.currency_id');$this->db->select('currency_id as id, currency.name as name');$q = $this->db->get();$currency_opt = array('-1' => 'All');foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }$data['currency_opt'] = $currency_opt;foreach ($currency_opt as $k=>$v) { $data['currency_id'] = $k; break; }if (isset($_POST['currency_id']))$data['currency_id'] = $_POST['currency_id'];
		///
		$this->load->view('open_order_for_invoicing_list_view', $data);
	}
}

?>