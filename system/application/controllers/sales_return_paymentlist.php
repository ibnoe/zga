<?php

class sales_return_paymentlist extends Controller {

	function sales_return_paymentlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesreturnpayment');
$this->db->join('customer', 'customer.id = salesreturnpayment.customer_id', 'left');
$this->db->join('currency', 'currency.id = salesreturnpayment.currency_id', 'left');
$this->db->join('cashbank', 'cashbank.id = salesreturnpayment.cashbank_id', 'left');
$this->db->join('giroout', 'giroout.id = salesreturnpayment.giroout_id', 'left');
$this->db->join('creditnoteout', 'creditnoteout.id = salesreturnpayment.creditnoteout_id', 'left');
$this->db->where('salesreturnpayment.disabled = 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesreturnpayment.customer_id as salesreturnpayment__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('salesreturnpayment.currency_id as salesreturnpayment__currency_id', false);
$this->db->select('cashbank.name as cashbank__name', false);
$this->db->select('salesreturnpayment.cashbank_id as salesreturnpayment__cashbank_id', false);
$this->db->select('giroout.girooutid as giroout__girooutid', false);
$this->db->select('salesreturnpayment.giroout_id as salesreturnpayment__giroout_id', false);
$this->db->select('creditnoteout.creditnoteoutid as creditnoteout__creditnoteoutid', false);
$this->db->select('salesreturnpayment.creditnoteout_id as salesreturnpayment__creditnoteout_id', false);
$this->db->select('salesreturnpayment.id as id', false);
$this->db->select('DATE_FORMAT(salesreturnpayment.date, "%d-%m-%Y") as salesreturnpayment__date', false);
$this->db->select('salesreturnpayment.salesreturnpaymentid as salesreturnpayment__salesreturnpaymentid', false);
$this->db->select('salesreturnpayment.currencyrate as salesreturnpayment__currencyrate', false);
$this->db->select('salesreturnpayment.paymenttype as salesreturnpayment__paymenttype', false);
$this->db->select('salesreturnpayment.total as salesreturnpayment__total', false);
$this->db->select('salesreturnpayment.totalpay as salesreturnpayment__totalpay', false);
$this->db->select('salesreturnpayment.adjustment as salesreturnpayment__adjustment', false);
$this->db->select('salesreturnpayment.lastupdate as salesreturnpayment__lastupdate', false);
$this->db->select('salesreturnpayment.updatedby as salesreturnpayment__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesreturnpayment.date like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpayment.salesreturnpaymentid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpayment.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpayment.paymenttype like '%".$_POST['searchtext']."%'";$where .= " || cashbank.name like '%".$_POST['searchtext']."%'";$where .= " || giroout.girooutid like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.creditnoteoutid like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpayment.total like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpayment.totalpay like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpayment.adjustment like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpayment.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpayment.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturnpayment__date', 'asc');
$this->db->order_by('salesreturnpayment__date', 'desc');
$this->db->order_by('salesreturnpayment__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesreturnpayment__date' => 'Date', 'salesreturnpayment__salesreturnpaymentid' => 'ID', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'salesreturnpayment__currencyrate' => 'Currency Rate', 'salesreturnpayment__paymenttype' => 'Payment Type', 'cashbank__name' => 'Cash Bank', 'giroout__girooutid' => 'Giro Out', 'creditnoteout__creditnoteoutid' => 'Credit Note Out', 'salesreturnpayment__total' => 'Amount To Pay', 'salesreturnpayment__totalpay' => 'Total Pay', 'salesreturnpayment__adjustment' => 'Adjustment', 'salesreturnpayment__lastupdate' => 'Last Update', 'salesreturnpayment__updatedby' => 'Last Update By');
		
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
		$this->load->view('sales_return_payment_list_view', $data);
	}
}

?>