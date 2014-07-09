<?php

class cuti_klaimlist extends Controller {

	function cuti_klaimlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $karyawan_id)
	{
		
$this->db->where('cutiklaim.karyawan_id', $karyawan_id);$this->db->from('cutiklaim');
$this->db->join('users', 'users.id = cutiklaim.users_id', 'left');
$this->db->where('cutiklaim.disabled = 0');
$this->db->select('users.firstname as users__firstname', false);
$this->db->select('cutiklaim.users_id as cutiklaim__users_id', false);
$this->db->select('cutiklaim.id as id', false);
$this->db->select('DATE_FORMAT(cutiklaim.date, "%d-%m-%Y") as cutiklaim__date', false);
$this->db->select('cutiklaim.totalcutiklaimed as cutiklaim__totalcutiklaimed', false);
$this->db->select('cutiklaim.notes as cutiklaim__notes', false);
$this->db->select('cutiklaim.lastupdate as cutiklaim__lastupdate', false);
$this->db->select('cutiklaim.updatedby as cutiklaim__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "cutiklaim.date like '%".$_POST['searchtext']."%'";$where .= " || cutiklaim.totalcutiklaimed like '%".$_POST['searchtext']."%'";$where .= " || users.firstname like '%".$_POST['searchtext']."%'";$where .= " || cutiklaim.notes like '%".$_POST['searchtext']."%'";$where .= " || cutiklaim.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || cutiklaim.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('cutiklaim__date', 'asc');
$this->db->order_by('cutiklaim__date', 'desc');
$this->db->order_by('cutiklaim__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($karyawan_id=0)
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
		
		$data['foreign_id'] = $karyawan_id;$data['fields'] = array('cutiklaim__date' => 'Date', 'cutiklaim__totalcutiklaimed' => 'Total Cuti Diambil', 'users__firstname' => 'Atasan', 'cutiklaim__notes' => 'Notes', 'cutiklaim__lastupdate' => 'Last Update', 'cutiklaim__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $karyawan_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $karyawan_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('cuti_klaim_list_view', $data);
	}
}

?>