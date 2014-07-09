<?php

class customerlist extends Controller {

	function customerlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('customer');
$this->db->join('currency', 'currency.id = customer.currency_id', 'left');
$this->db->join('customergroup', 'customergroup.id = customer.customergroup_id', 'left');
$this->db->join('marketingofficer', 'marketingofficer.id = customer.marketingofficer_id', 'left');
$this->db->where('customer.disabled = 0');
$this->db->select('currency.name as currency__name', false);
$this->db->select('customer.currency_id as customer__currency_id', false);
$this->db->select('customergroup.name as customergroup__name', false);
$this->db->select('customer.customergroup_id as customer__customergroup_id', false);
$this->db->select('marketingofficer.name as marketingofficer__name', false);
$this->db->select('customer.marketingofficer_id as customer__marketingofficer_id', false);
$this->db->select('customer.id as id', false);
$this->db->select('customer.idstring as customer__idstring', false);
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('customer.lastname as customer__lastname', false);
$this->db->select('customer.address as customer__address', false);
$this->db->select('customer.deliveryrecipient as customer__deliveryrecipient', false);
$this->db->select('customer.deliveryaddress as customer__deliveryaddress', false);
$this->db->select('customer.tax_rate as customer__tax_rate', false);
$this->db->select('customer.discount as customer__discount', false);
$this->db->select('customer.top as customer__top', false);
$this->db->select('customer.phone as customer__phone', false);
$this->db->select('customer.fax as customer__fax', false);
$this->db->select('customer.npwp as customer__npwp', false);
$this->db->select('customer.email as customer__email', false);
$this->db->select('customer.website as customer__website', false);
$this->db->select('customer.status as customer__status', false);
$this->db->select('customer.rating as customer__rating', false);
$this->db->select('customer.lastupdate as customer__lastupdate', false);
$this->db->select('customer.updatedby as customer__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "customer.idstring like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || customer.lastname like '%".$_POST['searchtext']."%'";$where .= " || customer.address like '%".$_POST['searchtext']."%'";$where .= " || customer.deliveryrecipient like '%".$_POST['searchtext']."%'";$where .= " || customer.deliveryaddress like '%".$_POST['searchtext']."%'";$where .= " || customer.tax_rate like '%".$_POST['searchtext']."%'";$where .= " || customer.discount like '%".$_POST['searchtext']."%'";$where .= " || customer.top like '%".$_POST['searchtext']."%'";$where .= " || customer.phone like '%".$_POST['searchtext']."%'";$where .= " || customer.fax like '%".$_POST['searchtext']."%'";$where .= " || customer.npwp like '%".$_POST['searchtext']."%'";$where .= " || customer.email like '%".$_POST['searchtext']."%'";$where .= " || customer.website like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || customergroup.name like '%".$_POST['searchtext']."%'";$where .= " || marketingofficer.name like '%".$_POST['searchtext']."%'";$where .= " || customer.status like '%".$_POST['searchtext']."%'";$where .= " || customer.rating like '%".$_POST['searchtext']."%'";$where .= " || customer.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || customer.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('customer__idstring', 'asc');
$this->db->order_by('customer__lastupdate', 'desc');
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
		
		$data['fields'] = array('customer__idstring' => 'Customer ID', 'customer__firstname' => 'First Name', 'customer__lastname' => 'Last Name', 'customer__address' => 'Address', 'customer__deliveryrecipient' => 'Default Delivery Recipient', 'customer__deliveryaddress' => 'Default Delivery Address', 'customer__tax_rate' => 'Default VAT(%)', 'customer__discount' => 'Default Disc(%)', 'customer__top' => 'Default Payment Term', 'customer__phone' => 'Phone', 'customer__fax' => 'Fax', 'customer__npwp' => 'NPWP', 'customer__email' => 'Email', 'customer__website' => 'Website', 'currency__name' => 'Default Currency', 'customergroup__name' => 'Company Group', 'marketingofficer__name' => 'Marketing Officer', 'customer__status' => 'Status Customer', 'customer__rating' => 'Company Rating', 'customer__lastupdate' => 'Last Update', 'customer__updatedby' => 'Last Update By');
		
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
		$this->load->view('customer_list_view', $data);
	}
}

?>