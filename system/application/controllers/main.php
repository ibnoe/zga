<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($param='')
	{
		$data = array();
		
		$links = array( array( "target" => "supplierlist", "title" => "Supplier"),
						array( "target" => "purchase_orderlist", "title" => "Purchase Order"),
						array( "target" => "incoming_suppliers_itemslist", "title" => "Incoming Suppliers Items"),
						//array( "target" => "promoimageslist", "title" => "Promo Images"),
						//array( "target" => "userslist", "title" => "User"),
						
						);
		$data['links'] = $links;
		$data['selected'] = 0;
		foreach ($links as $k=>$v)
		{
			if ($param == $v['target'])
			{
				$data['selected'] = $k;
				break;
			}
		}
		
		
		
		$this->load->view('main_view.php', $data);
	}
}

?>