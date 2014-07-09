<?php

class kurs_historylist extends Controller {

	function kurs_historylist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('kurshistory');
$this->db->join('currency', 'currency.id = kurshistory.currency_id', 'left');
$this->db->where('kurshistory.disabled = 0');
$this->db->select('currency.name as currency__name', false);
$this->db->select('kurshistory.currency_id as kurshistory__currency_id', false);
$this->db->select('kurshistory.id as id', false);
$this->db->select('kurshistory.idstring as kurshistory__idstring', false);
$this->db->select('DATE_FORMAT(kurshistory.date, "%d-%m-%Y") as kurshistory__date', false);
$this->db->select('kurshistory.value as kurshistory__value', false);
$this->db->select('kurshistory.notes as kurshistory__notes', false);
$this->db->select('kurshistory.lastupdate as kurshistory__lastupdate', false);
$this->db->select('kurshistory.updatedby as kurshistory__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "kurshistory.idstring like '%".$_POST['searchtext']."%'";$where .= " || kurshistory.date like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || kurshistory.value like '%".$_POST['searchtext']."%'";$where .= " || kurshistory.notes like '%".$_POST['searchtext']."%'";$where .= " || kurshistory.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || kurshistory.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('kurshistory__idstring', 'asc');
$this->db->order_by('kurshistory__date', 'desc');
$this->db->order_by('kurshistory__lastupdate', 'desc');
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
		
		$data['fields'] = array('kurshistory__idstring' => 'ID', 'kurshistory__date' => 'Date', 'currency__name' => 'Currency', 'kurshistory__value' => 'Value', 'kurshistory__notes' => 'Notes', 'kurshistory__lastupdate' => 'Last Update', 'kurshistory__updatedby' => 'Last Update By');
		
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
		$this->load->view('kurs_history_list_view', $data);
	}
}

?>