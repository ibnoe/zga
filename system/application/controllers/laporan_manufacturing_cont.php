<?php

class laporan_manufacturing_cont extends Controller {

	function laporan_manufacturing_cont()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		$data['currentdate'] = $today['mday'].'-'.$today['mon'].'-'.$today['year'];
		
		$this->load->view('laporan_manufacturingfilter_view', $data);
	}
	
	function submit()
	{
        $date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];
		
		$data['beginningdate'] = $date_from;
		$data['endingdate'] = $date_to;
		
		// load view
		$this->load->view('laporan_manufacturing_view', $data);
	}
}

?>
