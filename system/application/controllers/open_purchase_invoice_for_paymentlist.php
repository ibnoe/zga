<?php

class open_purchase_invoice_for_paymentlist extends Controller {

	function open_purchase_invoice_for_paymentlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchaseinvoice');
$this->db->join('supplier', 'supplier.id = purchaseinvoice.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchaseinvoice.currency_id', 'left');
$this->db->join('purchasepaymentline', 'purchaseinvoice.id = purchasepaymentline.purchaseinvoice_id', 'left');
$this->db->where('purchaseinvoice.disabled = 0');
$this->db->where('purchasepaymentline.purchaseinvoice_id is NULL');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchaseinvoice.supplier_id as purchaseinvoice__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchaseinvoice.currency_id as purchaseinvoice__currency_id', false);
$this->db->select('purchaseinvoice.id as id', false);
$this->db->select('purchaseinvoice.id as purchaseinvoice__id', false);
$this->db->select('DATE_FORMAT(purchaseinvoice.date, "%d-%m-%Y") as purchaseinvoice__date', false);
$this->db->select('purchaseinvoice.orderid as purchaseinvoice__orderid', false);
$this->db->select('purchaseinvoice.total as purchaseinvoice__total', false);
$this->db->select('purchaseinvoice.lastupdate as purchaseinvoice__lastupdate', false);
$this->db->select('purchaseinvoice.updatedby as purchaseinvoice__updatedby', false);if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('purchaseinvoice.supplier_id', $_POST['supplier_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('purchaseinvoice.currency_id', $_POST['currency_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchaseinvoice.id like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.date like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.orderid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.total like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchaseinvoice.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchaseinvoice__id', 'asc');
$this->db->order_by('purchaseinvoice__date', 'desc');
$this->db->order_by('purchaseinvoice__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchaseinvoice__date' => 'Date', 'purchaseinvoice__orderid' => 'Purchase Invoice No', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'purchaseinvoice__total' => 'Total', 'purchaseinvoice__lastupdate' => 'Last Update', 'purchaseinvoice__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('purchaseinvoice');$this->db->join('supplier', 'supplier.id = purchaseinvoice.supplier_id');$this->db->select('supplier_id as id, supplier.firstname as name');$q = $this->db->get();$supplier_opt = array('-1' => 'All');foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->name; }$data['supplier_opt'] = $supplier_opt;foreach ($supplier_opt as $k=>$v) { $data['supplier_id'] = $k; break; }if (isset($_POST['supplier_id']))$data['supplier_id'] = $_POST['supplier_id'];$this->db->from('purchaseinvoice');$this->db->join('currency', 'currency.id = purchaseinvoice.currency_id');$this->db->select('currency_id as id, currency.name as name');$q = $this->db->get();$currency_opt = array('-1' => 'All');foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }$data['currency_opt'] = $currency_opt;foreach ($currency_opt as $k=>$v) { $data['currency_id'] = $k; break; }if (isset($_POST['currency_id']))$data['currency_id'] = $_POST['currency_id'];
		}
		///
		$this->load->view('open_purchase_invoice_for_payment_list_view', $data);
	}
}

?>