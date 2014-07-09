<?php

class surat_pengajuan_repairlist extends Controller {

	function surat_pengajuan_repairlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('suratpengajuanrepair');
$this->db->where('suratpengajuanrepair.disabled = 0');
$this->db->select('suratpengajuanrepair.id as id', false);
$this->db->select('suratpengajuanrepair.idstring as suratpengajuanrepair__idstring', false);
$this->db->select('DATE_FORMAT(suratpengajuanrepair.date, "%d-%m-%Y") as suratpengajuanrepair__date', false);
$this->db->select('suratpengajuanrepair.requester as suratpengajuanrepair__requester', false);
$this->db->select('suratpengajuanrepair.lastupdate as suratpengajuanrepair__lastupdate', false);
$this->db->select('suratpengajuanrepair.updatedby as suratpengajuanrepair__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "suratpengajuanrepair.idstring like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepair.date like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepair.requester like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepair.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || suratpengajuanrepair.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('suratpengajuanrepair__idstring', 'asc');
$this->db->order_by('suratpengajuanrepair__date', 'desc');
$this->db->order_by('suratpengajuanrepair__lastupdate', 'desc');
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
		
		$data['fields'] = array('suratpengajuanrepair__idstring' => 'No Form', 'suratpengajuanrepair__date' => 'Date', 'suratpengajuanrepair__requester' => 'Diajukan oleh', 'suratpengajuanrepair__lastupdate' => 'Last Update', 'suratpengajuanrepair__updatedby' => 'Last Update By');
		
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
		$this->load->view('surat_pengajuan_repair_list_view', $data);
	}
}

?>