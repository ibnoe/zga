<?php

class blanket_inspection_sheet_linelist extends Controller {

	function blanket_inspection_sheet_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $blanketinspectionsheet_id)
	{
		
$this->db->where('blanketinspectionsheetline.blanketinspectionsheet_id', $blanketinspectionsheet_id);$this->db->from('blanketinspectionsheetline');
$this->db->where('blanketinspectionsheetline.disabled = 0');
$this->db->select('blanketinspectionsheetline.id as id', false);
$this->db->select('blanketinspectionsheetline.qccode as blanketinspectionsheetline__qccode', false);
$this->db->select('blanketinspectionsheetline.ac1 as blanketinspectionsheetline__ac1', false);
$this->db->select('blanketinspectionsheetline.ac2 as blanketinspectionsheetline__ac2', false);
$this->db->select('blanketinspectionsheetline.ar1 as blanketinspectionsheetline__ar1', false);
$this->db->select('blanketinspectionsheetline.ar2 as blanketinspectionsheetline__ar2', false);
$this->db->select('blanketinspectionsheetline.thickness as blanketinspectionsheetline__thickness', false);
$this->db->select('blanketinspectionsheetline.ks as blanketinspectionsheetline__ks', false);
$this->db->select('blanketinspectionsheetline.rollno as blanketinspectionsheetline__rollno', false);
$this->db->select('DATE_FORMAT(blanketinspectionsheetline.barringdate, "%d-%m-%Y") as blanketinspectionsheetline__barringdate', false);
$this->db->select('blanketinspectionsheetline.lastupdate as blanketinspectionsheetline__lastupdate', false);
$this->db->select('blanketinspectionsheetline.updatedby as blanketinspectionsheetline__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "blanketinspectionsheetline.qccode like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.ac1 like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.ac2 like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.ar1 like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.ar2 like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.thickness like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.ks like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.rollno like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.barringdate like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || blanketinspectionsheetline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('blanketinspectionsheetline__qccode', 'asc');
$this->db->order_by('blanketinspectionsheetline__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($blanketinspectionsheet_id=0)
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
		
		$data['foreign_id'] = $blanketinspectionsheet_id;$data['fields'] = array('blanketinspectionsheetline__qccode' => 'QC Code', 'blanketinspectionsheetline__ac1' => 'AC 1', 'blanketinspectionsheetline__ac2' => 'AC 2', 'blanketinspectionsheetline__ar1' => 'AR 1', 'blanketinspectionsheetline__ar2' => 'AR 2', 'blanketinspectionsheetline__thickness' => 'Thickness', 'blanketinspectionsheetline__ks' => 'KS', 'blanketinspectionsheetline__rollno' => 'Roll No', 'blanketinspectionsheetline__barringdate' => 'Barring Date', 'blanketinspectionsheetline__lastupdate' => 'Last Update', 'blanketinspectionsheetline__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $blanketinspectionsheet_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $blanketinspectionsheet_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('blanket_inspection_sheet_line_list_view', $data);
	}
}

?>