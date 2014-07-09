<?php

class bank_transfer_keluarlist extends Controller {

	function bank_transfer_keluarlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('banktransferkeluar');
$this->db->join('currency', 'currency.id = banktransferkeluar.currency_id', 'left');
$this->db->where('banktransferkeluar.disabled = 0');
$this->db->select('currency.name as currency__name', false);
$this->db->select('banktransferkeluar.currency_id as banktransferkeluar__currency_id', false);
$this->db->select('banktransferkeluar.id as id', false);
$this->db->select('banktransferkeluar.idstring as banktransferkeluar__idstring', false);
$this->db->select('DATE_FORMAT(banktransferkeluar.date, "%d-%m-%Y") as banktransferkeluar__date', false);
$this->db->select('banktransferkeluar.amount as banktransferkeluar__amount', false);
$this->db->select('banktransferkeluar.notes as banktransferkeluar__notes', false);
$this->db->select('banktransferkeluar.transferedflag as banktransferkeluar__transferedflag', false);
$this->db->select('banktransferkeluar.lastupdate as banktransferkeluar__lastupdate', false);
$this->db->select('banktransferkeluar.updatedby as banktransferkeluar__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "banktransferkeluar.idstring like '%".$_POST['searchtext']."%'";$where .= " || banktransferkeluar.date like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || banktransferkeluar.amount like '%".$_POST['searchtext']."%'";$where .= " || banktransferkeluar.notes like '%".$_POST['searchtext']."%'";$where .= " || banktransferkeluar.transferedflag like '%".$_POST['searchtext']."%'";$where .= " || banktransferkeluar.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || banktransferkeluar.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('banktransferkeluar__idstring', 'asc');
$this->db->order_by('banktransferkeluar__date', 'desc');
$this->db->order_by('banktransferkeluar__lastupdate', 'desc');
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
		
		$data['fields'] = array('banktransferkeluar__idstring' => 'ID', 'banktransferkeluar__date' => 'Date', 'currency__name' => 'Currency', 'banktransferkeluar__amount' => 'Amount', 'banktransferkeluar__notes' => 'Notes', 'banktransferkeluar__transferedflag' => 'Transferred', 'banktransferkeluar__lastupdate' => 'Last Update', 'banktransferkeluar__updatedby' => 'Last Update By');
		
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
		$this->load->view('bank_transfer_keluar_list_view', $data);
	}
}

?>