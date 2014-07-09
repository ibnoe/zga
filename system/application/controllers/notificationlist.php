<?php

class notificationlist extends Controller {

	function notificationlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('vmessagenotification');
$this->db->where('vmessagenotification.disabled = 0');
$this->db->where('vmessagenotification.updatedby', $this->session->userdata("user"));
$this->db->select('vmessagenotification.id as id', false);
$this->db->select('vmessagenotification.summary as vmessagenotification__summary', false);
$this->db->select('vmessagenotification.message as vmessagenotification__message', false);
$this->db->select('vmessagenotification.lastupdate as vmessagenotification__lastupdate', false);
$this->db->select('vmessagenotification.updatedby as vmessagenotification__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "vmessagenotification.summary like '%".$_POST['searchtext']."%'";$where .= " || vmessagenotification.message like '%".$_POST['searchtext']."%'";$where .= " || vmessagenotification.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || vmessagenotification.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('vmessagenotification__summary', 'asc');
$this->db->order_by('vmessagenotification__lastupdate', 'desc');
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
		
		$data['fields'] = array('vmessagenotification__summary' => 'Summary', 'vmessagenotification__message' => 'Message', 'vmessagenotification__lastupdate' => 'Time', 'vmessagenotification__updatedby' => 'By');
		
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
		$this->load->view('notification_list_view', $data);
	}
}

?>