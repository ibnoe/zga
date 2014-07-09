<?php

class generate_accounting_report extends Controller {

	function generate_accounting_report()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('generallib');
	}
	
	function index()
	{
		if (isset($_POST['journal__from_date']))
		{
			$arr = $this->generallib->callGetGeneralLedger($_POST['journal__from_date'], $_POST['journal__to_date']);

			//print_r($arr);
			
			foreach ($arr['Report'] as $k=>$row)
			{
				if (isset($row['date']))
				{
					$date_string = $row['date'];
					preg_match( '/([\d]{10})/', $date_string, $matches ); // gets just the first 10 digits in that string
					$row['date'] = date( 'Y-m-d', $matches[0] );
					
				}
				if ($row['credit'] == 0)
					$row['credit'] = "";
				if ($row['debit'] == 0)
					$row['debit'] = "";
				$arr['Report'][$k] = $row;
				//print_r($row);
				//echo "<br>";
				
			}
			
			//print_r($arr);
			$data = array();
			//$data['headers'] = array("" => "right", "Date" => "center", "Account" => "left", "Debit" => "right", "Credit" => "right", "Reference" => "left");
			//$data['headers'] = array("right" => "", "center" => "Date", "left" => "Account", "right" => "Debit", "right" => "Credit", "left" => "Reference");
			/*
			$data['headers'] = array(
									array("align" => "left", "title" => ""), 
									array("align" => "center", "title" => "Date"), 
									array("align" => "left", "title" => "Account"), 
									array("align" => "right", "title" => "Debit"), 
									array("align" => "right", "title" => "Credit"), 
									array("align" => "left", "title" => "Reference"), 
									);
									*/
			$data['headers'] = array("Date", "Account", "Debit", "Credit", "Reference");
			$data['alignment'] = array("left", "left", "right", "right", "right", "left");
			$data['rows'] = $arr['Report'];
			$this->load->view('standard_report_view', $data);
		}
	}
}

?>