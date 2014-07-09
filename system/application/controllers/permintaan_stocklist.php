<?php

class permintaan_stocklist extends Controller {

	function permintaan_stocklist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('permintaanstock');
$this->db->where('permintaanstock.disabled = 0');
$this->db->select('permintaanstock.id as id', false);
$this->db->select('permintaanstock.idstring as permintaanstock__idstring', false);
$this->db->select('DATE_FORMAT(permintaanstock.date, "%d-%m-%Y") as permintaanstock__date', false);
$this->db->select('permintaanstock.notes as permintaanstock__notes', false);
$this->db->select('permintaanstock.lastupdate as permintaanstock__lastupdate', false);
$this->db->select('permintaanstock.updatedby as permintaanstock__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "permintaanstock.idstring like '%".$_POST['searchtext']."%'";$where .= " || permintaanstock.date like '%".$_POST['searchtext']."%'";$where .= " || permintaanstock.notes like '%".$_POST['searchtext']."%'";$where .= " || permintaanstock.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || permintaanstock.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('permintaanstock__idstring', 'asc');
$this->db->order_by('permintaanstock__date', 'desc');
$this->db->order_by('permintaanstock__lastupdate', 'desc');
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
		
		$data['fields'] = array('permintaanstock__idstring' => 'ID', 'permintaanstock__date' => 'Date', 'permintaanstock__notes' => 'Notes', 'permintaanstock__lastupdate' => 'Last Update', 'permintaanstock__updatedby' => 'Last Update By');
		
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
		$this->load->view('permintaan_stock_list_view', $data);
	}
}

?>