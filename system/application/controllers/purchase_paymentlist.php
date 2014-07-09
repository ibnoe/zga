<?php

class purchase_paymentlist extends Controller {

	function purchase_paymentlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasepayment');
$this->db->join('supplier', 'supplier.id = purchasepayment.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchasepayment.currency_id', 'left');
$this->db->join('cashbank', 'cashbank.id = purchasepayment.cashbank_id', 'left');
$this->db->join('giroout', 'giroout.id = purchasepayment.giroout_id', 'left');
$this->db->join('creditnotein', 'creditnotein.id = purchasepayment.creditnotein_id', 'left');
$this->db->where('purchasepayment.disabled = 0');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchasepayment.supplier_id as purchasepayment__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchasepayment.currency_id as purchasepayment__currency_id', false);
$this->db->select('cashbank.name as cashbank__name', false);
$this->db->select('purchasepayment.cashbank_id as purchasepayment__cashbank_id', false);
$this->db->select('giroout.girooutid as giroout__girooutid', false);
$this->db->select('purchasepayment.giroout_id as purchasepayment__giroout_id', false);
$this->db->select('creditnotein.creditnoteinid as creditnotein__creditnoteinid', false);
$this->db->select('purchasepayment.creditnotein_id as purchasepayment__creditnotein_id', false);
$this->db->select('purchasepayment.id as id', false);
$this->db->select('DATE_FORMAT(purchasepayment.date, "%d-%m-%Y") as purchasepayment__date', false);
$this->db->select('purchasepayment.purchasepaymentid as purchasepayment__purchasepaymentid', false);
$this->db->select('purchasepayment.currencyrate as purchasepayment__currencyrate', false);
$this->db->select('purchasepayment.paymenttype as purchasepayment__paymenttype', false);
$this->db->select('purchasepayment.total as purchasepayment__total', false);
$this->db->select('purchasepayment.totalpay as purchasepayment__totalpay', false);
$this->db->select('purchasepayment.adjustment as purchasepayment__adjustment', false);
$this->db->select('purchasepayment.lastupdate as purchasepayment__lastupdate', false);
$this->db->select('purchasepayment.updatedby as purchasepayment__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasepayment.date like '%".$_POST['searchtext']."%'";$where .= " || purchasepayment.purchasepaymentid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || purchasepayment.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || purchasepayment.paymenttype like '%".$_POST['searchtext']."%'";$where .= " || cashbank.name like '%".$_POST['searchtext']."%'";$where .= " || giroout.girooutid like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.creditnoteinid like '%".$_POST['searchtext']."%'";$where .= " || purchasepayment.total like '%".$_POST['searchtext']."%'";$where .= " || purchasepayment.totalpay like '%".$_POST['searchtext']."%'";$where .= " || purchasepayment.adjustment like '%".$_POST['searchtext']."%'";$where .= " || purchasepayment.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasepayment.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasepayment__date', 'asc');
$this->db->order_by('purchasepayment__date', 'desc');
$this->db->order_by('purchasepayment__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchasepayment__date' => 'Date', 'purchasepayment__purchasepaymentid' => 'Purchase Payment No', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'purchasepayment__currencyrate' => 'Currency Rate', 'purchasepayment__paymenttype' => 'Payment Type', 'cashbank__name' => 'Cash Bank', 'giroout__girooutid' => 'Giro Out', 'creditnotein__creditnoteinid' => 'Credit Note In', 'purchasepayment__total' => 'Amount To Pay', 'purchasepayment__totalpay' => 'Total Payment', 'purchasepayment__adjustment' => 'Adjustment', 'purchasepayment__lastupdate' => 'Last Update', 'purchasepayment__updatedby' => 'Last Update By');
		
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
		
		
		
		
		}
		///
		$this->load->view('purchase_payment_list_view', $data);
	}
}

?>