

function random_test()
{
	alert("random_test");
}

function set_supplier_id_by_receiveditem_id(siteurl, id)
  {
	$.get(siteurl + "/purchase_invoice_get_fn/get_by/supplier_id/receiveditem_id/" + id, function(data)
	{
	//alert(data);
	var test = $('select[name=purchaseinvoice__supplier_id]').val();
	//var test = $('input[name=purchaseinvoice__orderid]').val();
	if (test == null)
	{
		//alert("test is null");
		$.get(siteurl + "/create_dropdown/index/purchaseinvoice__supplier_id/1/supplier/firstname", function(dpdown)
		{
			//alert(dpdown);
			$('#purchase_invoiceform table').append('<tr><td>Supplier</td><td>' + dpdown + '</td></tr>');
			
			$('select[name=purchaseinvoice__supplier_id]').val(data);
			$('select[name=purchaseinvoice__supplier_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		//alert(test);
		$('select[name=purchaseinvoice__supplier_id]').val(data);
		$('select[name=purchaseinvoice__supplier_id]').attr("disabled", "disabled");
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
			$('select[name=purchaseinvoice__currency_id]').attr("disabled", "disabled");
		});
		
	}
	else
	{
		$('select[name=purchaseinvoice__currency_id]').val(data);
		$('select[name=purchaseinvoice__currency_id]').attr("disabled", "disabled");
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
		//alert(test);
		$('input[name=purchaseinvoice__total]').val(data);
		//$('input[name=purchaseinvoice__total]').attr("disabled", "disabled");
	}
	});
  }
  