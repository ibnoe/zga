<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generallib {

	var $ci;
	var $db;

	var $serveraddress = 'http://localhost:1040';
	//var $serveraddress = 'http://localhost:8080';
	
	function Generallib()
	{
		$this->ci =& get_instance();
		
		//$this->ci->load->helper('form');
		$this->ci->load->helper('url');
		
		$this->db = $this->ci->db;
	}
	
	function genId($modname)
	{
		$this->db->where('typename', $modname);
		$q = $this->db->get('autoid');
			
		if ($q->num_rows() > 0)
		{
			$counter = $q->row()->counter + 1;
			
			$this->db->where('typename', $modname);
			$data = array();
			$data['counter'] = $counter;
			$this->db->update('autoid', $data);
		}
		else
		{
			$counter = 1;
			
			$data = array();
			$data['typename'] = $modname;
			$data['counter'] = 1;
			$this->db->insert('autoid', $data);
		}
			
		return $modname." ID ".$counter;
	}
	
	function genQuery($param, $data=null)
	{
		$this->db = $this->ci->db;
		
		if ($param == 'blanketlist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.palleteno as item__palleteno');
$this->db->select('item.codebaru as item__codebaru');
$this->db->select('item.pressntype as item__pressntype');
$this->db->select('item.ac as item__ac');
$this->db->select('item.ar as item__ar');
$this->db->select('item.thickness as item__thickness');
$this->db->select('item.bartype as item__bartype');
$this->db->select('item.movingspeed as item__movingspeed');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.barorigin as item__barorigin');
$this->db->select('item.barnonbar as item__barnonbar');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Blanket");
		}
		else if ($param == 'rolllist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.rollno as item__rollno');
$this->db->select('item.inktype as item__inktype');
$this->db->select('item.machinetype as item__machinetype');
$this->db->select('item.core as item__core');
$this->db->select('item.rd as item__rd');
$this->db->select('item.cd as item__cd');
$this->db->select('item.rl as item__rl');
$this->db->select('item.wl as item__wl');
$this->db->select('item.tl as item__tl');
$this->db->select('item.compound as item__compound');
$this->db->select('item.processscheme as item__processscheme');
$this->db->select('item.rollertype as item__rollertype');
$this->db->select('item.isaccessories as item__isaccessories');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

		$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Roll");
		}
		else if ($param == 'chemicallist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.chemicalcode as item__chemicalcode');
$this->db->select('item.chemicaltype as item__chemicaltype');
$this->db->select('item.packingsize as item__packingsize');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Chemical");
		}
		else if ($param == 'corelist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.subcategory as item__subcategory');
$this->db->select('item.coreno as item__coreno');
$this->db->select('item.presstype as item__presstype');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Core");
		}
		else if ($param == 'barlist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.barcode as item__barcode');
$this->db->select('item.length as item__length');
$this->db->select('item.pressmodel as item__pressmodel');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Bar");
		}
		else if ($param == 'spray_powderlist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.chemicalcode as item__chemicalcode');
$this->db->select('item.weight as item__weight');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Spray Powder");
		}
		else if ($param == 'inklist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.inkcode as item__inkcode');
$this->db->select('item.weight as item__weight');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Ink");
		}
		else if ($param == 'under_packinglist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.category as item__category');
$this->db->select('item.color as item__color');
$this->db->select('item.presstype as item__presstype');
$this->db->select('item.ac as item__ac');
$this->db->select('item.ar as item__ar');
$this->db->select('item.thickness as item__thickness');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Under Packing");
		}
		else if ($param == 'compoundlist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.subcategory as item__subcategory');
$this->db->select('item.expiryduration as item__expiryduration');
$this->db->select('item.expirydate as item__expirydate');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Compound");
		}
		else if ($param == 'accessorieslist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.subcategory as item__subcategory');
$this->db->select('item.brand as item__brand');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Accessories");
		}
		else if ($param == 'consumablelist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.subcategory as item__subcategory');
$this->db->select('item.brand as item__brand');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Consumable");

		}
		else if ($param == 'packaginglist')
		{
		$this->db->from('item');
$this->db->select('item.name as item__name');
$this->db->select('item.packagingtype as item__packagingtype');
$this->db->select('item.minquantity as item__minquantity');
$this->db->select('item.maxquantity as item__maxquantity');
$this->db->select('item.buffer3months as item__buffer3months');
$this->db->select('item.expiryduration as item__expiryduration');
$this->db->select('item.expirydate as item__expirydate');
$this->db->select('item.id as id');

$this->db->join("itemcategory", "itemcategory.id = item.itemcategory_id");
$this->db->where("itemcategory.name", "Packaging");
		}
		else if ($param == 'incoming_suppliers_itemslist')
		{
		$this->db->where('purchaseorderline.quantitytoreceive >', 0);
		
		$this->db->from('purchaseorderline');
$this->db->join('supplier', 'purchaseorderline.supplier_id = supplier.id', 'left');

$this->db->join('warehouse', 'purchaseorderline.warehouse_id = warehouse.id', 'left');

$this->db->join('item', 'purchaseorderline.item_id = item.id', 'left');

$this->db->join('uom', 'purchaseorderline.uom_id = uom.id', 'left');

$this->db->select('purchaseorderline.id as purchaseorderline__id');
$this->db->select('purchaseorderline.date as purchaseorderline__date');
$this->db->select('purchaseorderline.orderid as purchaseorderline__orderid');
$this->db->select('purchaseorderline.supplier_id as purchaseorderline__supplier_id');
$this->db->select('supplier.firstname as supplier__firstname');
$this->db->select('purchaseorderline.warehouse_id as purchaseorderline__warehouse_id');
$this->db->select('warehouse.name as warehouse__name');
$this->db->select('purchaseorderline.item_id as purchaseorderline__item_id');
$this->db->select('item.name as item__name');
$this->db->select('purchaseorderline.quantity as purchaseorderline__quantity');
$this->db->select('purchaseorderline.quantityalreadyreceived as purchaseorderline__quantityalreadyreceived');
$this->db->select('purchaseorderline.quantitytoreceive as purchaseorderline__quantitytoreceive');
$this->db->select('purchaseorderline.uom_id as purchaseorderline__uom_id');
$this->db->select('uom.name as uom__name');
$this->db->select('purchaseorderline.id as id');
	if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)
		$this->db->where('purchaseorderline.supplier_id', $_POST['supplier_id']);
	if (isset($_POST['warehouse_id']) && $_POST['warehouse_id'] != -1)
		$this->db->where('purchaseorderline.warehouse_id', $_POST['warehouse_id']);
		}
		else if ($param == 'open_order_for_invoicinglist')
		{
		$this->db->where('purchaseorderline.purchaseinvoiceline_id', 0);
		
		$this->db->from('purchaseorderline');
$this->db->join('supplier', 'purchaseorderline.supplier_id = supplier.id', 'left');

$this->db->join('currency', 'purchaseorderline.currency_id = currency.id', 'left');

$this->db->join('item', 'purchaseorderline.item_id = item.id', 'left');

$this->db->join('uom', 'purchaseorderline.uom_id = uom.id', 'left');

$this->db->select('purchaseorderline.id as purchaseorderline__id');
$this->db->select('purchaseorderline.date as purchaseorderline__date');
$this->db->select('purchaseorderline.orderid as purchaseorderline__orderid');
$this->db->select('purchaseorderline.supplier_id as purchaseorderline__supplier_id');
$this->db->select('supplier.firstname as supplier__firstname');
$this->db->select('purchaseorderline.currency_id as purchaseorderline__currency_id');
$this->db->select('currency.name as currency__name');
$this->db->select('purchaseorderline.item_id as purchaseorderline__item_id');
$this->db->select('item.name as item__name');
$this->db->select('purchaseorderline.quantity as purchaseorderline__quantity');
$this->db->select('purchaseorderline.uom_id as purchaseorderline__uom_id');
$this->db->select('uom.name as uom__name');
$this->db->select('purchaseorderline.price as purchaseorderline__price');
$this->db->select('purchaseorderline.subtotal as purchaseorderline__subtotal');
$this->db->select('purchaseorderline.id as id');if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1)$this->db->where('purchaseorderline.supplier_id', $_POST['supplier_id']);if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1)$this->db->where('purchaseorderline.currency_id', $_POST['currency_id']);
		}
			
		return $data;
	}
	
	
	function convertdata($fromtable, $fromtable_id, $totable, $fromtableline='', $totableline='')
	{
		$this->db->where("id", $fromtable_id);
		$q = $this->db->get($fromtable);
		
		foreach ($q->result_array() as $row)
		{
			$fields = $this->db->list_fields($fromtable);

			foreach ($fields as $field)
			{
				if ($field != "id" && $this->db->field_exists($field, $totable))
				{
					$data[$field] = $row[$field];
				}
			}
			
			$data[$fromtable."_id"] = $row['id'];
		}
		
		if (count($data) > 0)
		{
			$this->db->insert($totable, $data);
			$totable_id = $this->db->insert_id();
			
			$data = array();
			
			if ($fromtableline != '')
			{
				$this->db->where($fromtable."_id", $fromtable_id);
				$q = $this->db->get($fromtableline);
				
				foreach ($q->result_array() as $row)
				{
					$fields = $this->db->list_fields($fromtableline);

					foreach ($fields as $field)
					{
						if ($field != "id" && $this->db->field_exists($field, $totableline))
						{
							$data[$field] = $row[$field];
						}
					}
					
					$data[$totable."_id"] = $totable_id;
				}
				
				if (count($data) > 0)
				{
					$this->db->insert($totableline, $data);
				}
			}
		}
	}
	
	function check()
	{
		//$this->ci->load->library('database');
		/*
		$this->ci->db->where("funct", $current_class_method);
		$q = $this->ci->db->get("accessline");
		
		if ($q->num_rows() == 0)
		{
			$data['funct'] = $current_class_method;
			$this->ci->db->insert("accessline", $data);
			
			echo $current_class_method." inserted.";
		}
		else
		{
			echo $current_class_method;
		}
		*/
	}
	
	function get_sort_data($data=null)
	{
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		//$data['fields'] = array('kode' => 'Kode', 'nama' => 'Nama', 'merk' => 'Merk', 'sebutan' => 'Sebutan', 'partno' => 'Part No', 'stockbaik' => 'Stock Baik', 'stockrusak' => 'Stock Rusak', 'stockbekas' => 'Stock Bekas', 'pricefob' => 'Price FOB', 'pricecnf' => 'Price CNF', 'pricelanded' => 'Price Landed', 'pricemodal' => 'Price Modal', 'pricediscjk' => 'Price Disc JK', 'pricecustomer' => 'Price Customer', 'namalokasi' => 'Lokasi', 'description' => 'Description');
		
		return $data;
	}
	
	function apply_sort_to_query($data, $performsearch=true)
	{
		if (isset($data['sortby']))
		{
			foreach ($data['sortby'] as $k=>$sb)
			{
				$this->ci->db->order_by($sb, $data['sortdirection'][$k]);
			}
		}
	}
	
	function get_paging_data($data, $totalrecs)
	{
		/*
		$data['pageno'] = 0;
		if (isset($_POST['pageno'])) 
		{
			$data['pageno'] = $_POST['pageno'];
		}
		//echo $data['pageno'];
		$data['perpage'] = 10;
		*/
		$data['totalrecords'] = $totalrecs;//$this->ci->db->count_all_results('sparepart');
		$data['totalpages'] = $data['totalrecords']/$data['perpage'];
		
		return $data;
	}
	
	function get_acl_functions()
	{
		return array(
						"projectadd" => "New Project",
						"projectedit" => "Edit Project",
						"projectdelete" => "Delete Project",
						
					);
	}
	
	function heartbeat()
	{
		$url = $this->serveraddress.'/json/asynconeway/heartbeatparam/';
		
		$fields = array(
					'SiteUrl' => site_url(),
					'By' => $this->ci->session->userdata('user'),
				);
		
		//print_r($fields);
		
		$fields_string = "";
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string,'&');

		$fields_string = http_build_query($fields);
		$fields_string = json_encode($fields);
		
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		$arr = array();
		array_push($arr, 'Content-Type: application/json; charset=utf-8');

		curl_setopt($ch, CURLOPT_HTTPHEADER, $arr);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

		//execute post
		$result = curl_exec($ch);
		$resultarr = json_decode($result, true);

		//var_dump(json_decode($result, true));

		//close connection
		curl_close($ch);
		
		return isset($resultarr['Message']) ? $resultarr['Message'] : "[Server is NOT Running]";
	}
	
	function aftersave($tablename, $id)
	{
		//echo "aftersave: ".$tablename." with id: ".$id;
		//echo "<br>";
		if ($tablename == "receiveditem")
		{
			$this->db->where("receiveditem_id", $id);
			$q = $this->db->get("receiveditemline");
		
			foreach ($q->result_array() as $data)
			{
				foreach ($data as $k=>$row)
				{
					if (substr_count($k, "date") > 0 && ($row == 0) || ($row == null) || ($row == '0000-00-00 00:00:00'))
					{
						$data[$k] = null;
						//$data[$k] = date('Y-m-h');
					}
					/*if ($k == "date" && $row == null)
					{
						$data[$k] = date("Y-m-d");
					}*/
				}
				/*echo "watch this, receiveditemline: ";
				print_r($data);
				echo "<br>";*/
				
				$childid = $data['id'];
				
				if (isset($data['id']))
					unset($data['id']);
				
				$this->db->where("id", $childid);
				$this->db->update("receiveditemline", $data);
			}
		}
		else if ($tablename == "purchaseinvoice")
		{
			$this->db->where("purchaseinvoice_id", $id);
			$q = $this->db->get("purchaseinvoiceline");
		
			foreach ($q->result_array() as $data)
			{
				foreach ($data as $k=>$row)
				{
					if (substr_count($k, "date") > 0 && ($row == 0) || ($row == null) || ($row == '0000-00-00 00:00:00'))
					{
						$data[$k] = null;
					}
					/*if ($k == "date" && $row == null)
					{
						$data[$k] = date("Y-m-d");
					}*/
				}
				
				$childid = $data['id'];
				
				if (isset($data['id']))
					unset($data['id']);
				
				$this->db->where("id", $childid);
				$this->db->update("purchaseinvoiceline", $data);
			}
		}
	}
	
	function commonfunction($methodname, $tablename, $functiontype, $id=0, $data=null)
	{
		$tabledata = array();
		
		if ($functiontype == "aftersave" || $functiontype == "afteredit")
		{
			
			$this->aftersave($tablename, $id);
			
			$this->db->where("id", $id);
			$q = $this->db->get($tablename);
			
			if ($q->num_rows() > 0)
			{
				$tabledata = $q->row_array();
				
				// all boolean values must be passed as either true or false, not 0 or 1
				if (isset($tabledata['disabled']))
					unset($tabledata['disabled']);
			}
			
			foreach ($tabledata as $k=>$row)
			{
				if ($row == null)
				{
					unset($tabledata[$k]);
				}
			}
			
			
		}
		else if ($functiontype == "validation")
		{
			$tabledata = $data;
		}
		/*
		echo "<br>";
		echo "<br>";
		print_r($tabledata);
		
		$tabledata2 = array ('id' => 0, 'orderid' => '', 'date' => '2011-05-18', 'warehouse_id' => 1, 
					'currency_id' => 1, 'currencyrate' => 1.00000, 'notes' => null, 'total' => 0.00000, 'item_id' => 4, 'quantity' => 3.00000,
					'quantityalreadyreceived' => 0.00000, 'quantitytoreceive' => 0.00000, 'uom_id' => 4, 'price' => 5000.00000, 'subtotal' => 15000.00000,
					
					);
		*/
		//$url = $this->serveraddress.'/fnparam/?format=json';
		$url = $this->serveraddress.'/json/asynconeway/fnparam/';
		
		$fields = array(
					'SiteUrl' => site_url(),
					'By' => $this->ci->session->userdata('user'),
					'MethodName' => $methodname,
					'TableName' => $tablename,
					'TableId' => $id,
					'FunctionType' => $functiontype,
					
					/*
					'purchaseorderline' => array ('id' => 0, 'orderid' => '', 'date' => '2011-05-18', 'warehouse_id' => 1, 
					'currency_id' => 1, 'currencyrate' => 1.00000, 'notes' => null, 'total' => 0.00000, 'item_id' => 4, 'quantity' => 3.00000,
					'quantityalreadyreceived' => 0.00000, 'quantitytoreceive' => 0.00000, 'uom_id' => 4, 'price' => 5000.00000, 'subtotal' => 15000.00000,
					),
					*/
					//$tablename => $tabledata,
					//'Tables' => array($tablename => $tabledata),
				);
		
		//print_r($fields);
		
		$fields_string = "";
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string,'&');

		$fields_string = http_build_query($fields);
		$fields_string = json_encode($fields);
		
		/*echo "<br>";
		echo "<br>";
		echo $fields_string;
		echo "<br>";
		echo "<br>";*/
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		$arr = array();
		array_push($arr, 'Content-Type: application/json; charset=utf-8');

		curl_setopt($ch, CURLOPT_HTTPHEADER, $arr);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

		//execute post
		$result = curl_exec($ch);
		$resultarr = json_decode($result, true);

		//var_dump(json_decode($result, true));

		//close connection
		curl_close($ch);
		
		return isset($resultarr['Message']) ? $resultarr['Message'] : "";
	}
	
	function callGetTrialBalance()
	{
		//$url = $this->serveraddress.'/json/asynconeway/trialbalanceparam/';
		//$url = $this->serveraddress.'/websetup1/json/asynconeway/trialbalanceparam/';
		$url = $this->serveraddress.'/json/asynconeway/trialbalanceparam/';
		
		$fields = array(
					'FromYear' => 0,
					'FromMonth' => 0,
					'ToYear' => 0,
					'ToMonth' => 0,
				);
		$fields_string = "";
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string,'&');

		$fields_string = http_build_query($fields);
		$fields_string = json_encode($fields);
		
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		$arr = array();
		array_push($arr, 'Content-Type: application/json; charset=utf-8');

		curl_setopt($ch, CURLOPT_HTTPHEADER, $arr);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);

		//execute post
		$result = curl_exec($ch);
		//$resultarr = $result;
		$resultarr = json_decode($result, true);

		//var_dump(json_decode($result, true));

		//close connection
		curl_close($ch);
		
		return $resultarr;
	}
	
	function callGetGeneralLedger($from_date, $to_date)
	{
		$url = $this->serveraddress.'/json/asynconeway/generalledgerparam/';
		
		$from_year = 0;
		$from_month = 0;
		$from_day = 0;
		$to_year = 0;
		$to_month = 0;
		$to_day = 0;
		
		if ($from_date != "")
		{
			$date_arr = explode("-", $from_date);
			$from_year = $date_arr[0];
			$from_month = $date_arr[1];
			$from_day = $date_arr[2];
		}
		
		if ($to_date != "")
		{		
			$date_arr = explode("-", $to_date);
			$to_year = $date_arr[0];
			$to_month = $date_arr[1];
			$to_day = $date_arr[2];
		}
		
		$fields = array(
					'FromYear' => $from_year,
					'FromMonth' => $from_month,
					'FromDay' => $from_day,
					'ToYear' => $to_year,
					'ToMonth' => $to_month,
					'ToDay' => $to_day,
				);
		$fields_string = "";
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string,'&');

		$fields_string = http_build_query($fields);
		$fields_string = json_encode($fields);
		
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		$arr = array();
		array_push($arr, 'Content-Type: application/json; charset=utf-8');

		curl_setopt($ch, CURLOPT_HTTPHEADER, $arr);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

		//execute post
		$result = curl_exec($ch);
		//$resultarr = $result;
		$resultarr = json_decode($result, true);

		//var_dump(json_decode($result, true));

		//close connection
		curl_close($ch);
		
		return $resultarr;
	}
	
	function callGetVMesg()
	{
		$url = $this->serveraddress.'/json/asynconeway/vmesg/';
		
		$fields = array(
					'By' => $this->ci->session->userdata('user'),
					);
		$fields_string = "";
		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string,'&');

		$fields_string = http_build_query($fields);
		$fields_string = json_encode($fields);
		
		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		$arr = array();
		array_push($arr, 'Content-Type: application/json; charset=utf-8');

		curl_setopt($ch, CURLOPT_HTTPHEADER, $arr);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);

		//execute post
		$result = curl_exec($ch);
		//$resultarr = $result;
		$resultarr = json_decode($result, true);

		//var_dump(json_decode($result, true));

		//close connection
		curl_close($ch);
		
		return $resultarr;
	}
}

?>