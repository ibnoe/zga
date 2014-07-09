<?php

class karyawanlist extends Controller {

	function karyawanlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('karyawan');
$this->db->where('karyawan.disabled = 0');
$this->db->select('karyawan.id as id', false);
$this->db->select('karyawan.idstring as karyawan__idstring', false);
$this->db->select('karyawan.name as karyawan__name', false);
$this->db->select('karyawan.gender as karyawan__gender', false);
$this->db->select('karyawan.address as karyawan__address', false);
$this->db->select('karyawan.phone1 as karyawan__phone1', false);
$this->db->select('karyawan.phone2 as karyawan__phone2', false);
$this->db->select('DATE_FORMAT(karyawan.dob, "%d-%m-%Y") as karyawan__dob', false);
$this->db->select('karyawan.education as karyawan__education', false);
$this->db->select('karyawan.religion as karyawan__religion', false);
$this->db->select('DATE_FORMAT(karyawan.joindate, "%d-%m-%Y") as karyawan__joindate', false);
$this->db->select('karyawan.department as karyawan__department', false);
$this->db->select('karyawan.gol as karyawan__gol', false);
$this->db->select('DATE_FORMAT(karyawan.endprobationdate, "%d-%m-%Y") as karyawan__endprobationdate', false);
$this->db->select('karyawan.rekbca as karyawan__rekbca', false);
$this->db->select('karyawan.cabbca as karyawan__cabbca', false);
$this->db->select('karyawan.notes as karyawan__notes', false);
$this->db->select('karyawan.status as karyawan__status', false);
$this->db->select('karyawan.lastupdate as karyawan__lastupdate', false);
$this->db->select('karyawan.updatedby as karyawan__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "karyawan.idstring like '%".$_POST['searchtext']."%'";$where .= " || karyawan.name like '%".$_POST['searchtext']."%'";$where .= " || karyawan.gender like '%".$_POST['searchtext']."%'";$where .= " || karyawan.address like '%".$_POST['searchtext']."%'";$where .= " || karyawan.phone1 like '%".$_POST['searchtext']."%'";$where .= " || karyawan.phone2 like '%".$_POST['searchtext']."%'";$where .= " || karyawan.dob like '%".$_POST['searchtext']."%'";$where .= " || karyawan.education like '%".$_POST['searchtext']."%'";$where .= " || karyawan.religion like '%".$_POST['searchtext']."%'";$where .= " || karyawan.joindate like '%".$_POST['searchtext']."%'";$where .= " || karyawan.department like '%".$_POST['searchtext']."%'";$where .= " || karyawan.gol like '%".$_POST['searchtext']."%'";$where .= " || karyawan.endprobationdate like '%".$_POST['searchtext']."%'";$where .= " || karyawan.rekbca like '%".$_POST['searchtext']."%'";$where .= " || karyawan.cabbca like '%".$_POST['searchtext']."%'";$where .= " || karyawan.notes like '%".$_POST['searchtext']."%'";$where .= " || karyawan.status like '%".$_POST['searchtext']."%'";$where .= " || karyawan.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || karyawan.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('karyawan__idstring', 'asc');
$this->db->order_by('karyawan__lastupdate', 'desc');
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
		
		$data['fields'] = array('karyawan__idstring' => 'NIK', 'karyawan__name' => 'Name', 'karyawan__gender' => 'Gender', 'karyawan__address' => 'Address', 'karyawan__phone1' => 'Phone 1', 'karyawan__phone2' => 'Phone 2', 'karyawan__dob' => 'DOB', 'karyawan__education' => 'Pendidikan', 'karyawan__religion' => 'Agama', 'karyawan__joindate' => 'Join Date', 'karyawan__department' => 'Department', 'karyawan__gol' => 'Gol', 'karyawan__endprobationdate' => 'End Probation Date', 'karyawan__rekbca' => 'Rek BCA', 'karyawan__cabbca' => 'Cab BCA', 'karyawan__notes' => 'Notes', 'karyawan__status' => 'Status', 'karyawan__lastupdate' => 'Last Update', 'karyawan__updatedby' => 'Last Update By');
		
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
		$this->load->view('karyawan_list_view', $data);
	}
}

?>