<?php

class fixed_assetlist extends Controller {

	function fixed_assetlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('fixedasset');
$this->db->join('coa', 'coa.id = fixedasset.coa_id', 'left');
$this->db->join('coa as coa1', 'coa1.id = fixedasset.paidusing_coa_id', 'left');
$this->db->join('coa as coa2', 'coa2.id = fixedasset.depreciation_coa_id', 'left');
$this->db->join('coa as coa3', 'coa3.id = fixedasset.accumulated_coa_id', 'left');
$this->db->where('fixedasset.disabled = 0');
$this->db->select('coa.name as coa__name', false);
$this->db->select('fixedasset.coa_id as fixedasset__coa_id', false);
$this->db->select('coa1.name as coa1__name', false);
$this->db->select('fixedasset.paidusing_coa_id as fixedasset__paidusing_coa_id', false);
$this->db->select('coa2.name as coa2__name', false);
$this->db->select('fixedasset.depreciation_coa_id as fixedasset__depreciation_coa_id', false);
$this->db->select('coa3.name as coa3__name', false);
$this->db->select('fixedasset.accumulated_coa_id as fixedasset__accumulated_coa_id', false);
$this->db->select('fixedasset.id as id', false);
$this->db->select('fixedasset.name as fixedasset__name', false);
$this->db->select('DATE_FORMAT(fixedasset.datebought, "%d-%m-%Y") as fixedasset__datebought', false);
$this->db->select('fixedasset.estlifetime as fixedasset__estlifetime', false);
$this->db->select('fixedasset.cost as fixedasset__cost', false);
$this->db->select('fixedasset.salvage as fixedasset__salvage', false);
$this->db->select('fixedasset.notes as fixedasset__notes', false);
$this->db->select('fixedasset.lastupdate as fixedasset__lastupdate', false);
$this->db->select('fixedasset.updatedby as fixedasset__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "fixedasset.name like '%".$_POST['searchtext']."%'";$where .= " || fixedasset.datebought like '%".$_POST['searchtext']."%'";$where .= " || coa.name like '%".$_POST['searchtext']."%'";$where .= " || coa1.name like '%".$_POST['searchtext']."%'";$where .= " || coa2.name like '%".$_POST['searchtext']."%'";$where .= " || coa3.name like '%".$_POST['searchtext']."%'";$where .= " || fixedasset.estlifetime like '%".$_POST['searchtext']."%'";$where .= " || fixedasset.cost like '%".$_POST['searchtext']."%'";$where .= " || fixedasset.salvage like '%".$_POST['searchtext']."%'";$where .= " || fixedasset.notes like '%".$_POST['searchtext']."%'";$where .= " || fixedasset.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || fixedasset.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('fixedasset__name', 'asc');
$this->db->order_by('fixedasset__lastupdate', 'desc');
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
		
		$data['fields'] = array('fixedasset__name' => 'Name', 'fixedasset__datebought' => 'Date Buy', 'coa__name' => 'Fixed Asset Account', 'coa1__name' => 'Pay Account', 'coa2__name' => 'Depreciation Account', 'coa3__name' => 'Accumulated Account', 'fixedasset__estlifetime' => 'Est Lifetime', 'fixedasset__cost' => 'Cost', 'fixedasset__salvage' => 'Salvage', 'fixedasset__notes' => 'Notes', 'fixedasset__lastupdate' => 'Last Update', 'fixedasset__updatedby' => 'Last Update By');
		
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
		$this->load->view('fixed_asset_list_view', $data);
	}
}

?>