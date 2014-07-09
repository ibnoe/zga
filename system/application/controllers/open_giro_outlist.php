<?php

class open_giro_outlist extends Controller {

	function open_giro_outlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('giroout');
$this->db->join('supplier', 'supplier.id = giroout.supplier_id', 'left');
$this->db->join('currency', 'currency.id = giroout.currency_id', 'left');
$this->db->join('girooutclearanceline', 'giroout.id = girooutclearanceline.giroout_id', 'left');
$this->db->where('giroout.disabled = 0');
$this->db->where('girooutclearanceline.giroout_id is NULL');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('giroout.supplier_id as giroout__supplier_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('giroout.currency_id as giroout__currency_id', false);
$this->db->select('giroout.id as id', false);
$this->db->select('giroout.id as giroout__id', false);
$this->db->select('DATE_FORMAT(giroout.createdate, "%d-%m-%Y") as giroout__createdate', false);
$this->db->select('giroout.girooutid as giroout__girooutid', false);
$this->db->select('giroout.amount as giroout__amount', false);
$this->db->select('giroout.amountused as giroout__amountused', false);
$this->db->select('giroout.usedflag as giroout__usedflag', false);
$this->db->select('giroout.lastupdate as giroout__lastupdate', false);
$this->db->select('giroout.updatedby as giroout__updatedby', false);if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('giroout.supplier_id', $_POST['supplier_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('giroout.currency_id', $_POST['currency_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "giroout.id like '%".$_POST['searchtext']."%'";$where .= " || giroout.createdate like '%".$_POST['searchtext']."%'";$where .= " || giroout.girooutid like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || giroout.amount like '%".$_POST['searchtext']."%'";$where .= " || giroout.amountused like '%".$_POST['searchtext']."%'";$where .= " || giroout.usedflag like '%".$_POST['searchtext']."%'";$where .= " || giroout.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || giroout.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('giroout__id', 'asc');
$this->db->order_by('giroout__createdate', 'desc');
$this->db->order_by('giroout__lastupdate', 'desc');
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
		
		$data['fields'] = array('giroout__createdate' => 'Date', 'giroout__girooutid' => 'ID', 'supplier__firstname' => 'Supplier', 'currency__name' => 'Currency', 'giroout__amount' => 'Amount', 'giroout__amountused' => 'Amount Used', 'giroout__usedflag' => 'Used', 'giroout__lastupdate' => 'Last Update', 'giroout__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('giroout');$this->db->join('supplier', 'supplier.id = giroout.supplier_id');$this->db->select('supplier_id as id, supplier.firstname as name');$q = $this->db->get();$supplier_opt = array('-1' => 'All');foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->name; }$data['supplier_opt'] = $supplier_opt;foreach ($supplier_opt as $k=>$v) { $data['supplier_id'] = $k; break; }if (isset($_POST['supplier_id']))$data['supplier_id'] = $_POST['supplier_id'];$this->db->from('giroout');$this->db->join('currency', 'currency.id = giroout.currency_id');$this->db->select('currency_id as id, currency.name as name');$q = $this->db->get();$currency_opt = array('-1' => 'All');foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }$data['currency_opt'] = $currency_opt;foreach ($currency_opt as $k=>$v) { $data['currency_id'] = $k; break; }if (isset($_POST['currency_id']))$data['currency_id'] = $_POST['currency_id'];
		}
		///
		$this->load->view('open_giro_out_list_view', $data);
	}
}

?>