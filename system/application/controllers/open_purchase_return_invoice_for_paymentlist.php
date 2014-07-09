<?php

class open_purchase_return_invoice_for_paymentlist extends Controller {

	function open_purchase_return_invoice_for_paymentlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturninvoice');
$this->db->join('supplier', 'supplier.id = purchasereturninvoice.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchasereturninvoice.currency_id', 'left');
$this->db->join('purchasereturnpaymentline', 'purchasereturninvoice.id = purchasereturnpaymentline.purchasereturninvoice_id', 'left');
$this->db->where('purchasereturninvoice.disabled = 0');
$this->db->where('purchasereturnpaymentline.purchasereturninvoice_id is NULL');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchasereturninvoice.supplier_id as purchasereturninvoice__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchasereturninvoice.currency_id as purchasereturninvoice__currency_id', false);
$this->db->select('purchasereturninvoice.id as id', false);
$this->db->select('purchasereturninvoice.id as purchasereturninvoice__id', false);
$this->db->select('DATE_FORMAT(purchasereturninvoice.date, "%d-%m-%Y") as purchasereturninvoice__date', false);
$this->db->select('purchasereturninvoice.purchasereturninvoiceid as purchasereturninvoice__purchasereturninvoiceid', false);
$this->db->select('purchasereturninvoice.total as purchasereturninvoice__total', false);
$this->db->select('purchasereturninvoice.lastupdate as purchasereturninvoice__lastupdate', false);
$this->db->select('purchasereturninvoice.updatedby as purchasereturninvoice__updatedby', false);if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('purchasereturninvoice.supplier_id', $_POST['supplier_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('purchasereturninvoice.currency_id', $_POST['currency_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasereturninvoice.id like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.date like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.purchasereturninvoiceid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.total like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturninvoice.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturninvoice__id', 'asc');
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
		
		$data['fields'] = array('purchasereturninvoice__date' => 'Date', 'purchasereturninvoice__purchasereturninvoiceid' => 'ID', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'purchasereturninvoice__total' => 'Total', 'purchasereturninvoice__lastupdate' => 'Last Update', 'purchasereturninvoice__updatedby' => 'Last Update By');
		
		if (false)
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
		
		
		
		$this->db->from('purchasereturninvoice');$this->db->join('supplier', 'supplier.id = purchasereturninvoice.supplier_id');$this->db->select('supplier_id as id, supplier.firstname as name');$q = $this->db->get();$supplier_opt = array('-1' => 'All');foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->name; }$data['supplier_opt'] = $supplier_opt;foreach ($supplier_opt as $k=>$v) { $data['supplier_id'] = $k; break; }if (isset($_POST['supplier_id']))$data['supplier_id'] = $_POST['supplier_id'];$this->db->from('purchasereturninvoice');$this->db->join('currency', 'currency.id = purchasereturninvoice.currency_id');$this->db->select('currency_id as id, currency.name as name');$q = $this->db->get();$currency_opt = array('-1' => 'All');foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }$data['currency_opt'] = $currency_opt;foreach ($currency_opt as $k=>$v) { $data['currency_id'] = $k; break; }if (isset($_POST['currency_id']))$data['currency_id'] = $_POST['currency_id'];
		}
		///
		$this->load->view('open_purchase_return_invoice_for_payment_list_view', $data);
	}
}

?>