<?php

class permintaan_stock_chemicallist extends Controller {

	function permintaan_stock_chemicallist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('permintaanstockchemical');
$this->db->where('permintaanstockchemical.disabled = 0');
$this->db->select('permintaanstockchemical.id as id', false);
$this->db->select('permintaanstockchemical.idstring as permintaanstockchemical__idstring', false);
$this->db->select('DATE_FORMAT(permintaanstockchemical.date, "%d-%m-%Y") as permintaanstockchemical__date', false);
$this->db->select('permintaanstockchemical.notes as permintaanstockchemical__notes', false);
$this->db->select('permintaanstockchemical.lastupdate as permintaanstockchemical__lastupdate', false);
$this->db->select('permintaanstockchemical.updatedby as permintaanstockchemical__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "permintaanstockchemical.idstring like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockchemical.date like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockchemical.notes like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockchemical.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || permintaanstockchemical.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('permintaanstockchemical__idstring', 'asc');
$this->db->order_by('permintaanstockchemical__date', 'desc');
$this->db->order_by('permintaanstockchemical__lastupdate', 'desc');
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
		
		$data['fields'] = array('permintaanstockchemical__idstring' => 'ID', 'permintaanstockchemical__date' => 'Date', 'permintaanstockchemical__notes' => 'Notes', 'permintaanstockchemical__lastupdate' => 'Last Update', 'permintaanstockchemical__updatedby' => 'Last Update By');
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		///
		$this->load->view('permintaan_stock_chemical_list_view', $data);
	}
}

?>