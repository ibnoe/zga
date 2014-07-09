<?php

class rif_linelist extends Controller {

	function rif_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $rcn_id)
	{
		
$this->db->where('rcnline.rcn_id', $rcn_id);$this->db->from('rcnline');
$this->db->where('rcnline.disabled = 0');
$this->db->select('rcnline.id as id', false);
$this->db->select('rcnline.machinespec as rcnline__machinespec', false);
$this->db->select('rcnline.rd as rcnline__rd', false);
$this->db->select('rcnline.cd as rcnline__cd', false);
$this->db->select('rcnline.rl as rcnline__rl', false);
$this->db->select('rcnline.wl as rcnline__wl', false);
$this->db->select('rcnline.tl as rcnline__tl', false);
$this->db->select('rcnline.coretype as rcnline__coretype', false);
$this->db->select('rcnline.accfitted as rcnline__accfitted', false);
$this->db->select('rcnline.repairrequest as rcnline__repairrequest', false);
$this->db->select('rcnline.remarks as rcnline__remarks', false);
$this->db->select('rcnline.lastupdate as rcnline__lastupdate', false);
$this->db->select('rcnline.updatedby as rcnline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "rcnline.machinespec like '%".$_POST['searchtext']."%'";$where .= " || rcnline.rd like '%".$_POST['searchtext']."%'";$where .= " || rcnline.cd like '%".$_POST['searchtext']."%'";$where .= " || rcnline.rl like '%".$_POST['searchtext']."%'";$where .= " || rcnline.wl like '%".$_POST['searchtext']."%'";$where .= " || rcnline.tl like '%".$_POST['searchtext']."%'";$where .= " || rcnline.coretype like '%".$_POST['searchtext']."%'";$where .= " || rcnline.accfitted like '%".$_POST['searchtext']."%'";$where .= " || rcnline.repairrequest like '%".$_POST['searchtext']."%'";$where .= " || rcnline.remarks like '%".$_POST['searchtext']."%'";$where .= " || rcnline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || rcnline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('rcnline__machinespec', 'asc');
$this->db->order_by('rcnline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($rcn_id=0)
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
		
		$data['foreign_id'] = $rcn_id;$data['fields'] = array('rcnline__machinespec' => 'Machine Specification', 'rcnline__rd' => 'Rubber Diameter (RD)', 'rcnline__cd' => 'Core Diameter (CD)', 'rcnline__rl' => 'Rubber Length (RL)', 'rcnline__wl' => 'Working Length (WL)', 'rcnline__tl' => 'Total Length (TL)', 'rcnline__coretype' => 'Core Type', 'rcnline__accfitted' => 'Acc Fitted', 'rcnline__repairrequest' => 'Repair Request', 'rcnline__remarks' => 'Remarks', 'rcnline__lastupdate' => 'Last Update', 'rcnline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $rcn_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $rcn_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('rif_line_list_view', $data);
	}
}

?>