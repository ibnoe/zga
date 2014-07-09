<?php

class supplier_3lookup extends Controller {

	function supplier_3lookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('supplier');
$this->db->join('currency', 'currency.id = supplier.currency_id', 'left');
$this->db->where('supplier.disabled = 0');
$this->db->select('currency.name as currency__name', false);
$this->db->select('supplier.currency_id as supplier__currency_id', false);
$this->db->select('supplier.id as id', false);
$this->db->select('supplier.idstring as supplier__idstring', false);
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('supplier.lastname as supplier__lastname', false);
$this->db->select('supplier.address as supplier__address', false);
$this->db->select('supplier.phone as supplier__phone', false);
$this->db->select('supplier.fax as supplier__fax', false);
$this->db->select('supplier.npwp as supplier__npwp', false);
$this->db->select('supplier.email as supplier__email', false);
$this->db->select('supplier.firmtype as supplier__firmtype', false);
$this->db->select('supplier.contactperson as supplier__contactperson', false);
$this->db->select('supplier.hpcontactperson as supplier__hpcontactperson', false);
$this->db->select('supplier.barang as supplier__barang', false);
$this->db->select('supplier.top as supplier__top', false);
$this->db->select('supplier.rating as supplier__rating', false);
$this->db->select('supplier.lastupdate as supplier__lastupdate', false);
$this->db->select('supplier.updatedby as supplier__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "supplier.idstring like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || supplier.lastname like '%".$_POST['searchtext']."%'";$where .= " || supplier.address like '%".$_POST['searchtext']."%'";$where .= " || supplier.phone like '%".$_POST['searchtext']."%'";$where .= " || supplier.fax like '%".$_POST['searchtext']."%'";$where .= " || supplier.npwp like '%".$_POST['searchtext']."%'";$where .= " || supplier.email like '%".$_POST['searchtext']."%'";$where .= " || supplier.firmtype like '%".$_POST['searchtext']."%'";$where .= " || supplier.contactperson like '%".$_POST['searchtext']."%'";$where .= " || supplier.hpcontactperson like '%".$_POST['searchtext']."%'";$where .= " || supplier.barang like '%".$_POST['searchtext']."%'";$where .= " || supplier.top like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || supplier.rating like '%".$_POST['searchtext']."%'";$where .= " || supplier.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || supplier.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('supplier__idstring', 'asc');
$this->db->order_by('supplier__lastupdate', 'desc');
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
		
		$data['fields'] = array('supplier__idstring' => 'Supplier ID', 'supplier__firstname' => 'First Name', 'supplier__lastname' => 'Last Name', 'supplier__address' => 'Address', 'supplier__phone' => 'Phone', 'supplier__fax' => 'Fax', 'supplier__npwp' => 'NPWP', 'supplier__email' => 'Email', 'supplier__firmtype' => 'Firm Type', 'supplier__contactperson' => 'Contact Person', 'supplier__hpcontactperson' => 'HP Contact Person', 'supplier__barang' => 'Barang', 'supplier__top' => 'Default Payment Term', 'currency__name' => 'Default Currency', 'supplier__rating' => 'Company Rating', 'supplier__lastupdate' => 'Last Update', 'supplier__updatedby' => 'Last Update By');
		
		if (count($_POST) == 0)
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
		$this->load->view('supplier_3_lookup_view', $data);
	}
}

?>