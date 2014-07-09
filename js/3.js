
function purchase_order_selected_currency_id(siteurl)
{
	var id = $('select[name=purchaseorder__currency_id]').val();
	
	$.get(siteurl + "/getcurrate/index/" + id, function(data)
	{
		$('input[name=purchaseorder__currencyrate]').val(data);
	});
}

            

function purchase_return_order_selected_currency_id(siteurl)
{
	var id = $('select[name=purchase_returnorder__currency_id]').val();
	
	$.get(siteurl + "/getcurrate/index/" + id, function(data)
	{
		$('input[name=purchase_returnorder__currencyrate]').val(data);
	});
}

            

function sales_order_selected_currency_id(siteurl)
{
	var id = $('select[name=salesorder__currency_id]').val();
	
	$.get(siteurl + "/getcurrate/index/" + id, function(data)
	{
		$('input[name=salesorder__currencyrate]').val(data);
	});
}

            

function sales_return_order_selected_currency_id(siteurl)
{
	var id = $('select[name=sales_returnorder__currency_id]').val();
	
	$.get(siteurl + "/getcurrate/index/" + id, function(data)
	{
		$('input[name=sales_returnorder__currencyrate]').val(data);
	});
}

            

function purchase_order_quote_selected_currency_id(siteurl)
{
	var id = $('select[name=purchaseorder__currency_id]').val();
	
	$.get(siteurl + "/getcurrate/index/" + id, function(data)
	{
		$('input[name=purchaseorder__currencyrate]').val(data);
	});
}

            

function sales_order_quote_selected_currency_id(siteurl)
{
	var id = $('select[name=salesorder__currency_id]').val();
	
	$.get(siteurl + "/getcurrate/index/" + id, function(data)
	{
		$('input[name=salesorder__currencyrate]').val(data);
	});
}

            

function purchase_payment_selected_currency_id(siteurl)
{
	var id = $('select[name=purchasepayment__currency_id]').val();
	
	$.get(siteurl + "/getcurrate/index/" + id, function(data)
	{
		$('input[name=purchasepayment__currencyrate]').val(data);
	});
}

            

function sales_payment_selected_currency_id(siteurl)
{
	var id = $('select[name=salespayment__currency_id]').val();
	
	$.get(siteurl + "/getcurrate/index/" + id, function(data)
	{
		$('input[name=salespayment__currencyrate]').val(data);
	});
}

            
