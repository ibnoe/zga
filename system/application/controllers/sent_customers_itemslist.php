<?php

class sent_customers_itemslist extends Controller {

	function sent_customers_itemslist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('deliveryorderline');
$this->db->join('customer', 'customer.id = deliveryorderline.customer_id', 'left');
$this->db->join('warehouse', 'warehouse.id = deliveryorderline.warehouse_id', 'left');
$this->db->join('item', 'item.id = deliveryorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = deliveryorderline.uom_id', 'left');
$this->db->where('deliveryorderline.disabled = 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('deliveryorderline.customer_id as deliveryorderline__customer_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('deliveryorderline.warehouse_id as deliveryorderline__warehouse_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('deliveryorderline.item_id as deliveryorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('deliveryorderline.uom_id as deliveryorderline__uom_id', false);
$this->db->select('deliveryorderline.id as id', false);
$this->db->select('deliveryorderline.id as deliveryorderline__id', false);
$this->db->select('DATE_FORMAT(deliveryorderline.date, "%d-%m-%Y") as deliveryorderline__date', false);
$this->db->select('deliveryorderline.orderid as deliveryorderline__orderid', false);
$this->db->select('deliveryorderline.quantitytosend as deliveryorderline__quantitytosend', false);
$this->db->select('deliveryorderline.lastupdate as deliveryorderline__lastupdate', false);
$this->db->select('deliveryorderline.updatedby as deliveryorderline__updatedby', false);if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1)$this->db->where('deliveryorderline.customer_id', $_POST['customer_id']);if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1)$this->db->where('deliveryorderline.warehouse_id', $_POST['warehouse_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "deliveryorderline.id like '%".$_POST['searchtext']."%'";$where .= " || deliveryorderline.date like '%".$_POST['searchtext']."%'";$where .= " || deliveryorderline.orderid like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || deliveryorderline.quantitytosend like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || deliveryorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || deliveryorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('deliveryorderline__id', 'asc');
$this->db->order_by('deliveryorderline__date', 'desc');
$this->db->order_by('deliveryorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('deliveryorderline__date' => 'Date', 'deliveryorderline__orderid' => 'SO ID', 'customer__firstname' => 'Customer', 'warehouse__name' => 'Warehouse', 'item__name' => 'Item', 'deliveryorderline__quantitytosend' => 'Quantity', 'uom__name' => 'Unit', 'deliveryorderline__lastupdate' => 'Last Update', 'deliveryorderline__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('deliveryorderline');$this->db->join('customer', 'customer.id = deliveryorderline.customer_id');$this->db->select('customer_id as id, customer.firstname as name');$q = $this->db->get();$customer_opt = array('-1' => 'All');foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->name; }$data['customer_opt'] = $customer_opt;foreach ($customer_opt as $k=>$v) { $data['customer_id'] = $k; break; }if (isset($_POST['customer_id']))$data['customer_id'] = $_POST['customer_id'];$this->db->from('deliveryorderline');$this->db->join('warehouse', 'warehouse.id = deliveryorderline.warehouse_id');$this->db->select('warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['warehouse_id'] = $k; break; }if (isset($_POST['warehouse_id']))$data['warehouse_id'] = $_POST['warehouse_id'];
		}
		///
		$this->load->view('sent_customers_items_list_view', $data);
	}
}

?>