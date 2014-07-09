<?php

class chemical_work_instructionlookup extends Controller {

	function chemical_work_instructionlookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('chemicalworkinstruction');
$this->db->where('chemicalworkinstruction.disabled = 0');
$this->db->select('chemicalworkinstruction.id as id', false);
$this->db->select('chemicalworkinstruction.idstring as chemicalworkinstruction__idstring', false);
$this->db->select('DATE_FORMAT(chemicalworkinstruction.date, "%d-%m-%Y") as chemicalworkinstruction__date', false);
$this->db->select('chemicalworkinstruction.name as chemicalworkinstruction__name', false);
$this->db->select('chemicalworkinstruction.joborderno as chemicalworkinstruction__joborderno', false);
$this->db->select('chemicalworkinstruction.packing as chemicalworkinstruction__packing', false);
$this->db->select('chemicalworkinstruction.qtyliterkg as chemicalworkinstruction__qtyliterkg', false);
$this->db->select('chemicalworkinstruction.notes as chemicalworkinstruction__notes', false);
$this->db->select('chemicalworkinstruction.lastupdate as chemicalworkinstruction__lastupdate', false);
$this->db->select('chemicalworkinstruction.updatedby as chemicalworkinstruction__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "chemicalworkinstruction.idstring like '%".$_POST['searchtext']."%'";$where .= " || chemicalworkinstruction.date like '%".$_POST['searchtext']."%'";$where .= " || chemicalworkinstruction.name like '%".$_POST['searchtext']."%'";$where .= " || chemicalworkinstruction.joborderno like '%".$_POST['searchtext']."%'";$where .= " || chemicalworkinstruction.packing like '%".$_POST['searchtext']."%'";$where .= " || chemicalworkinstruction.qtyliterkg like '%".$_POST['searchtext']."%'";$where .= " || chemicalworkinstruction.notes like '%".$_POST['searchtext']."%'";$where .= " || chemicalworkinstruction.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || chemicalworkinstruction.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('chemicalworkinstruction__idstring', 'asc');
$this->db->order_by('chemicalworkinstruction__date', 'desc');
$this->db->order_by('chemicalworkinstruction__lastupdate', 'desc');
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
		
		$data['fields'] = array('chemicalworkinstruction__idstring' => 'ID', 'chemicalworkinstruction__date' => 'Date', 'chemicalworkinstruction__name' => 'Product Name', 'chemicalworkinstruction__joborderno' => 'Job Order No', 'chemicalworkinstruction__packing' => 'Packing', 'chemicalworkinstruction__qtyliterkg' => 'Quantity (Liter/Kg)', 'chemicalworkinstruction__notes' => 'Notes', 'chemicalworkinstruction__lastupdate' => 'Last Update', 'chemicalworkinstruction__updatedby' => 'Last Update By');
		
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
		$this->load->view('chemical_work_instruction_lookup_view', $data);
	}
}

?>