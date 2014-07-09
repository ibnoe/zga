
<script type="text/javascript">
$(document).ready(function() {

	//alert('<?=$this->uri->uri_string();?>');
	$.get("<?=site_url();?>/sidebar/index/<?=$this->uri->segment(1);?>", function(data)
	{
		$('#sidebarplaceholder').html(data);
		
		var total_w = $(window).width();
		var side_w = $('#sidebar').width();
		
		$('#maincontent').width(total_w - side_w - 80);
	}
	);
});
</script>

<div id='sidebarplaceholder'>
</div>

<div id="footer">
	&copy; 2011 Vantage ERP
</div>
</body>
</html>