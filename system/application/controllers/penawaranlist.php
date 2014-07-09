<?php

class penawaranlist extends Controller {

	function penawaranlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('salesorderquote');
$this->db->join('customer', 'customer.id = salesorderquote.customer_id', 'left');
$this->db->join('currency', 'currency.id = salesorderquote.currency_id', 'left');
$this->db->join('marketingofficer', 'marketingofficer.id = salesorderquote.marketingofficer_id', 'left');
$this->db->where('salesorderquote.disabled = 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('salesorderquote.customer_id as salesorderquote__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('salesorderquote.currency_id as salesorderquote__currency_id', false);
$this->db->select('marketingofficer.name as marketingofficer__name', false);
$this->db->select('salesorderquote.marketingofficer_id as salesorderquote__marketingofficer_id', false);
$this->db->select('salesorderquote.id as id', false);
$this->db->select('salesorderquote.nopenawaran as salesorderquote__nopenawaran', false);
$this->db->select('salesorderquote.customerponumber as salesorderquote__customerponumber', false);
$this->db->select('DATE_FORMAT(salesorderquote.date, "%d-%m-%Y") as salesorderquote__date', false);
$this->db->select('salesorderquote.notes as salesorderquote__notes', false);
$this->db->select('salesorderquote.currencyrate as salesorderquote__currencyrate', false);
$this->db->select('salesorderquote.status as salesorderquote__status', false);
$this->db->select('salesorderquote.orderid as salesorderquote__orderid', false);
$this->db->select('salesorderquote.modulename as salesorderquote__modulename', false);
$this->db->select('salesorderquote.lastupdate as salesorderquote__lastupdate', false);
$this->db->select('salesorderquote.updatedby as salesorderquote__updatedby', false);if (isset($_POST['status']) && $_POST['status'] != -1)$this->db->where('salesorderquote.status', $_POST['status']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "salesorderquote.nopenawaran like '%".$_POST['searchtext']."%'";$where .= " || salesorderquote.customerponumber like '%".$_POST['searchtext']."%'";$where .= " || salesorderquote.date like '%".$_POST['searchtext']."%'";$where .= " || salesorderquote.notes like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || salesorderquote.currencyrate like '%".$_POST['searchtext']."%'";$where .= " || marketingofficer.name like '%".$_POST['searchtext']."%'";$where .= " || salesorderquote.status like '%".$_POST['searchtext']."%'";$where .= " || salesorderquote.orderid like '%".$_POST['searchtext']."%'";$where .= " || salesorderquote.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || salesorderquote.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('salesorderquote__nopenawaran', 'asc');
$this->db->order_by('salesorderquote__date', 'desc');
$this->db->order_by('salesorderquote__lastupdate', 'desc');
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
		
		$data['fields'] = array('salesorderquote__nopenawaran' => 'No Penawaran', 'salesorderquote__customerponumber' => 'No PO', 'salesorderquote__date' => 'Date', 'salesorderquote__notes' => 'Description', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'salesorderquote__currencyrate' => 'Currency Rate', 'marketingofficer__name' => 'Marketing Officer', 'salesorderquote__status' => 'Status', 'salesorderquote__orderid' => 'SO ID', 'salesorderquote__lastupdate' => 'Last Update', 'salesorderquote__updatedby' => 'Last Update By');
		
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
		
		
		
		$status_opt = array('-1' => 'All');$this->db->from('salesorderquote');$q = $this->db->get();foreach ($q->result_array() as $row) { $status_opt[$row['status']] = $row['status']; }$data['status_opt'] = $status_opt;foreach ($status_opt as $k=>$v) { $data['status'] = $k; break; }if (isset($_POST['status']))$data['status'] = $_POST['status'];
		}
		///
		$this->load->view('penawaran_list_view', $data);
	}
}

?>