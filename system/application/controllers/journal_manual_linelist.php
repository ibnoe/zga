<?php

class journal_manual_linelist extends Controller {

	function journal_manual_linelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $journalmanual_id)
	{
		
$this->db->where('journal.journalmanual_id', $journalmanual_id);$this->db->from('journal');
$this->db->join('coa', 'coa.id = journal.coa_id', 'left');
$this->db->where('journal.disabled = 0');
$this->db->select('coa.name as coa__name', false);
$this->db->select('journal.coa_id as journal__coa_id', false);
$this->db->select('journal.id as id', false);
$this->db->select('journal.debit as journal__debit', false);
$this->db->select('journal.credit as journal__credit', false);
$this->db->select('journal.lastupdate as journal__lastupdate', false);
$this->db->select('journal.updatedby as journal__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "coa.name like '%".$_POST['searchtext']."%'";$where .= " || journal.debit like '%".$_POST['searchtext']."%'";$where .= " || journal.credit like '%".$_POST['searchtext']."%'";$where .= " || journal.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || journal.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('journal__coa_id', 'asc');
$this->db->order_by('journal__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($journalmanual_id=0)
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
		
		$data['foreign_id'] = $journalmanual_id;$data['fields'] = array('coa__name' => 'Account', 'journal__debit' => 'Debit', 'journal__credit' => 'Credit', 'journal__lastupdate' => 'Last Update', 'journal__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $journalmanual_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $journalmanual_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('journal_manual_line_list_view', $data);
	}
}

?>