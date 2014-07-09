<?php

class merk_mesinlookup extends Controller {

	function merk_mesinlookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('merkmesin');
$this->db->where('merkmesin.disabled = 0');
$this->db->select('merkmesin.id as id', false);
$this->db->select('merkmesin.idstring as merkmesin__idstring', false);
$this->db->select('merkmesin.name as merkmesin__name', false);
$this->db->select('merkmesin.lastupdate as merkmesin__lastupdate', false);
$this->db->select('merkmesin.updatedby as merkmesin__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "merkmesin.idstring like '%".$_POST['searchtext']."%'";$where .= " || merkmesin.name like '%".$_POST['searchtext']."%'";$where .= " || merkmesin.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || merkmesin.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('merkmesin__idstring', 'asc');
$this->db->order_by('merkmesin__lastupdate', 'desc');
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
		
		$data['fields'] = array('merkmesin__idstring' => 'Kode Merk Mesin', 'merkmesin__name' => 'Merk Mesin', 'merkmesin__lastupdate' => 'Last Update', 'merkmesin__updatedby' => 'Last Update By');
		
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
		$this->load->view('merk_mesin_lookup_view', $data);
	}
}

?>