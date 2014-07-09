<?php

class open_move_orderlist extends Controller {

	function open_move_orderlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('moveorderline');
$this->db->join('warehouse', 'warehouse.id = moveorderline.from_warehouse_id', 'left');
$this->db->join('warehouse as warehouse1', 'warehouse1.id = moveorderline.to_warehouse_id', 'left');
$this->db->join('item', 'item.id = moveorderline.item_id', 'left');
$this->db->join('uom', 'uom.id = moveorderline.uom_id', 'left');
$this->db->where('moveorderline.disabled = 0');
$this->db->where('moveorderline.quantitytomove > 0');
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('moveorderline.from_warehouse_id as moveorderline__from_warehouse_id', false);
$this->db->select('warehouse1.name as warehouse1__name', false);
$this->db->select('moveorderline.to_warehouse_id as moveorderline__to_warehouse_id', false);
$this->db->select('item.name as item__name', false);
$this->db->select('moveorderline.item_id as moveorderline__item_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('moveorderline.uom_id as moveorderline__uom_id', false);
$this->db->select('moveorderline.id as id', false);
$this->db->select('moveorderline.id as moveorderline__id', false);
$this->db->select('DATE_FORMAT(moveorderline.date, "%d-%m-%Y") as moveorderline__date', false);
$this->db->select('moveorderline.orderid as moveorderline__orderid', false);
$this->db->select('moveorderline.quantity as moveorderline__quantity', false);
$this->db->select('moveorderline.quantityalreadymoved as moveorderline__quantityalreadymoved', false);
$this->db->select('moveorderline.quantitytomove as moveorderline__quantitytomove', false);
$this->db->select('moveorderline.lastupdate as moveorderline__lastupdate', false);
$this->db->select('moveorderline.updatedby as moveorderline__updatedby', false);if (isset($_POST['from_warehouse_id']) && $_POST['from_warehouse_id'] != -1)$this->db->where('moveorderline.from_warehouse_id', $_POST['from_warehouse_id']);if (isset($_POST['to_warehouse_id']) && $_POST['to_warehouse_id'] != -1)$this->db->where('moveorderline.to_warehouse_id', $_POST['to_warehouse_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "moveorderline.id like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.date like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.orderid like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse1.name like '%".$_POST['searchtext']."%'";$where .= " || item.name like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.quantity like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.quantityalreadymoved like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.quantitytomove like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || moveorderline.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('moveorderline__id', 'asc');
$this->db->order_by('moveorderline__date', 'desc');
$this->db->order_by('moveorderline__lastupdate', 'desc');
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
		
		$data['fields'] = array('moveorderline__date' => 'Date', 'moveorderline__orderid' => 'ID', 'warehouse__name' => 'From Warehouse', 'warehouse1__name' => 'To Warehouse', 'item__name' => 'Item', 'moveorderline__quantity' => 'Quantity', 'moveorderline__quantityalreadymoved' => 'Quantity Moved', 'moveorderline__quantitytomove' => 'Quantity Remaining', 'uom__name' => 'Unit', 'moveorderline__lastupdate' => 'Last Update', 'moveorderline__updatedby' => 'Last Update By');
		
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
		
		
		
		$this->db->from('moveorderline');$this->db->join('warehouse', 'warehouse.id = moveorderline.from_warehouse_id');$this->db->select('from_warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['from_warehouse_id'] = $k; break; }if (isset($_POST['from_warehouse_id']))$data['from_warehouse_id'] = $_POST['from_warehouse_id'];$this->db->from('moveorderline');$this->db->join('warehouse', 'warehouse.id = moveorderline.to_warehouse_id');$this->db->select('to_warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['to_warehouse_id'] = $k; break; }if (isset($_POST['to_warehouse_id']))$data['to_warehouse_id'] = $_POST['to_warehouse_id'];
		}
		///
		$this->load->view('open_move_order_list_view', $data);
	}
}

?>