<?php

class sales_return_payment_linelist extends Controller {

	function sales_return_payment_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $salesreturnpayment_id)
	{
		
$this->db->where('salesreturnpaymentline.salesreturnpayment_id', $salesreturnpayment_id);$this->db->from('salesreturnpaymentline');
$this->db->join('salesreturninvoice', 'salesreturninvoice.id = salesreturnpaymentline.salesreturninvoice_id', 'left');
$this->db->where('salesreturnpaymentline.disabled = 0');
$this->db->select('salesreturninvoice.salesreturninvoiceid as salesreturninvoice__salesreturninvoiceid', false);
$this->db->select('salesreturnpaymentline.salesreturninvoice_id as salesreturnpaymentline__salesreturninvoice_id', false);
$this->db->select('salesreturnpaymentline.id as id', false);
$this->db->select('salesreturnpaymentline.lastupdate as salesreturnpaymentline__lastupdate', false);
$this->db->select('salesreturnpaymentline.updatedby as salesreturnpaymentline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesreturninvoice.salesreturninvoiceid like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpaymentline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesreturnpaymentline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesreturnpaymentline__salesreturninvoice_id', 'asc');
$this->db->order_by('salesreturnpaymentline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($salesreturnpayment_id=0)
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
		
		$data['foreign_id'] = $salesreturnpayment_id;$data['fields'] = array('salesreturninvoice__salesreturninvoiceid' => 'Sales Return Invoice', 'salesreturnpaymentline__lastupdate' => 'Last Update', 'salesreturnpaymentline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $salesreturnpayment_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $salesreturnpayment_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('sales_return_payment_line_list_view', $data);
	}
}

?>