<?php

class delivery_notelist extends Controller {

	function delivery_notelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('deliveryorder');
$this->db->join('customer', 'customer.id = deliveryorder.customer_id', 'left');
$this->db->join('warehouse', 'warehouse.id = deliveryorder.warehouse_id', 'left');
$this->db->where('deliveryorder.disabled = 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('deliveryorder.customer_id as deliveryorder__customer_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('deliveryorder.warehouse_id as deliveryorder__warehouse_id', false);
$this->db->select('deliveryorder.id as id', false);
$this->db->select('DATE_FORMAT(deliveryorder.date, "%d-%m-%Y") as deliveryorder__date', false);
$this->db->select('deliveryorder.orderid as deliveryorder__orderid', false);
$this->db->select('deliveryorder.donum as deliveryorder__donum', false);
$this->db->select('DATE_FORMAT(deliveryorder.dodate, "%d-%m-%Y") as deliveryorder__dodate', false);
$this->db->select('deliveryorder.deliveredby as deliveryorder__deliveredby', false);
$this->db->select('deliveryorder.vehicleno as deliveryorder__vehicleno', false);
$this->db->select('deliveryorder.notes as deliveryorder__notes', false);
$this->db->select('deliveryorder.lastupdate as deliveryorder__lastupdate', false);
$this->db->select('deliveryorder.updatedby as deliveryorder__updatedby', false);
$this->db->order_by('deliveryorder__lastupdate', 'desc');
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "deliveryorder.date like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.orderid like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.donum like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.dodate like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.deliveredby like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.vehicleno like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.notes like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || deliveryorder.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
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
		
		$data['fields'] = array('deliveryorder__date' => 'Date', 'deliveryorder__orderid' => 'Delivery Order No', 'deliveryorder__donum' => 'DO Number', 'deliveryorder__dodate' => 'DO Date', 'customer__firstname' => 'Customer', 'warehouse__name' => 'Warehouse', 'deliveryorder__deliveredby' => 'Delivered By', 'deliveryorder__vehicleno' => 'Vehicle Number', 'deliveryorder__notes' => 'Special Instruction', 'deliveryorder__lastupdate' => 'Last Update', 'deliveryorder__updatedby' => 'Last Update By');
		
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
		$this->load->view('delivery_note_list_view', $data);
	}
}

?>