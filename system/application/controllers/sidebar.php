<?php

class sidebar extends Controller {

	function sidebar()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($param='')
	{
		$sidebarcontent = array(
							"contact" => array ( "title" => "Contacts",
								"modules" => array (
									//array( "target" => "karyawanlist", "title" => "Karyawan"),
									array( "target" => "company_grouplist", "title" => "Company Group"),
									array( "target" => "customerlist", "title" => "Customer"),
									//array( "target" => "contact_personlist", "title" => "Contact Person"),
									array( "target" => "marketing_officerlist", "title" => "Marketing Officer"),
									array( "target" => "supplierlist", "title" => "Supplier"),
									array( "target" => "warehouselist", "title" => "Warehouse"),
									array( "target" => "forwarderlist", "title" => "Forwarder"),
									array( "target" => "uploaded_pricelistlist", "title" => "Uploaded Pricelist"),
								),
							),
							"item" => array ( "title" => "Items",
								"modules" => array (
									array( "target" => "item_categorylist", "title" => "Item Category"),
									array( "target" => "itemlist", "title" => "Item"),
									array( "folder" => true, "title" => "Sub Items",
											"modules" => array (
												array( "target" => "blanketlist", "title" => "Blanket"),
												array( "target" => "rolllist", "title" => "Roller"),
												array( "target" => "chemicallist", "title" => "Chemical"),
												array( "target" => "corelist", "title" => "Core"),
												array( "target" => "barlist", "title" => "Bar"),
												array( "target" => "spray_powderlist", "title" => "Spray Powder"),
												array( "target" => "inklist", "title" => "Ink"),
												array( "target" => "under_packinglist", "title" => "Under Packing"),
												array( "target" => "compoundlist", "title" => "Compound"),
												array( "target" => "accessorieslist", "title" => "Accessories"),
												array( "target" => "consumablelist", "title" => "Consumable"),
												array( "target" => "packaginglist", "title" => "Packaging"),
											),
										),
									array( "target" => "uomlist", "title" => "Uom"),
								),
							),
							"purchasing" => array ( "title" => "Purchasings",
								"modules" => array (
									array( "target" => "sppadd", "plainlink" => true, "title" => "New Surat Permintaan Pembelian"),
									//array( "target" => "purchase_orderadd", "plainlink" => true, "title" => "New Purchase Order"),
									array( "target" => "spplist", "title" => "Surat Permintaan Pembelian History"),
									//array( "target" => "purchase_orderlist", "title" => "Purchase Order History"),
									array( "target" => "ongkos_kirim_importlist", "title" => "Ongkos Kirim Import"),
									array( "folder" => true, "title" => "Purchase Order",
										"modules" => array (
											array( "target" => "purchase_orderadd", "plainlink" => true, "title" => "New Purchase Order"),
											array( "target" => "purchase_order_open_receivedlist", "title" => "Purchase Order Open Received"),
											//array( "target" => "purchase_order_open_paymentlist", "title" => "Purchase Order Open Payment"),
											array( "target" => "purchase_orderlist", "title" => "Purchase Order History"),
										),
									),
									array( "folder" => true, "title" => "Purchase Return",
										"modules" => array (
											array( "target" => "received_suppliers_itemslist", "title" => "Received Suppliers Items"),
											array( "target" => "purchase_return_order_open_sentlist", "title" => "Purchase Return Order Open Sent"),
											//array( "target" => "purchase_return_order_open_paymentlist", "title" => "Purchase Return Order Open Payment"),
											array( "target" => "purchase_return_orderlist", "title" => "Purchase Return Order History"),
										),
									),
									array( "folder" => true, "title" => "Report",
										"modules" => array (
											//array( "target" => "purchaseorderreport", "plainlink" => true, "title" => "Purchase Report"),
											array( "target" => "laporan_pembelian_bulanan_cont", "plainlink" => true, "title" => "Report Pembelian Bulanan"),
											//array( "target" => "yearlypurchasereport", "plainlink" => true, "title" => "Report Pembelian Tahunan"),
											array( "target" => "laporan_pembelian_tahunan_cont", "plainlink" => true, "title" => "Report Pembelian Tahunan"),
											array( "target" => "laporan_ongkos_kirim_import", "plainlink" => true, "title" => "Laporan Ongkos Kirim Import"),
										),
									),

								),
							
							),
							/*
							"purchasereturn" => array ( "title" => "Purchase Return",
								"modules" => array (
									array( "target" => "received_suppliers_itemslist", "title" => "Received Suppliers Items"),
									array( "target" => "purchase_return_orderlist", "title" => "Purchase Return Order History"),
								),
							
							),
							*/
							"sales" => array ( "title" => "Sales",
								"modules" => array (
									array( "target" => "riflist", "title" => "RIF"),
									//array( "target" => "rcnlist", "title" => "RCN"),
									array( "target" => "penawaranadd", "plainlink" => true, "title" => "New Penawaran"),
									array( "target" => "penawaranlist", "title" => "Penawaran History"),
									array( "folder" => true, "title" => "Sales Order",
										"modules" => array (
											array( "target" => "sales_orderadd", "plainlink" => true, "title" => "New Sales Order"),
											array( "target" => "sales_order_open_sentlist", "title" => "Sales Order Open Sent"),
											//array( "target" => "sales_order_open_paymentlist", "title" => "Sales Order Open Payment"),
											array( "target" => "sales_orderlist", "title" => "Sales Order History"),
										),
									),
									array( "folder" => true, "title" => "Sales Return",
										"modules" => array (
											array( "target" => "sent_customers_itemslist", "title" => "Sent Customers Items"),
											array( "target" => "sales_return_order_open_receivedlist", "title" => "Sales Return Order Open Received"),
											//array( "target" => "sales_return_order_open_paymentlist", "title" => "Sales Return Order Open Payment"),
											array( "target" => "sales_return_orderlist", "title" => "Sales Return Order History"),
										),
									),
									array( "folder" => true, "title" => "Report",
										"modules" => array (
											//array( "target" => "salesorderreport", "plainlink" => true, "title" => "Sales Report"),
											array( "target" => "laporan_penjualan_bulanan_cont", "plainlink" => true, "title" => "Report Penjualan Bulanan"),
											array( "target" => "laporan_penjualan_tahunan_cont", "plainlink" => true, "title" => "Report Penjualan Tahunan"),
											array( "target" => "laporan_penjualan_quantity_per_marketing_tahunan_cont", "plainlink" => true, "title" => "Report Penjualan (Quantity) Tahunan Per Marketing"),
											array( "target" => "laporan_penjualan_quantity_per_item_tahunan_cont", "plainlink" => true, "title" => "Report Penjualan (Quantity) Tahunan Per Item"),
											array( "target" => "laporan_penjualan_value_per_marketing_tahunan_cont", "plainlink" => true, "title" => "Report Penjualan (Value) Tahunan Per Marketing"),
											array( "target" => "laporan_penjualan_value_per_item_tahunan_cont", "plainlink" => true, "title" => "Report Penjualan (Value) Tahunan Per Item"),
											array( "target" => "fakturpajak", "plainlink" => true, "title" => "Faktur Pajak"),
										),
									),
								),
							
							),
							/*
							"salesreturn" => array ( "title" => "Sales Return",
								"modules" => array (
									array( "target" => "sent_customers_itemslist", "title" => "Sent Customers Items"),
									array( "target" => "sales_return_orderlist", "title" => "Sales Return Order History"),
								),
							
							),
							*/
							/*
							"mfgadmin" => array ( "title" => "Manufacturing Admin",
								"modules" => array (
									array( "target" => "riflist", "title" => "RIF"),
									array( "target" => "merk_mesinlist", "title" => "Merk Mesin"),
									array( "target" => "mesinlist", "title" => "Mesin"),
									array( "target" => "surat_pengajuan_repairlist", "title" => "Pengajuan Repair"),
								),
							
							),
							*/
							"mfg" => array ( "title" => "Manufacturing",
								"modules" => array (
									array( "target" => "bill_of_materiallist", "title" => "Bill Of Material"),
									array( "folder" => true, "title" => "Manufacturing Admin",
										"modules" => array (
											array( "target" => "riflist", "title" => "RIF"),
											array( "target" => "rcnlist", "title" => "RCN"),
											array( "target" => "blanket_identification_formlist", "title" => "BIF"),
											array( "target" => "penambahan_stock_chemicallist", "title" => "Penambahan Stock Chemical"),
											array( "target" => "permintaan_stocklist", "title" => "Permintaan Stock"),
											array( "target" => "merk_mesinlist", "title" => "Merk Mesin"),
											array( "target" => "mesinlist", "title" => "Mesin"),
											array( "target" => "surat_pengajuan_repairlist", "title" => "Pengajuan Repair"),
											array( "target" => "roll_process_updatelist", "title" => "Roll Proces Update"),
										),
									),
									array( "folder" => true, "title" => "Manufacturing Form",
										"modules" => array (
											array( "target" => "get_roller_recovering_work_charts_form", "plainlink" => true, "title" => "Roller Recovering Work Charts"),
											array( "target" => "get_blanket_converting_work_instruction_form", "plainlink" => true, "title" => "Blanket Converting Work Instruction"),
											array( "target" => "get_chemical_work_instruction_form", "plainlink" => true, "title" => "Chemical Work Instruction"),
										),
									),
									array( "folder" => true, "title" => "Inspection Sheet",
										"modules" => array (
											array( "target" => "roller_inspection_sheetlist", "title" => "Roller Inspection Sheet"),
											array( "target" => "blanket_inspection_sheetlist", "title" => "Blanket Inspection Sheet"),
											array( "target" => "chemical_inspection_sheetlist", "title" => "Chemical Inspection Sheet"),
										),
									),
									
									//array( "target" => "manufacturing_orderadd", "plainlink" => true, "title" => "New Manufacturing Order"),
									
									array( "folder" => true, "title" => "Manufacturing Order",
										"modules" => array (
											array( "target" => "roller_manufacturing_orderadd", "plainlink" => true, "title" => "New Roller Manufacturing Order"),
											array( "target" => "blanket_manufacturing_orderadd", "plainlink" => true, "title" => "New Blanket Manufacturing Order"),
											array( "target" => "chemical_manufacturing_orderadd", "plainlink" => true, "title" => "New Chemical Manufacturing Order"),
											array( "target" => "core_repairadd", "plainlink" => true, "title" => "New Core Repair"),
											array( "target" => "repackingadd", "plainlink" => true, "title" => "New Repacking"),
										),
									),
									//array( "target" => "manufacturing_orderlist", "title" => "Manufacturing Order"),
									/*array( "target" => "roller_manufacturing_orderlist", "title" => "Roller Manufacturing Order"),
									array( "target" => "blanket_manufacturing_orderlist", "title" => "Blanket Manufacturing Order"),
									array( "target" => "chemical_manufacturing_orderlist", "title" => "Chemical Manufacturing Order"),*/
									array( "folder" => true, "title" => "WIP",
										"modules" => array (
											array( "target" => "manufacturing_order_progresslist", "title" => "Update Manufacturing Order Progress"),
											array( "target" => "manufacturing_order_waiting_listlist", "title" => "Manufacturing Order Waiting List"),
											array( "target" => "manufacturing_order_in_processlist", "title" => "Manufacturing Order In Process"),
											array( "target" => "manufacturing_order_already_donelist", "title" => "Manufacturing Order Already Done"),
										),
									),
									array( "folder" => true, "title" => "Manufacturing Reject",
										"modules" => array (
											//array( "target" => "manufacturing_rejectadd", "plainlink" => true, "title" => "New Manufacturing Reject"),
											//array( "target" => "manufacturing_rejectlist", "title" => "Old Manufacturing Reject"),
											array( "target" => "manufacturing_order_done_to_rejectlist", "title" => "Manufacturing Done To Reject"),
											array( "target" => "reject_manufacturinglist", "title" => "Manufacturing Reject History"),
											array( "target" => "manufacturing_reject_reasonlist", "title" => "Manufacturing Reject Reason"),
										),
									),
									array( "target" => "laporan_manufacturing_cont", "plainlink" => true, "title" => "Manufacturing Report"),
								),
							
							),
							/*
							"inventorypurchase" => array ( "title" => "Inventory - Incoming",
								"modules" => array (
									array( "target" => "incoming_suppliers_itemslist", "title" => "Incoming Suppliers Items"),
									array( "target" => "receive_itemslist", "title" => "Receive Items History"),
								),
							),
							"inventorypurchasereturn" => array ( "title" => "Inventory - Purchase Return",
								"modules" => array (
									array( "target" => "purchase_return_order_line_optionslist", "title" => "Purchase Return Order Line Options"),
									array( "target" => "purchase_return_deliverylist", "title" => "Purchase Return Delivery History"),
								),
							),
							"inventorysales" => array ( "title" => "Inventory - Outgoing",
								"modules" => array (
									array( "target" => "outgoing_customers_itemslist", "title" => "Outgoing Customers Items"),
									array( "target" => "delivery_orderlist", "title" => "Delivery Order History"),
								),
							),
							"inventorysalesreturn" => array ( "title" => "Inventory - Sales Return",
								"modules" => array (
									array( "target" => "sales_return_order_line_optionslist", "title" => "Sales Return Order Line Options"),
									array( "target" => "sales_return_deliverylist", "title" => "Sales Return Delivery History"),
								),
							),
							*/
							"inventory" => array ( "title" => "Inventory",
								"modules" => array (
									array( "folder" => true, "title" => "Incoming PO",
										"modules" => array (
											array( "target" => "incoming_suppliers_itemslist", "title" => "Incoming Suppliers Items"),
											array( "target" => "receive_itemslist", "title" => "Receive Items History"),
										),
									),
									array( "folder" => true, "title" => "Penerimaan Item Service",
										"modules" => array (
											array( "target" => "penerimaan_item_for_serviceadd", "plainlink" => true, "title" => "New Penerimaan Item For Service"),
											array( "target" => "penerimaan_item_for_servicelist", "title" => "Penerimaan Item For Service History"),
										),
									),
									array( "folder" => true, "title" => "Outgoing SO",
										"modules" => array (
											array( "target" => "outgoing_customers_itemslist", "title" => "Outgoing Customers Items"),
											array( "target" => "delivery_orderlist", "title" => "Delivery Order History"),
										),
									),
									array( "folder" => true, "title" => "Purchase Return",
										"modules" => array (
											array( "target" => "purchase_return_order_line_optionslist", "title" => "Purchase Return Order Line Options"),
											array( "target" => "purchase_return_deliverylist", "title" => "Purchase Return Delivery History"),
										),
									),
									array( "folder" => true, "title" => "Sales Return",
										"modules" => array (
											array( "target" => "sales_return_order_line_optionslist", "title" => "Sales Return Order Line Options"),
											array( "target" => "sales_return_deliverylist", "title" => "Sales Return Delivery History"),
										),
									),
									array( "folder" => true, "title" => "Stock Movement",
										"modules" => array (
											array( "target" => "move_orderlist", "title" => "Move Order"),
											array( "target" => "open_move_orderlist", "title" => "Open Move Order"),
											array( "target" => "stock_movementlist", "title" => "Stock Movement History"),
										),
									),
									array( "folder" => true, "title" => "Report",
										"modules" => array (
											array( "target" => "stockcard", "plainlink" => true, "title" => "Stock Card"),
										),
									),
									
									array( "target" => "stocklist", "title" => "Stock"),
								),
							),
							"finance" => array ( "title" => "Finance",
								"modules" => array (
									array( "target" => "currencylist", "title" => "Currency"),
									array( "target" => "credit_note_inlist", "title" => "Credit Note Masuk"),
									array( "target" => "open_credit_note_inlist", "title" => "Credit Note Masuk Untuk Flagging"),
									array( "target" => "credit_note_outlist", "title" => "Credit Note Keluar"),
									array( "target" => "open_credit_note_outlist", "title" => "Credit Note Keluar Untuk Flagging"),
									array( "target" => "giro_inlist", "title" => "Giro Masuk"),
									array( "target" => "open_giro_inlist", "title" => "Giro Masuk Untuk Clearing"),
									array( "target" => "giro_outlist", "title" => "Giro Keluar"),
									array( "target" => "open_giro_outlist", "title" => "Giro Keluar Untuk Clearing"),
									array( "target" => "bank_transfer_masuklist", "title" => "Bank Transfer Masuk"),
									array( "target" => "open_bank_transfer_inlist", "title" => "Bank Transfer Masuk Untuk Flagging"),
									array( "target" => "bank_transfer_keluarlist", "title" => "Bank Transfer Keluar"),
									array( "target" => "open_bank_transfer_outlist", "title" => "Bank Transfer Keluar Untuk Flagging"),
									array( "target" => "kurs_historylist", "title" => "Kurs History"),
									array( "folder" => true, "title" => "Purchasing",
										"modules" => array (
											//array( "target" => "open_order_for_invoicinglist", "title" => "Open Purchase Order For Invoicing"),
											array( "target" => "purchase_invoicelist", "title" => "Purchase Invoice"),
											array( "target" => "open_purchase_invoice_for_paymentlist", "title" => "Open Purchase Invoice For Payment"),
											array( "target" => "purchase_paymentlist", "title" => "Purchase Payment"),
											array( "target" => "giro_outlist", "title" => "GIRO Keluar"),
										),
									),
									array( "folder" => true, "title" => "Sales",
										"modules" => array (
											//array( "target" => "open_sales_order_for_invoicinglist", "title" => "Open Sales Order For Invoicing"),
											array( "target" => "sales_invoicelist", "title" => "Sales Invoice"),
											array( "target" => "open_sales_invoice_for_paymentlist", "title" => "Open Sales Invoice For Payment"),
											array( "target" => "sales_paymentlist", "title" => "Sales Payment"),
											array( "target" => "giro_inlist", "title" => "GIRO Masuk"),
										),
									),
									array( "folder" => true, "title" => "Purchase Return",
										"modules" => array (
											//array( "target" => "purchase_return_order_for_invoicinglist", "title" => "Purchase Return Order For Invoicing"),
											array( "target" => "purchase_return_invoicelist", "title" => "Purchase Return Invoice History"),
											array( "target" => "open_purchase_return_invoice_for_paymentlist", "title" => "Open Purchase Return Invoice For Payment"),
											array( "target" => "purchase_return_paymentlist", "title" => "Purchase Return Payment"),
										),
									),
									array( "folder" => true, "title" => "Sales Return",
										"modules" => array (
											//array( "target" => "sales_return_for_invoicinglist", "title" => "Sales Return For Invoicing"),
											array( "target" => "sales_return_invoicelist", "title" => "Sales Return Invoice History"),
											array( "target" => "open_sales_return_invoice_for_paymentlist", "title" => "Open Sales Return Invoice For Payment"),
											array( "target" => "sales_return_paymentlist", "title" => "Sales Return Payment"),
										),
									),
									array( "folder" => true, "title" => "Reports",
										"modules" => array (
											//array( "target" => "bank_report", "plainlink" => true,"title" => "Bank Report"),
											//array( "target" => "cash_report", "plainlink" => true,"title" => "Cash Report"),
											array( "target" => "ar_statement", "plainlink" => true,"title" => "AR Statement"),
											array( "target" => "ar_due", "plainlink" => true,"title" => "AR Due"),
											array( "target" => "ap_statement", "plainlink" => true,"title" => "AP Statement"),
										),
									),
								),
							),
							/*
							"financepur" => array ( "title" => "Finance - Purchasing",
								"modules" => array (
									array( "target" => "open_order_for_invoicinglist", "title" => "Open Purchase Order For Invoicing"),
									array( "target" => "purchase_invoicelist", "title" => "Purchase Invoice"),
									array( "target" => "open_purchase_invoice_for_paymentlist", "title" => "Open Purchase Invoice For Payment"),
									array( "target" => "purchase_paymentlist", "title" => "Purchase Payment"),
									array( "target" => "giro_outlist", "title" => "GIRO Keluar"),
									array( "target" => "credit_note_outlist", "title" => "Credit Note Keluar"),
								),
							),
							"financepurreturn" => array ( "title" => "Finance - Purchase Return",
								"modules" => array (
									array( "target" => "purchase_return_order_for_invoicinglist", "title" => "Purchase Return Order For Invoicing"),
									array( "target" => "purchase_return_invoicelist", "title" => "Purchase Return Invoice History"),
									array( "target" => "open_purchase_return_invoice_for_paymentlist", "title" => "Open Purchase Return Invoice For Payment"),
									array( "target" => "purchase_return_paymentlist", "title" => "Purchase Return Payment"),
								),
							),
							"financesal" => array ( "title" => "Finance - Sales",
								"modules" => array (
									array( "target" => "open_sales_order_for_invoicinglist", "title" => "Open Sales Order For Invoicing"),
									array( "target" => "sales_invoicelist", "title" => "Sales Invoice"),
									array( "target" => "open_sales_invoice_for_paymentlist", "title" => "Open Sales Invoice For Payment"),
									array( "target" => "sales_paymentlist", "title" => "Sales Payment"),
									array( "target" => "giro_inlist", "title" => "GIRO Masuk"),
									array( "target" => "credit_note_inlist", "title" => "Credit Note Masuk"),
								),
							),
							"financesalreturn" => array ( "title" => "Finance - Sales Return",
								"modules" => array (
									array( "target" => "sales_return_for_invoicinglist", "title" => "Sales Return For Invoicing"),
									array( "target" => "sales_return_invoicelist", "title" => "Sales Return Invoice History"),
									array( "target" => "open_sales_return_invoice_for_paymentlist", "title" => "Open Sales Return Invoice For Payment"),
									array( "target" => "sales_return_paymentlist", "title" => "Sales Return Payment"),
								),
							),
							*/
							"accounting" => array ( "title" => "Accounting",
								"modules" => array (
									array( "target" => "account_typelist", "title" => "Account Type"),
									array( "target" => "accountslist", "title" => "Accounts"),
									array( "target" => "fixed_assetlist", "title" => "Fixed Asset"),
									array( "target" => "journal_manualadd2", "plainlink" => true, "title" => "New Journal Manual"),
									array( "target" => "journal_manuallist", "title" => "Journal Manual"),
									array( "target" => "stock_adjustmentlist", "title" => "Stock Adjustment"),
									array( "target" => "cash_banklist", "title" => "Kas dan Bank"),
									//array( "target" => "general_ledgerreportfilter", "title" => "General Ledger"),
									array( "target" => "journallist", "title" => "Journal"),
									array( "folder" => true, "title" => "Report",
										"modules" => array (
											array( "target" => "generalledger", "plainlink" => true, "title" => "General Ledger"),
											array( "target" => "trialbalance", "plainlink" => true, "title" => "Trial Balance"),
											array( "target" => "balancesheet", "plainlink" => true, "title" => "Balance Sheet"),
											//array( "target" => "cashflow", "plainlink" => true, "title" => "Cashflow Report"),
											array( "target" => "profitloss", "plainlink" => true, "title" => "Profit Loss")
										),
									),
								),
							),
							"hr" => array ( "title" => "Human Resource",
								"modules" => array (
									array( "target" => "karyawanlist", "title" => "Karyawan"),
									array( "target" => "cuti_to_processlist", "title" => "Cuti To Process"),
									array( "target" => "karyawan_probationlist", "title" => "Karyawan Probation"),
									array( "target" => "klaim_tunjangan_kesehatan_to_processlist", "title" => "Klaim Tunjangan Kesehatan To Process"),
								),
							),
						);
		$data['sidebarcontent'] = $sidebarcontent;
		
		$data['selected'] = '';
		$found = false;
		
		foreach ($sidebarcontent as $v)
		{
			if (isset($v['target']))
			{
				if ($param == $v['target'])
				{
					$data['selected'] = $v['target'];
					$found = true;
					break;
				}
			}
			else
			{
				foreach ($v['modules'] as $secondrow)
				{
					if (isset($secondrow['target']))
					{
						if ($param == $secondrow['target'])
						{
							$data['selected'] = $secondrow['target'];
							$found = true;
							break;
						}
					}
					else
					{
						foreach ($secondrow['modules'] as $thridrow)
						{
							if (isset($thridrow['target']))
							{
								if ($param == $thridrow['target'])
								{
									$data['selected'] = $thridrow;
									$found = true;
									break;
								}
							}
							
							if ($found)
								break;
						}
					}
					
					if ($found)
						break;
				}
			}
			
			if ($found)
				break;
		}
		
		$this->load->view('sidebar_view', $data);
	}
}
?>