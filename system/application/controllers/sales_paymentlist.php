<?php

class sales_paymentlist extends Controller {

	function sales_paymentlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salespayment');
$this->db->join('customer', 'customer.id = salespayment.customer_id', 'left');
$this->db->join('currency', 'currency.id = salespayment.currency_id', 'left');
$this->db->join('cashbank', 'cashbank.id = salespayment.cashbank_id', 'left');
$this->db->join('giroin', 'giroin.id = salespayment.giroin_id', 'left');
$this->db->join('creditnoteout', 'creditnoteout.id = salespayment.creditnoteout_id', 'left');
$this->db->where('salespayment.disabled = 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salespayment.customer_id as salespayment__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('salespayment.currency_id as salespayment__currency_id', false);
$this->db->select('cashbank.name as cashbank__name', false);
$this->db->select('salespayment.cashbank_id as salespayment__cashbank_id', false);
$this->db->select('giroin.giroinid as giroin__giroinid', false);
$this->db->select('salespayment.giroin_id as salespayment__giroin_id', false);
$this->db->select('creditnoteout.creditnoteoutid as creditnoteout__creditnoteoutid', false);
$this->db->select('salespayment.creditnoteout_id as salespayment__creditnoteout_id', false);
$this->db->select('salespayment.id as id', false);
$this->db->select('DATE_FORMAT(salespayment.date, "%d-%m-%Y") as salespayment__date', false);
$this->db->select('salespayment.orderid as salespayment__orderid', false);
$this->db->select('salespayment.currencyrate as salespayment__currencyrate', false);
$this->db->select('salespayment.paymenttype as salespayment__paymenttype', false);
$this->db->select('salespayment.total as salespayment__total', false);
$this->db->select('salespayment.totalpay as salespayment__totalpay', false);
$this->db->select('salespayment.adjustment as salespayment__adjustment', false);
$this->db->select('salespayment.lastupdate as salespayment__lastupdate', false);
$this->db->select('salespayment.updatedby as salespayment__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salespayment.date like '%".$_POST['searchtext']."%'";$where .= " || salespayment.orderid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || salespayment.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || salespayment.paymenttype like '%".$_POST['searchtext']."%'";$where .= " || cashbank.name like '%".$_POST['searchtext']."%'";$where .= " || giroin.giroinid like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.creditnoteoutid like '%".$_POST['searchtext']."%'";$where .= " || salespayment.total like '%".$_POST['searchtext']."%'";$where .= " || salespayment.totalpay like '%".$_POST['searchtext']."%'";$where .= " || salespayment.adjustment like '%".$_POST['searchtext']."%'";$where .= " || salespayment.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salespayment.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salespayment__date', 'asc');
$this->db->order_by('salespayment__date', 'desc');
$this->db->order_by('salespayment__lastupdate', 'desc');
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
		
		$data['fields'] = array('salespayment__date' => 'Date', 'salespayment__orderid' => 'Sales Payment No', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'salespayment__currencyrate' => 'Currency Rate', 'salespayment__paymenttype' => 'Payment Type', 'cashbank__name' => 'Cash Bank', 'giroin__giroinid' => 'Giro In', 'creditnoteout__creditnoteoutid' => 'Credit Note Out', 'salespayment__total' => 'Amount To Pay', 'salespayment__totalpay' => 'Total Pay', 'salespayment__adjustment' => 'Adjustment', 'salespayment__lastupdate' => 'Last Update', 'salespayment__updatedby' => 'Last Update By');
		
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
		$this->load->view('sales_payment_list_view', $data);
	}
}

?>