<?php

class purchase_return_order_for_invoicinglist extends Controller {

	function purchase_return_order_for_invoicinglist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturnorderline');
$this->db->join('supplier', 'supplier.id = purchasereturnorderline.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchasereturnorderline.currency_id', 'left');
$this->db->join('item', 'item.id = purchasereturnorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = purchasereturnorderline.uom_id', 'left');
$this->db->join('purchasereturninvoiceline', 'purchasereturnorderline.id = purchasereturninvoiceline.purchasereturnorderline_id', 'left');
$this->db->where('purchasereturnorderline.disabled = 0');
$this->db->where('purchasereturninvoiceline.purchasereturnorderline_id is NULL');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchasereturnorderline.supplier_id as purchasereturnorderline__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchasereturnorderline.currency_id as purchasereturnorderline__currency_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('purchasereturnorderline.item_id as purchasereturnorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchasereturnorderline.uom_id as purchasereturnorderline__uom_id', false);
$this->db->select('purchasereturnorderline.id as id', false);
$this->db->select('purchasereturnorderline.id as purchasereturnorderline__id', false);
$this->db->select('DATE_FORMAT(purchasereturnorderline.date, "%d-%m-%Y") as purchasereturnorderline__date', false);
$this->db->select('purchasereturnorderline.purchasereturnorderid as purchasereturnorderline__purchasereturnorderid', false);
$this->db->select('purchasereturnorderline.quantitytosend as purchasereturnorderline__quantitytosend', false);
$this->db->select('purchasereturnorderline.lastupdate as purchasereturnorderline__lastupdate', false);
$this->db->select('purchasereturnorderline.updatedby as purchasereturnorderline__updatedby', false);if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('purchasereturnorderline.supplier_id', $_POST['supplier_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('purchasereturnorderline.currency_id', $_POST['currency_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasereturnorderline.id like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.date like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.purchasereturnorderid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.quantitytosend like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturnorderline__id', 'asc');
$this->db->order_by('purchasereturnorderline__date', 'desc');
$this->db->order_by('purchasereturnorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchasereturnorderline__date' => 'Date', 'purchasereturnorderline__purchasereturnorderid' => 'ID', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'item__name' => 'Item', 'purchasereturnorderline__quantitytosend' => 'Quantity', 'uom__name' => 'Unit', 'purchasereturnorderline__lastupdate' => 'Last Update', 'purchasereturnorderline__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		$this->db->from('purchasereturnorderline');$this->db->join('supplier', 'supplier.id = purchasereturnorderline.supplier_id');$this->db->select('supplier_id as id, supplier.firstname as name');$q = $this->db->get();$supplier_opt = array('-1' => 'All');foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->name; }$data['supplier_opt'] = $supplier_opt;foreach ($supplier_opt as $k=>$v) { $data['supplier_id'] = $k; break; }if (isset($_POST['supplier_id']))$data['supplier_id'] = $_POST['supplier_id'];$this->db->from('purchasereturnorderline');$this->db->join('currency', 'currency.id = purchasereturnorderline.currency_id');$this->db->select('currency_id as id, currency.name as name');$q = $this->db->get();$currency_opt = array('-1' => 'All');foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }$data['currency_opt'] = $currency_opt;foreach ($currency_opt as $k=>$v) { $data['currency_id'] = $k; break; }if (isset($_POST['currency_id']))$data['currency_id'] = $_POST['currency_id'];
		///
		$this->load->view('purchase_return_order_for_invoicing_list_view', $data);
	}
}

?>