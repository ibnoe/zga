<?php

class StockCard extends Controller {

	function StockCard()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		
		$this->db->from("item");
		$this->db->select("id");
		$this->db->select("name");
		$q=$this->db->get();
		$data['item_array'] = array();
		//$data['coa_array'][0] = "All";
		foreach($q->result_array() as $row)
		{
			$data['item_array'][$row['id']] = $row['name'];
		}
		
		//get array of warehouse
		$this->db->from("warehouse");
		$this->db->select("id");
		$this->db->select("name");
		$q=$this->db->get();
		$data['warehouse_array'] = array();
		foreach($q->result_array() as $row)
		{
			$data['warehouse_array'][$row['id']] = $row['name'];
		}
		
		
		$this->load->view('stockcard_filter_view.php', $data);
	
	}
	
	function _getQtyBalanceUpToDate($item_id, $warehouse_id, $date)
	{
		$this->db->where("item_id", $item_id);
		$this->db->where("warehouse_id", $warehouse_id);
		$this->db->where("date <=", $date);
		$this->db->from("stockline");
		$this->db->select_sum("quantity");
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
		{
			if (is_numeric($q->row()->quantity))
				return $q->row()->quantity;
			else
				return 0;
		}
		
		return 0;
	}
	
	function submit()
	{
		$data = array();
		//$date_from = date("d-m-Y");
		//$date_to = date("d-m-Y");
		$date_from = $_POST['stockcard__datefrom'];
		$date_to = $_POST['stockcard__dateto'];
		$item_id = $_POST['stockcard__item']; 
		$warehouse_id = $_POST['stockcard__warehouse']; 
		
		$date = $date_from;
        $arr = explode("-", $date);
        $year = $arr[0];
        $month = $arr[1];
        $day = $arr[2];
        
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        $date_initial = date('Y-m-d', $timestamp);
		
		
		$data['results'] = array();
		if($item_id != 0 && $warehouse_id != 0)
		{	
			
			$this->db->from("stockline");
			//$this->db->select("type, intnotes");
			$this->db->where('item_id', $item_id);
			$this->db->where('warehouse_id', $warehouse_id);
			$this->db->where('date >=', $date_from);
			$this->db->where('date <=', $date_to);
			$q = $this->db->get();
					
			$data['results'] = $q->result_array();
			//print_r($data['results']);
			
			//get beginning balance for this particular coa
			$data['initialqty'] = $this->_getQtyBalanceUpToDate($item_id, $warehouse_id, $date_initial);
		}
		
		$this->db->from("item");
		$this->db->where('id', $item_id);
		$q = $this->db->get();
		$itemrow = $q->row_array();
		$data['item'] = $itemrow['name'];
		
		$this->db->from("warehouse");
		$this->db->where('id', $warehouse_id);
		$q = $this->db->get();
		$warehouserow = $q->row_array();
		$data['warehouse'] = $warehouserow['name'];
	
		/*foreach ($data as $k=>$row)
		{
			echo $k." => ";
			print_r($row);
			echo "<br>";
		}*/
		
		
		$data['beginningdate'] = $date_from;
		$data['endingdate'] = $date_to;
		
		//$data['coa'] = $coa;
		//print_r($data);
		$this->load->view('stockcard_report_print_view', $data);
	}
}

?>