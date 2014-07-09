<?php

class journallist extends Controller {

	function journallist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('journal');
$this->db->join('coa', 'coa.id = journal.coa_id', 'left');
$this->db->where('journal.disabled = 0');
$this->db->select('coa.name as coa__name', false);
$this->db->select('journal.coa_id as journal__coa_id', false);
$this->db->select('journal.id as id', false);
$this->db->select('journal.reference as journal__reference', false);
$this->db->select('DATE_FORMAT(journal.date, "%d-%m-%Y") as journal__date', false);
$this->db->select('journal.debit as journal__debit', false);
$this->db->select('journal.credit as journal__credit', false);
$this->db->select('journal.notes as journal__notes', false);
$this->db->select('journal.lastupdate as journal__lastupdate', false);
$this->db->select('journal.updatedby as journal__updatedby', false);if (isset($_POST['coa_id']) && $_POST['coa_id'] != -1)$this->db->where('journal.coa_id', $_POST['coa_id']);if (isset($_POST['date']) && $_POST['date'] != -1)$this->db->where('DATE_FORMAT(journal.date, "%d-%m-%Y") = "'.$_POST['date'].'"');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "journal.reference like '%".$_POST['searchtext']."%'";$where .= " || journal.date like '%".$_POST['searchtext']."%'";$where .= " || coa.name like '%".$_POST['searchtext']."%'";$where .= " || journal.debit like '%".$_POST['searchtext']."%'";$where .= " || journal.credit like '%".$_POST['searchtext']."%'";$where .= " || journal.notes like '%".$_POST['searchtext']."%'";$where .= " || journal.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || journal.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('journal__date', 'desc');
$this->db->order_by('journal__reference', 'desc');
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
		
		$data['fields'] = array('journal__reference' => 'Reference', 'journal__date' => 'Date', 'coa__name' => 'Account', 'journal__debit' => 'Debit', 'journal__credit' => 'Kredit', 'journal__notes' => 'Notes', 'journal__lastupdate' => 'Last Update', 'journal__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('journal');$this->db->join('coa', 'coa.id = journal.coa_id');$this->db->select('coa_id as id, coa.name as name');$q = $this->db->get();$coa_opt = array('-1' => 'All');foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }$data['coa_opt'] = $coa_opt;foreach ($coa_opt as $k=>$v) { $data['coa_id'] = $k; break; }if (isset($_POST['coa_id']))$data['coa_id'] = $_POST['coa_id'];$date_opt = array('-1' => 'All');$this->db->from('journal');$this->db->select('DATE_FORMAT(journal.date, "%d-%m-%Y") as date', false);$q = $this->db->get();foreach ($q->result_array() as $row) { $date_opt[$row['date']] = $row['date']; }$data['date_opt'] = $date_opt;foreach ($date_opt as $k=>$v) { $data['date'] = $k; break; }if (isset($_POST['date']))$data['date'] = $_POST['date'];
		}
		///
		$this->load->view('journal_list_view', $data);
	}
}

?>