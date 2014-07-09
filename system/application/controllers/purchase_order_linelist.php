<?php

class purchase_order_linelist extends Controller {

	function purchase_order_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $purchaseorder_id)
	{
		
$this->db->where('purchaseorderline.purchaseorder_id', $purchaseorder_id);$this->db->from('purchaseorderline');
$this->db->join('item', 'item.id = purchaseorderline.item_id', 'left');
$this->db->join('warehouse', 'warehouse.id = purchaseorderline.warehouse_id', 'left');
$this->db->join('uom', 'uom.id = purchaseorderline.uom_id', 'left');
$this->db->where('purchaseorderline.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('purchaseorderline.item_id as purchaseorderline__item_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('purchaseorderline.warehouse_id as purchaseorderline__warehouse_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('purchaseorderline.uom_id as purchaseorderline__uom_id', false);
$this->db->select('purchaseorderline.id as id', false);
$this->db->select('purchaseorderline.orderid as purchaseorderline__orderid', false);
$this->db->select('purchaseorderline.date as purchaseorderline__date', false);
$this->db->select('purchaseorderline.notes as purchaseorderline__notes', false);
$this->db->select('purchaseorderline.supplier_id as purchaseorderline__supplier_id', false);
$this->db->select('purchaseorderline.currency_id as purchaseorderline__currency_id', false);
$this->db->select('purchaseorderline.currencyrate as purchaseorderline__currencyrate', false);
$this->db->select('purchaseorderline.warehouse_id as purchaseorderline__warehouse_id', false);
$this->db->select('purchaseorderline.quantity as purchaseorderline__quantity', false);
$this->db->select('purchaseorderline.price as purchaseorderline__price', false);
$this->db->select('purchaseorderline.hasppn as purchaseorderline__hasppn', false);
$this->db->select('purchaseorderline.pph as purchaseorderline__pph', false);
$this->db->select('purchaseorderline.subtotal as purchaseorderline__subtotal', false);
$this->db->select('purchaseorderline.lastupdate as purchaseorderline__lastupdate', false);
$this->db->select('purchaseorderline.updatedby as purchaseorderline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.price like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.hasppn like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.pph like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.subtotal like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchaseorderline__orderid', 'asc');
$this->db->order_by('purchaseorderline__date', 'desc');
$this->db->order_by('purchaseorderline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($purchaseorder_id=0)
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
		
		$data['foreign_id'] = $purchaseorder_id;$data['fields'] = array('item__name' => 'Item', 'warehouse__name' => 'Ship To Location', 'purchaseorderline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'purchaseorderline__price' => 'Price', 'purchaseorderline__hasppn' => 'PPN?', 'purchaseorderline__pph' => 'PPH %', 'purchaseorderline__subtotal' => 'SubTotal', 'purchaseorderline__lastupdate' => 'Last Update', 'purchaseorderline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $purchaseorder_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $purchaseorder_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('purchase_order_line_list_view', $data);
	}
}

?>