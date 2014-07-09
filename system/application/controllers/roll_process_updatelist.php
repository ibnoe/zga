<?php

class roll_process_updatelist extends Controller {

	function roll_process_updatelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('rollprocessupdate');
$this->db->where('rollprocessupdate.disabled = 0');
$this->db->select('rollprocessupdate.id as id', false);
$this->db->select('rollprocessupdate.idstring as rollprocessupdate__idstring', false);
$this->db->select('rollprocessupdate.noorderandcustomer as rollprocessupdate__noorderandcustomer', false);
$this->db->select('DATE_FORMAT(rollprocessupdate.date, "%d-%m-%Y") as rollprocessupdate__date', false);
$this->db->select('rollprocessupdate.qty1 as rollprocessupdate__qty1', false);
$this->db->select('rollprocessupdate.machinetyperoll as rollprocessupdate__machinetyperoll', false);
$this->db->select('rollprocessupdate.compound as rollprocessupdate__compound', false);
$this->db->select('rollprocessupdate.rd as rollprocessupdate__rd', false);
$this->db->select('rollprocessupdate.wl as rollprocessupdate__wl', false);
$this->db->select('rollprocessupdate.tl as rollprocessupdate__tl', false);
$this->db->select('rollprocessupdate.qty2 as rollprocessupdate__qty2', false);
$this->db->select('rollprocessupdate.shipping as rollprocessupdate__shipping', false);
$this->db->select('rollprocessupdate.wrapping as rollprocessupdate__wrapping', false);
$this->db->select('rollprocessupdate.vulcanizing as rollprocessupdate__vulcanizing', false);
$this->db->select('rollprocessupdate.faceoff as rollprocessupdate__faceoff', false);
$this->db->select('rollprocessupdate.grinding as rollprocessupdate__grinding', false);
$this->db->select('rollprocessupdate.polishing as rollprocessupdate__polishing', false);
$this->db->select('DATE_FORMAT(rollprocessupdate.maxdate, "%d-%m-%Y") as rollprocessupdate__maxdate', false);
$this->db->select('DATE_FORMAT(rollprocessupdate.deadlinedate, "%d-%m-%Y") as rollprocessupdate__deadlinedate', false);
$this->db->select('rollprocessupdate.notes as rollprocessupdate__notes', false);
$this->db->select('rollprocessupdate.lastupdate as rollprocessupdate__lastupdate', false);
$this->db->select('rollprocessupdate.updatedby as rollprocessupdate__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "rollprocessupdate.idstring like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.noorderandcustomer like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.date like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.qty1 like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.machinetyperoll like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.compound like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.rd like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.wl like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.tl like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.qty2 like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.shipping like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.wrapping like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.vulcanizing like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.faceoff like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.grinding like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.polishing like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.maxdate like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.deadlinedate like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.notes like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || rollprocessupdate.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('rollprocessupdate__idstring', 'asc');
$this->db->order_by('rollprocessupdate__lastupdate', 'desc');
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
		
		$data['fields'] = array('rollprocessupdate__idstring' => 'No', 'rollprocessupdate__noorderandcustomer' => 'No Order And Customer', 'rollprocessupdate__date' => 'Incoming Date', 'rollprocessupdate__qty1' => 'Incoming Quantity', 'rollprocessupdate__machinetyperoll' => 'Machine Type Roll', 'rollprocessupdate__compound' => 'Compound', 'rollprocessupdate__rd' => 'RD', 'rollprocessupdate__wl' => 'WL', 'rollprocessupdate__tl' => 'TL', 'rollprocessupdate__qty2' => 'Qty', 'rollprocessupdate__shipping' => 'Shipping', 'rollprocessupdate__wrapping' => 'Wrapping', 'rollprocessupdate__vulcanizing' => 'Vulcanizing', 'rollprocessupdate__faceoff' => 'Face Off', 'rollprocessupdate__grinding' => 'Grinding', 'rollprocessupdate__polishing' => 'Polishing', 'rollprocessupdate__maxdate' => 'Max Date', 'rollprocessupdate__deadlinedate' => 'Deadline Date', 'rollprocessupdate__notes' => 'Description', 'rollprocessupdate__lastupdate' => 'Last Update', 'rollprocessupdate__updatedby' => 'Last Update By');
		
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
		$this->load->view('roll_process_update_list_view', $data);
	}
}

?>