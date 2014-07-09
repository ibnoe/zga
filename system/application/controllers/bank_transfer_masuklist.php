<?php

class bank_transfer_masuklist extends Controller {

	function bank_transfer_masuklist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('banktransfermasuk');
$this->db->join('currency', 'currency.id = banktransfermasuk.currency_id', 'left');
$this->db->where('banktransfermasuk.disabled = 0');
$this->db->select('currency.name as currency__name', false);
$this->db->select('banktransfermasuk.currency_id as banktransfermasuk__currency_id', false);
$this->db->select('banktransfermasuk.id as id', false);
$this->db->select('banktransfermasuk.idstring as banktransfermasuk__idstring', false);
$this->db->select('DATE_FORMAT(banktransfermasuk.date, "%d-%m-%Y") as banktransfermasuk__date', false);
$this->db->select('banktransfermasuk.amount as banktransfermasuk__amount', false);
$this->db->select('banktransfermasuk.notes as banktransfermasuk__notes', false);
$this->db->select('banktransfermasuk.transferedflag as banktransfermasuk__transferedflag', false);
$this->db->select('banktransfermasuk.lastupdate as banktransfermasuk__lastupdate', false);
$this->db->select('banktransfermasuk.updatedby as banktransfermasuk__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "banktransfermasuk.idstring like '%".$_POST['searchtext']."%'";$where .= " || banktransfermasuk.date like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || banktransfermasuk.amount like '%".$_POST['searchtext']."%'";$where .= " || banktransfermasuk.notes like '%".$_POST['searchtext']."%'";$where .= " || banktransfermasuk.transferedflag like '%".$_POST['searchtext']."%'";$where .= " || banktransfermasuk.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || banktransfermasuk.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('banktransfermasuk__idstring', 'asc');
$this->db->order_by('banktransfermasuk__date', 'desc');
$this->db->order_by('banktransfermasuk__lastupdate', 'desc');
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
		
		$data['fields'] = array('banktransfermasuk__idstring' => 'ID', 'banktransfermasuk__date' => 'Date', 'currency__name' => 'Currency', 'banktransfermasuk__amount' => 'Amount', 'banktransfermasuk__notes' => 'Notes', 'banktransfermasuk__transferedflag' => 'Transferred', 'banktransfermasuk__lastupdate' => 'Last Update', 'banktransfermasuk__updatedby' => 'Last Update By');
		
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
		$this->load->view('bank_transfer_masuk_list_view', $data);
	}
}

?>