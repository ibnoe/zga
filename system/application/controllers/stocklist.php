<?php

class stocklist extends Controller {

	function stocklist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('stock');
$this->db->join('item', 'item.id = stock.item_id', 'left');
$this->db->join('itemcategory', 'itemcategory.id = stock.itemcategory_id', 'left');
$this->db->join('warehouse', 'warehouse.id = stock.warehouse_id', 'left');
$this->db->join('uom', 'uom.id = stock.uom_id', 'left');
$this->db->where('stock.disabled = 0');
$this->db->select('item.name as item__name', false);
$this->db->select('stock.item_id as stock__item_id', false);
$this->db->select('itemcategory.name as itemcategory__name', false);
$this->db->select('stock.itemcategory_id as stock__itemcategory_id', false);
$this->db->select('warehouse.name as warehouse__name', false);
$this->db->select('stock.warehouse_id as stock__warehouse_id', false);
$this->db->select('uom.name as uom__name', false);
$this->db->select('stock.uom_id as stock__uom_id', false);
$this->db->select('stock.id as id', false);
$this->db->select('stock.incoming as stock__incoming', false);
$this->db->select('stock.current as stock__current', false);
$this->db->select('stock.wouldbe as stock__wouldbe', false);
$this->db->select('stock.outgoing as stock__outgoing', false);if (isset($_POST['item_id']) && $_POST['item_id'] != -1)$this->db->where('stock.item_id', $_POST['item_id']);if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1)$this->db->where('stock.warehouse_id', $_POST['warehouse_id']);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "item.name like '%".$_POST['searchtext']."%'";$where .= " || itemcategory.name like '%".$_POST['searchtext']."%'";$where .= " || warehouse.name like '%".$_POST['searchtext']."%'";$where .= " || uom.name like '%".$_POST['searchtext']."%'";$where .= " || stock.incoming like '%".$_POST['searchtext']."%'";$where .= " || stock.current like '%".$_POST['searchtext']."%'";$where .= " || stock.wouldbe like '%".$_POST['searchtext']."%'";$where .= " || stock.outgoing like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('stock__item_id', 'asc');
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
		
		$data['fields'] = array('item__name' => 'Item', 'itemcategory__name' => 'Category', 'warehouse__name' => 'Warehouse', 'uom__name' => 'Unit', 'stock__incoming' => 'Incoming', 'stock__current' => 'Current Stock', 'stock__wouldbe' => 'Virtual Stock', 'stock__outgoing' => 'Outgoing');
		
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
		
		
		
		$this->db->from('stock');$this->db->join('item', 'item.id = stock.item_id');$this->db->select('item_id as id, item.name as name');$q = $this->db->get();$item_opt = array('-1' => 'All');foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }$data['item_opt'] = $item_opt;foreach ($item_opt as $k=>$v) { $data['item_id'] = $k; break; }if (isset($_POST['item_id']))$data['item_id'] = $_POST['item_id'];$this->db->from('stock');$this->db->join('warehouse', 'warehouse.id = stock.warehouse_id');$this->db->select('warehouse_id as id, warehouse.name as name');$q = $this->db->get();$warehouse_opt = array('-1' => 'All');foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }$data['warehouse_opt'] = $warehouse_opt;foreach ($warehouse_opt as $k=>$v) { $data['warehouse_id'] = $k; break; }if (isset($_POST['warehouse_id']))$data['warehouse_id'] = $_POST['warehouse_id'];
		}
		///
		$this->load->view('stock_list_view', $data);
	}
}

?>