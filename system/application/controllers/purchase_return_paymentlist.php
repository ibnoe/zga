<?php

class purchase_return_paymentlist extends Controller {

	function purchase_return_paymentlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('purchasereturnpayment');
$this->db->join('supplier', 'supplier.id = purchasereturnpayment.supplier_id', 'left');
$this->db->join('currency', 'currency.id = purchasereturnpayment.currency_id', 'left');
$this->db->join('cashbank', 'cashbank.id = purchasereturnpayment.cashbank_id', 'left');
$this->db->join('giroin', 'giroin.id = purchasereturnpayment.giroin_id', 'left');
$this->db->join('creditnotein', 'creditnotein.id = purchasereturnpayment.creditnotein_id', 'left');
$this->db->where('purchasereturnpayment.disabled = 0');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('purchasereturnpayment.supplier_id as purchasereturnpayment__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('purchasereturnpayment.currency_id as purchasereturnpayment__currency_id', false);
$this->db->select('cashbank.name as cashbank__name', false);
$this->db->select('purchasereturnpayment.cashbank_id as purchasereturnpayment__cashbank_id', false);
$this->db->select('giroin.giroinid as giroin__giroinid', false);
$this->db->select('purchasereturnpayment.giroin_id as purchasereturnpayment__giroin_id', false);
$this->db->select('creditnotein.creditnoteinid as creditnotein__creditnoteinid', false);
$this->db->select('purchasereturnpayment.creditnotein_id as purchasereturnpayment__creditnotein_id', false);
$this->db->select('purchasereturnpayment.id as id', false);
$this->db->select('DATE_FORMAT(purchasereturnpayment.date, "%d-%m-%Y") as purchasereturnpayment__date', false);
$this->db->select('purchasereturnpayment.purchasereturnpaymentid as purchasereturnpayment__purchasereturnpaymentid', false);
$this->db->select('purchasereturnpayment.currencyrate as purchasereturnpayment__currencyrate', false);
$this->db->select('purchasereturnpayment.paymenttype as purchasereturnpayment__paymenttype', false);
$this->db->select('purchasereturnpayment.total as purchasereturnpayment__total', false);
$this->db->select('purchasereturnpayment.totalpay as purchasereturnpayment__totalpay', false);
$this->db->select('purchasereturnpayment.adjustment as purchasereturnpayment__adjustment', false);
$this->db->select('purchasereturnpayment.lastupdate as purchasereturnpayment__lastupdate', false);
$this->db->select('purchasereturnpayment.updatedby as purchasereturnpayment__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "purchasereturnpayment.date like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpayment.purchasereturnpaymentid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpayment.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpayment.paymenttype like '%".$_POST['searchtext']."%'";$where .= " || cashbank.name like '%".$_POST['searchtext']."%'";$where .= " || giroin.giroinid like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.creditnoteinid like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpayment.total like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpayment.totalpay like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpayment.adjustment like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpayment.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || purchasereturnpayment.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('purchasereturnpayment__date', 'asc');
$this->db->order_by('purchasereturnpayment__date', 'desc');
$this->db->order_by('purchasereturnpayment__lastupdate', 'desc');
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
		
		$data['fields'] = array('purchasereturnpayment__date' => 'Date', 'purchasereturnpayment__purchasereturnpaymentid' => 'ID', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'purchasereturnpayment__currencyrate' => 'Currency Rate', 'purchasereturnpayment__paymenttype' => 'Payment Type', 'cashbank__name' => 'Cash Bank', 'giroin__giroinid' => 'Giro In', 'creditnotein__creditnoteinid' => 'Credit Note In', 'purchasereturnpayment__total' => 'Amount To Pay', 'purchasereturnpayment__totalpay' => 'Total Pay', 'purchasereturnpayment__adjustment' => 'Adjustment', 'purchasereturnpayment__lastupdate' => 'Last Update', 'purchasereturnpayment__updatedby' => 'Last Update By');
		
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
		$this->load->view('purchase_return_payment_list_view', $data);
	}
}

?>