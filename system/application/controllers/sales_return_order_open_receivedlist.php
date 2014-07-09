<?php

class sales_return_order_open_receivedlist extends Controller {

	function sales_return_order_open_receivedlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesreturnorder');
$this->db->join('customer', 'customer.id = salesreturnorder.customer_id', 'left');
$this->db->join('currency', 'currency.id = salesreturnorder.currency_id', 'left');
$this->db->where('salesreturnorder.disabled = 0');
$this->db->where('salesreturnorder.totalquantity > salesreturnorder.totalquantitysent');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesreturnorder.customer_id as salesreturnorder__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('salesreturnorder.currency_id as salesreturnorder__currency_id', false);
$this->db->select('salesreturnorder.id as id', false);
$this->db->select('DATE_FORMAT(salesreturnorder.date, "%d-%m-%Y") as salesreturnorder__date', false);
$this->db->select('salesreturnorder.salesreturnorderid as salesreturnorder__salesreturnorderid', false);
$this->db->select('salesreturnorder.currencyrate as salesreturnorder__currencyrate', false);
$this->db->select('salesreturnorder.notes as salesreturnorder__notes', false);
$this->db->select('salesreturnorder.lastupdate as salesreturnorder__lastupdate', false);
$this->db->select('salesreturnorder.updatedby as salesreturnorder__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesreturnorder.date like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorder.salesreturnorderid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorder.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorder.notes like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturnorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturnorder__date', 'asc');
$this->db->order_by('salesreturnorder__date', 'desc');
$this->db->order_by('salesreturnorder__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesreturnorder__date' => 'Date', 'salesreturnorder__salesreturnorderid' => 'Return ID', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'salesreturnorder__currencyrate' => 'Currency Rate', 'salesreturnorder__notes' => 'Notes', 'salesreturnorder__lastupdate' => 'Last Update', 'salesreturnorder__updatedby' => 'Last Update By');
		
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
		$this->load->view('sales_return_order_open_received_list_view', $data);
	}
}

?>