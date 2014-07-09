
function purchase_invoice_selected_receiveditem_id(siteurl)
{
set_currency_id_by_receiveditem_id(siteurl, $('select[name=purchaseinvoice__receiveditem_id]').val());
set_supplier_id_by_receiveditem_id(siteurl, $('select[name=purchaseinvoice__receiveditem_id]').val());
set_total_by_receiveditem_id(siteurl, $('select[name=purchaseinvoice__receiveditem_id]').val());
set_currencyrate_by_receiveditem_id(siteurl, $('select[name=purchaseinvoice__receiveditem_id]').val());
}

function set_supplier_id_by_receiveditem_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_invoice_get_fn/get_by/supplier_id/receiveditem_id/" + id, function(data)
	{
	var test = $('select[name=purchaseinvoice__supplier_id]').val();
	if (test == null)
	{
		$.get(siteurl + "/create_dropdown/index/purchaseinvoice__supplier_id/1/supplier/firstname", function(dpdown)
		{
			$('#purchase_invoiceform table').append('<tr><td>Supplier</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=purchaseinvoice__supplier_id]').val(data);
			//$('select[name=purchaseinvoice__supplier_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=purchaseinvoice__supplier_id]').val(data);
		//$('select[name=purchaseinvoice__supplier_id]').attr("disabled", "disabled");
	}
	});
  }
  
 function set_currency_id_by_receiveditem_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_invoice_get_fn/get_by/currency_id/receiveditem_id/" + id, function(data)
	{	
	var test = $('select[name=purchaseinvoice__currency_id]').val();
	
	if (test == null)
	{
		$.get(siteurl + "/create_dropdown/index/purchaseinvoice__currency_id/1/currency/name", function(dpdown)
		{
			$('#purchase_invoiceform table').append('<tr><td>Currency</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=purchaseinvoice__currency_id]').val(data);
			//$('select[name=purchaseinvoice__currency_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=purchaseinvoice__currency_id]').val(data);
		//$('select[name=purchaseinvoice__currency_id]').attr("disabled", "disabled");
	}
	});
  }
  
  function set_total_by_receiveditem_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_invoice_get_fn/get_by/total/receiveditem_id/" + id, function(data)
	{
	var test = $('input[name=purchaseinvoice__total]').val();
	
	if (test == null)
	{
		$('#purchase_invoiceform table').append('<tr><td>Total</td><td><input type="text" name="purchaseinvoice__total" value="" class="basic"></input></td></tr>');
	}
	//else
	{
		$('input[name=purchaseinvoice__total]').val(data);
		//$('input[name=purchaseinvoice__total]').attr("disabled", "disabled");
	}
	});
  }

  function set_currencyrate_by_receiveditem_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_invoice_get_fn/get_by/currencyrate/receiveditem_id/" + id, function(data)
	{
	var test = $('input[name=purchaseinvoice__currencyrate]').val();
	
	if (test == null)
	{
		$('#purchase_invoiceform table').append('<tr><td>Currency Rate</td><td><input type="text" name="purchaseinvoice__currencyrate" value="" class="basic"></input></td></tr>');
	}
	
	{
		$('input[name=purchaseinvoice__currencyrate]').val(data);
		//$('input[name=purchaseinvoice__currencyrate]').attr("disabled", "disabled");
	}
	});
  }
  
            

function purchase_return_invoice_selected_purchasereturndelivery_id(siteurl)
{
set_currency_id_by_purchasereturndelivery_id(siteurl, $('select[name=purchasereturninvoice__purchasereturndelivery_id]').val());
set_supplier_id_by_purchasereturndelivery_id(siteurl, $('select[name=purchasereturninvoice__purchasereturndelivery_id]').val());
set_total_by_purchasereturndelivery_id(siteurl, $('select[name=purchasereturninvoice__purchasereturndelivery_id]').val());
set_currencyrate_by_purchasereturndelivery_id(siteurl, $('select[name=purchasereturninvoice__purchasereturndelivery_id]').val());
}

function set_supplier_id_by_purchasereturndelivery_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_return_invoice_get_fn/get_by/supplier_id/purchasereturndelivery_id/" + id, function(data)
	{
	var test = $('select[name=purchasereturninvoice__supplier_id]').val();
	if (test == null)
	{
		$.get(siteurl + "/create_dropdown/index/purchasereturninvoice__supplier_id/1/supplier/firstname", function(dpdown)
		{
			$('#purchase_return_invoiceform table').append('<tr><td>Supplier</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=purchasereturninvoice__supplier_id]').val(data);
			//$('select[name=purchasereturninvoice__supplier_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=purchasereturninvoice__supplier_id]').val(data);
		//$('select[name=purchasereturninvoice__supplier_id]').attr("disabled", "disabled");
	}
	});
  }
  
 function set_currency_id_by_purchasereturndelivery_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_return_invoice_get_fn/get_by/currency_id/purchasereturndelivery_id/" + id, function(data)
	{	
	var test = $('select[name=purchasereturninvoice__currency_id]').val();
	
	if (test == null)
	{
		$.get(siteurl + "/create_dropdown/index/purchasereturninvoice__currency_id/1/currency/name", function(dpdown)
		{
			$('#purchase_return_invoiceform table').append('<tr><td>Currency</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=purchasereturninvoice__currency_id]').val(data);
			//$('select[name=purchasereturninvoice__currency_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=purchasereturninvoice__currency_id]').val(data);
		//$('select[name=purchasereturninvoice__currency_id]').attr("disabled", "disabled");
	}
	});
  }
  
  function set_total_by_purchasereturndelivery_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_return_invoice_get_fn/get_by/total/purchasereturndelivery_id/" + id, function(data)
	{
	var test = $('input[name=purchasereturninvoice__total]').val();
	
	if (test == null)
	{
		$('#purchase_return_invoiceform table').append('<tr><td>Total</td><td><input type="text" name="purchasereturninvoice__total" value="" class="basic"></input></td></tr>');
	}
	//else
	{
		$('input[name=purchasereturninvoice__total]').val(data);
		//$('input[name=purchasereturninvoice__total]').attr("disabled", "disabled");
	}
	});
  }

  function set_currencyrate_by_purchasereturndelivery_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_return_invoice_get_fn/get_by/currencyrate/purchasereturndelivery_id/" + id, function(data)
	{
	var test = $('input[name=purchasereturninvoice__currencyrate]').val();
	
	if (test == null)
	{
		$('#purchase_return_invoiceform table').append('<tr><td>Currency Rate</td><td><input type="text" name="purchasereturninvoice__currencyrate" value="" class="basic"></input></td></tr>');
	}
	
	{
		$('input[name=purchasereturninvoice__currencyrate]').val(data);
		//$('input[name=purchasereturninvoice__currencyrate]').attr("disabled", "disabled");
	}
	});
  }
  
            

function sales_invoice_selected_deliveryorder_id(siteurl)
{
set_currency_id_by_deliveryorder_id(siteurl, $('select[name=salesinvoice__deliveryorder_id]').val());
set_customer_id_by_deliveryorder_id(siteurl, $('select[name=salesinvoice__deliveryorder_id]').val());
set_total_by_deliveryorder_id(siteurl, $('select[name=salesinvoice__deliveryorder_id]').val());
set_currencyrate_by_deliveryorder_id(siteurl, $('select[name=salesinvoice__deliveryorder_id]').val());
}

function set_customer_id_by_deliveryorder_id(siteurl, id)
  {
	$.get(siteurl + "/sales_invoice_get_fn/get_by/customer_id/deliveryorder_id/" + id, function(data)
	{
	var test = $('select[name=salesinvoice__customer_id]').val();
	if (test == null)
	{
		$.get(siteurl + "/create_dropdown/index/salesinvoice__customer_id/1/supplier/firstname", function(dpdown)
		{
			$('#sales_invoiceform table').append('<tr><td>Customer</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=salesinvoice__customer_id]').val(data);
			//$('select[name=salesinvoice__customer_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=salesinvoice__customer_id]').val(data);
		//$('select[name=salesinvoice__customer_id]').attr("disabled", "disabled");
	}
	});
  }
  
 function set_currency_id_by_deliveryorder_id(siteurl, id)
  {
	$.get(siteurl + "/sales_invoice_get_fn/get_by/currency_id/deliveryorder_id/" + id, function(data)
	{	
	var test = $('select[name=salesinvoice__currency_id]').val();
	
	if (test == null)
	{
		$.get(siteurl + "/create_dropdown/index/salesinvoice__currency_id/1/currency/name", function(dpdown)
		{
			$('#sales_invoiceform table').append('<tr><td>Currency</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=salesinvoice__currency_id]').val(data);
			//$('select[name=salesinvoice__currency_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=salesinvoice__currency_id]').val(data);
		//$('select[name=salesinvoice__currency_id]').attr("disabled", "disabled");
	}
	});
  }
  
  function set_total_by_deliveryorder_id(siteurl, id)
  {
	$.get(siteurl + "/sales_invoice_get_fn/get_by/total/deliveryorder_id/" + id, function(data)
	{
	var test = $('input[name=salesinvoice__total]').val();
	
	if (test == null)
	{
		$('#sales_invoiceform table').append('<tr><td>Total</td><td><input type="text" name="salesinvoice__total" value="" class="basic"></input></td></tr>');
	}
	//else
	{
		$('input[name=salesinvoice__total]').val(data);
		//$('input[name=salesinvoice__total]').attr("disabled", "disabled");
	}
	});
  }

  function set_currencyrate_by_deliveryorder_id(siteurl, id)
  {
	$.get(siteurl + "/sales_invoice_get_fn/get_by/currencyrate/deliveryorder_id/" + id, function(data)
	{
	var test = $('input[name=salesinvoice__currencyrate]').val();
	
	if (test == null)
	{
		$('#sales_invoiceform table').append('<tr><td>Currency Rate</td><td><input type="text" name="salesinvoice__currencyrate" value="" class="basic"></input></td></tr>');
	}
	
	{
		$('input[name=salesinvoice__currencyrate]').val(data);
		//$('input[name=salesinvoice__currencyrate]').attr("disabled", "disabled");
	}
	});
  }
  
            

function sales_return_invoice_selected_salesreturndelivery_id(siteurl)
{
set_currency_id_by_salesreturndelivery_id(siteurl, $('select[name=salesreturninvoice__salesreturndelivery_id]').val());
set_supplier_id_by_salesreturndelivery_id(siteurl, $('select[name=salesreturninvoice__salesreturndelivery_id]').val());
set_total_by_salesreturndelivery_id(siteurl, $('select[name=salesreturninvoice__salesreturndelivery_id]').val());
set_currencyrate_by_salesreturndelivery_id(siteurl, $('select[name=salesreturninvoice__salesreturndelivery_id]').val());
}

function set_supplier_id_by_salesreturndelivery_id(siteurl, id)
  {
	$.get(siteurl + "/sales_return_invoice_get_fn/get_by/supplier_id/salesreturndelivery_id/" + id, function(data)
	{
	var test = $('select[name=salesreturninvoice__supplier_id]').val();
	if (test == null)
	{
		$.get(siteurl + "/create_dropdown/index/salesreturninvoice__supplier_id/1/supplier/firstname", function(dpdown)
		{
			$('#sales_return_invoiceform table').append('<tr><td>Supplier</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=salesreturninvoice__supplier_id]').val(data);
			//$('select[name=salesreturninvoice__supplier_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=salesreturninvoice__supplier_id]').val(data);
		//$('select[name=salesreturninvoice__supplier_id]').attr("disabled", "disabled");
	}
	});
  }
  
 function set_currency_id_by_salesreturndelivery_id(siteurl, id)
  {
	$.get(siteurl + "/sales_return_invoice_get_fn/get_by/currency_id/salesreturndelivery_id/" + id, function(data)
	{	
	var test = $('select[name=salesreturninvoice__currency_id]').val();
	
	if (test == null)
	{
		$.get(siteurl + "/create_dropdown/index/salesreturninvoice__currency_id/1/currency/name", function(dpdown)
		{
			$('#sales_return_invoiceform table').append('<tr><td>Currency</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=salesreturninvoice__currency_id]').val(data);
			//$('select[name=salesreturninvoice__currency_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=salesreturninvoice__currency_id]').val(data);
		//$('select[name=salesreturninvoice__currency_id]').attr("disabled", "disabled");
	}
	});
  }
  
  function set_total_by_salesreturndelivery_id(siteurl, id)
  {
	$.get(siteurl + "/sales_return_invoice_get_fn/get_by/total/salesreturndelivery_id/" + id, function(data)
	{
	var test = $('input[name=salesreturninvoice__total]').val();
	
	if (test == null)
	{
		$('#sales_return_invoiceform table').append('<tr><td>Total</td><td><input type="text" name="salesreturninvoice__total" value="" class="basic"></input></td></tr>');
	}
	//else
	{
		$('input[name=salesreturninvoice__total]').val(data);
		//$('input[name=salesreturninvoice__total]').attr("disabled", "disabled");
	}
	});
  }

  function set_currencyrate_by_salesreturndelivery_id(siteurl, id)
  {
	$.get(siteurl + "/sales_return_invoice_get_fn/get_by/currencyrate/salesreturndelivery_id/" + id, function(data)
	{
	var test = $('input[name=salesreturninvoice__currencyrate]').val();
	
	if (test == null)
	{
		$('#sales_return_invoiceform table').append('<tr><td>Currency Rate</td><td><input type="text" name="salesreturninvoice__currencyrate" value="" class="basic"></input></td></tr>');
	}
	
	{
		$('input[name=salesreturninvoice__currencyrate]').val(data);
		//$('input[name=salesreturninvoice__currencyrate]').attr("disabled", "disabled");
	}
	});
  }
  
            
