<?php

class purchase_order_quote_linelist extends Controller {

	function purchase_order_quote_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $purchaseorderquote_id)
	{
		
$this->db->where('purchaseorderquoteline.purchaseorderquote_id', $purchaseorderquote_id);$this->db->from('purchaseorderquoteline');
$this->db->join('item', 'purchaseorderquoteline.item_id = item.id', 'left');

$this->db->join('uom', 'purchaseorderquoteline.uom_id = uom.id', 'left');

$this->db->select('purchaseorderquoteline.item_id as purchaseorderquoteline__item_id');
$this->db->select('item.name as item__name');
$this->db->select('purchaseorderquoteline.quantity as purchaseorderquoteline__quantity');
$this->db->select('purchaseorderquoteline.uom_id as purchaseorderquoteline__uom_id');
$this->db->select('uom.name as uom__name');
$this->db->select('purchaseorderquoteline.price as purchaseorderquoteline__price');
$this->db->select('purchaseorderquoteline.subtotal as purchaseorderquoteline__subtotal');
$this->db->select('purchaseorderquoteline.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderquoteline.quantity like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderquoteline.price like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderquoteline.subtotal like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		return $data;
	}
	
	function index($purchaseorderquote_id=0)
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
		
		$data['foreign_id'] = $purchaseorderquote_id;$data['fields'] = array('item__name' => 'Item', 'purchaseorderquoteline__quantity' => 'Quantity', 'uom__name' => 'Unit', 'purchaseorderquoteline__price' => 'Price', 'purchaseorderquoteline__subtotal' => 'SubTotal');
		
		$data = $this->_qhelp($data, $purchaseorderquote_id);
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $purchaseorderquote_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		///
		$this->load->view('purchase_order_quote_line_list_view', $data);
	}
}

?>