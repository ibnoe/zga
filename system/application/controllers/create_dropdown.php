<?php

class create_dropdown extends Controller {

	function create_dropdown()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($name, $stdquery, $table, $dispindex)
	{
		$data = array();
		
		if ($stdquery)
		{
			$this->db->from($table);
			$q = $this->db->get();
			
			foreach ($q->result_array() as $row)
			{
				$data[$row['id']] = $row[$dispindex];
			}
		}
	
		$dpdown = form_dropdown($name, $data);//array("2" => "aaa", "3" => "bbb"), '');
		str_replace("\n", "", $dpdown);
		echo $dpdown;
	}
}

?>