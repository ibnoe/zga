<?php

class penambahan_stock_chemicallist extends Controller {

	function penambahan_stock_chemicallist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('penambahanstockchemical');
$this->db->where('penambahanstockchemical.disabled = 0');
$this->db->select('penambahanstockchemical.id as id', false);
$this->db->select('penambahanstockchemical.idstring as penambahanstockchemical__idstring', false);
$this->db->select('DATE_FORMAT(penambahanstockchemical.date, "%d-%m-%Y") as penambahanstockchemical__date', false);
$this->db->select('penambahanstockchemical.name as penambahanstockchemical__name', false);
$this->db->select('penambahanstockchemical.joborderno as penambahanstockchemical__joborderno', false);
$this->db->select('penambahanstockchemical.batchno as penambahanstockchemical__batchno', false);
$this->db->select('penambahanstockchemical.packing as penambahanstockchemical__packing', false);
$this->db->select('penambahanstockchemical.qtyliterkg as penambahanstockchemical__qtyliterkg', false);
$this->db->select('penambahanstockchemical.notes as penambahanstockchemical__notes', false);
$this->db->select('penambahanstockchemical.lastupdate as penambahanstockchemical__lastupdate', false);
$this->db->select('penambahanstockchemical.updatedby as penambahanstockchemical__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "penambahanstockchemical.idstring like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.date like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.name like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.joborderno like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.batchno like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.packing like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.qtyliterkg like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.notes like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || penambahanstockchemical.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('penambahanstockchemical__idstring', 'asc');
$this->db->order_by('penambahanstockchemical__date', 'desc');
$this->db->order_by('penambahanstockchemical__lastupdate', 'desc');
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
		
		$data['fields'] = array('penambahanstockchemical__idstring' => 'ID', 'penambahanstockchemical__date' => 'Date', 'penambahanstockchemical__name' => 'Product Name', 'penambahanstockchemical__joborderno' => 'Job Order No', 'penambahanstockchemical__batchno' => 'Batch No', 'penambahanstockchemical__packing' => 'Packing', 'penambahanstockchemical__qtyliterkg' => 'Quantity (Liter/Kg)', 'penambahanstockchemical__notes' => 'Notes', 'penambahanstockchemical__lastupdate' => 'Last Update', 'penambahanstockchemical__updatedby' => 'Last Update By');
		
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
		$this->load->view('penambahan_stock_chemical_list_view', $data);
	}
}

?>