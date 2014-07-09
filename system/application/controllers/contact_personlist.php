<?php

class contact_personlist extends Controller {

	function contact_personlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $customer_id)
	{
		
$this->db->where('contactperson.customer_id', $customer_id);$this->db->from('contactperson');
$this->db->where('contactperson.disabled = 0');
$this->db->select('contactperson.id as id', false);
$this->db->select('contactperson.idstring as contactperson__idstring', false);
$this->db->select('contactperson.name as contactperson__name', false);
$this->db->select('contactperson.position as contactperson__position', false);
$this->db->select('contactperson.address as contactperson__address', false);
$this->db->select('contactperson.phone as contactperson__phone', false);
$this->db->select('contactperson.fax as contactperson__fax', false);
$this->db->select('contactperson.mobile as contactperson__mobile', false);
$this->db->select('contactperson.email as contactperson__email', false);
$this->db->select('contactperson.bank as contactperson__bank', false);
$this->db->select('contactperson.bankaccno as contactperson__bankaccno', false);
$this->db->select('contactperson.bankbranch as contactperson__bankbranch', false);
$this->db->select('contactperson.status as contactperson__status', false);
$this->db->select('DATE_FORMAT(contactperson.dob, "%d-%m-%Y") as contactperson__dob', false);
$this->db->select('contactperson.children as contactperson__children', false);
$this->db->select('contactperson.lastupdate as contactperson__lastupdate', false);
$this->db->select('contactperson.updatedby as contactperson__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "contactperson.idstring like '%".$_POST['searchtext']."%'";$where .= " || contactperson.name like '%".$_POST['searchtext']."%'";$where .= " || contactperson.position like '%".$_POST['searchtext']."%'";$where .= " || contactperson.address like '%".$_POST['searchtext']."%'";$where .= " || contactperson.phone like '%".$_POST['searchtext']."%'";$where .= " || contactperson.fax like '%".$_POST['searchtext']."%'";$where .= " || contactperson.mobile like '%".$_POST['searchtext']."%'";$where .= " || contactperson.email like '%".$_POST['searchtext']."%'";$where .= " || contactperson.bank like '%".$_POST['searchtext']."%'";$where .= " || contactperson.bankaccno like '%".$_POST['searchtext']."%'";$where .= " || contactperson.bankbranch like '%".$_POST['searchtext']."%'";$where .= " || contactperson.status like '%".$_POST['searchtext']."%'";$where .= " || contactperson.dob like '%".$_POST['searchtext']."%'";$where .= " || contactperson.children like '%".$_POST['searchtext']."%'";$where .= " || contactperson.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || contactperson.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('contactperson__idstring', 'asc');
$this->db->order_by('contactperson__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($customer_id=0)
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
		
		$data['foreign_id'] = $customer_id;$data['fields'] = array('contactperson__idstring' => 'ID', 'contactperson__name' => 'Name', 'contactperson__position' => 'Position', 'contactperson__address' => 'Address', 'contactperson__phone' => 'Phone', 'contactperson__fax' => 'Fax', 'contactperson__mobile' => 'Mobile', 'contactperson__email' => 'Email', 'contactperson__bank' => 'Bank', 'contactperson__bankaccno' => 'Bank Acc No', 'contactperson__bankbranch' => 'Bank Branch', 'contactperson__status' => 'Martial Status', 'contactperson__dob' => 'Date Of Birth', 'contactperson__children' => 'Children', 'contactperson__lastupdate' => 'Last Update', 'contactperson__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $customer_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $customer_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('contact_person_list_view', $data);
	}
}

?>