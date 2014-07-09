<?php

class alokasi_cutilist extends Controller {

	function alokasi_cutilist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $karyawan_id)
	{
		
$this->db->where('cutiallowance.karyawan_id', $karyawan_id);$this->db->from('cutiallowance');
$this->db->where('cutiallowance.disabled = 0');
$this->db->select('cutiallowance.id as id', false);
$this->db->select('DATE_FORMAT(cutiallowance.begindate, "%d-%m-%Y") as cutiallowance__begindate', false);
$this->db->select('cutiallowance.totalcuti as cutiallowance__totalcuti', false);
$this->db->select('cutiallowance.notes as cutiallowance__notes', false);
$this->db->select('cutiallowance.lastupdate as cutiallowance__lastupdate', false);
$this->db->select('cutiallowance.updatedby as cutiallowance__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "cutiallowance.begindate like '%".$_POST['searchtext']."%'";$where .= " || cutiallowance.totalcuti like '%".$_POST['searchtext']."%'";$where .= " || cutiallowance.notes like '%".$_POST['searchtext']."%'";$where .= " || cutiallowance.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || cutiallowance.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('cutiallowance__begindate', 'asc');
$this->db->order_by('cutiallowance__lastupdate', 'desc');
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
		
		$data['foreign_id'] = $karyawan_id;$data['fields'] = array('cutiallowance__begindate' => 'Start Date', 'cutiallowance__totalcuti' => 'Total Cuti', 'cutiallowance__notes' => 'Notes', 'cutiallowance__lastupdate' => 'Last Update', 'cutiallowance__updatedby' => 'Last Update By');
		
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
		$this->load->view('alokasi_cuti_list_view', $data);
	}
}

?>