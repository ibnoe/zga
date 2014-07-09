<?php

class purchase_order_quotelist extends Controller {

	function purchase_order_quotelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchaseorderquote');
$this->db->join('suratpermintaanpembelian', 'purchaseorderquote.suratpermintaanpembelian_id = suratpermintaanpembelian.id', 'left');

$this->db->join('supplier', 'purchaseorderquote.supplier_id = supplier.id', 'left');

$this->db->join('currency', 'purchaseorderquote.currency_id = currency.id', 'left');

$this->db->join('warehouse', 'purchaseorderquote.warehouse_id = warehouse.id', 'left');

$this->db->select('purchaseorderquote.orderid as purchaseorderquote__orderid');
$this->db->select('purchaseorderquote.date as purchaseorderquote__date');
$this->db->select('purchaseorderquote.notes as purchaseorderquote__notes');
$this->db->select('purchaseorderquote.suratpermintaanpembelian_id as purchaseorderquote__suratpermintaanpembelian_id');
$this->db->select('suratpermintaanpembelian.orderid as suratpermintaanpembelian__orderid');
$this->db->select('purchaseorderquote.supplier_id as purchaseorderquote__supplier_id');
$this->db->select('supplier.firstname as supplier__firstname');
$this->db->select('purchaseorderquote.currency_id as purchaseorderquote__currency_id');
$this->db->select('currency.name as currency__name');
$this->db->select('purchaseorderquote.currencyrate as purchaseorderquote__currencyrate');
$this->db->select('purchaseorderquote.warehouse_id as purchaseorderquote__warehouse_id');
$this->db->select('warehouse.name as warehouse__name');
$this->db->select('purchaseorderquote.id as id');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchaseorderquote.orderid like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderquote.date like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderquote.notes like '%".$_POST['searchtext']."%'";$where .= " || suratpermintaanpembelian.orderid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseorderquote.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
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
		
		$data['fields'] = array('purchaseorderquote__orderid' => 'No PO Quote', 'purchaseorderquote__date' => 'Date', 'purchaseorderquote__notes' => 'Description', 'suratpermintaanpembelian__orderid' => 'SPP', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'purchaseorderquote__currencyrate' => 'Currency Rate', 'warehouse__name' => 'Ship To Location');
		
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
		$this->load->view('purchase_order_quote_list_view', $data);
	}
}

?>