<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Zentrum Graphic Asia - Management System</title>
<link href="<?=base_url();?>/css/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>css/jquery.pnotify.default.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=base_url()."/";?>js/jquery-1.5.1.min.js" /></script>
  <script type="text/javascript" src="<?=base_url()."/";?>js/jquery-ui-1.8.13.custom.min.js"></script>
  <script type="text/javascript" src="<?=base_url();?>/js/jquery.form.js"></script>
  <script type="text/javascript" src="<?=base_url();?>js/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?=base_url();?>/js/jquery.pnotify.min.js"></script>
  <script type="text/javascript" src="<?=base_url();?>/js/2.js" /></script>
  <script type="text/javascript" src="<?=base_url();?>/js/3.js" /></script>

</head>
<body>
<script type="application/javascript">
$(document).ready(function() {
	$.get("<?=site_url();?>/heartbeat", function (data) {
		$("#heartbeat").html(data);
	});
});
</script>
<div class="logo"><a href="<?=site_url();?>"><img src="<?=base_url();?>/css/images/zentrum_logo.gif" border="0"/></a>management system <span id="heartbeat"></span></div>
<div id="header">

<script type="text/javascript">
$(document).ready(function() {

	$('input:reset').button();
	$('input:button').button();
	$('input:submit').button();
	$('input:text').addClass("text ui-widget-content ui-corner-all");
	//$('input:textarea').addClass("text ui-widget-content ui-corner-all");
	
	//alert(hexMD5('\107' + '' + '\063\013\234\364\065\150\256\075\350\106\155\275\063\335\225\101'));

	$('#notificationlink').click(function()
	{
		//$.pnotify({ pnotify_title: 'Regular Notice', pnotify_text: 'Check me out! I\'m a notice.', pnotify_history: false });
		
	
		var target = $(this).attr('href');
		var targeturl = "<?=site_url();?>" + "/" + target;
		//alert(targeturl);
		
		$.get(targeturl, function(data)
		{
			$('#maincontent').html(data);
		}
		);
		
		return false;
	});
	
	/*
	var g_notificationcount = 0;
	
	$.get("<?=site_url();?>" + "/notificationlist/", function(data)
	{
		g_notificationcount = $("#notificationlistform table.main tr").length;
		//alert(g_notificationcount);
	});
	
	$('#notificationlink').click(function()
	{
		$.pnotify({ pnotify_title: 'Regular Notice', pnotify_text: 'Check me out! I\'m a notice.', pnotify_history: false });
		
	
		var target = $(this).attr('href');
		var targeturl = "<?=site_url();?>" + "/" + target;
		//alert(targeturl);
		
		$.get(targeturl, function(data)
		{
			$('#maincontent').html(data);
		}
		);
		
		$.get(targeturl, function(data)
		{
			var notificationcount = $("#notificationlistform table.main tr").length;
			
			if (g_notificationcount != notificationcount)
			{
				$('#notificationlink').html('NOTIFICATION<span>*</span>');
				//$('#notificationlink').html('NOTIFICATION ' + g_notificationcount + " : " + notificationcount);
			}
			else
				$('#notificationlink').html('NOTIFICATION');
			
			g_notificationcount = notificationcount;
		});
		
		return false;
	});
	*/
	//setInterval(function() {$.pnotify({ pnotify_title: 'Regular Notice', pnotify_text: 'Check me out! I\'m a notice.', pnotify_history: false });}, 1000);
	setInterval(function() {
		
		$.get("<?=site_url();?>" + "/vmesg", function(data) { 
		
		$(data).find("#msgtable tr").each(function () {
		
		var content_arr = $(this).find("td");
		var title = content_arr[0];
		var content = content_arr[1];
		
		//$.pnotify({ pnotify_title: 'Axel', pnotify_text: 'Check me out! I\'m a notice.', pnotify_history: false });
		$.pnotify({ pnotify_title: title, pnotify_text: content, pnotify_history: false }); 
		})
		
		});
		
		
	}, 3000);
});
</script>

<style type="text/css">
.ui-widget{ font-size: 10px; }
</style>

<ul id="headermenu">
	<li><a id='notificationlink' href="notificationlist">NOTIFICATION</a></li>
	<li><a href="<?=site_url()."/login/logout";?>">Logout</a></li>
    <li>
		<a href="#" onmouseover="mopen('acl')" onmouseout="mclosetime()">ACL</a>
        <div id="acl" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
			<!--<a href="#">Change Password</a>-->
			<a href="<?=site_url()."/login/logout";?>">Logout</a>
        </div>
    </li>
    <li><a href="#" onmouseover="mopen('inventory')" onmouseout="mclosetime()">INVENTORY</a>
        <div id="inventory" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
			<a class='jslinks' href="stocklist">All inventory</a>
			<!--<a href="#">Rollers</a>
			<a href="#">Core</a>
			<a href="#">Blanket</a>-->
        </div>
    </li>
    <li>
		<a href="#" onmouseover="mopen('help')" onmouseout="mclosetime()">HELP</a>
        <!--<div id="help" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
			<a href="#">Guide Book</a>
			<a href="#">Contact</a>
        </div>-->
	</li>
    <li><a href="#">ABOUT</a></li>
</ul>
<div class="clear"></div>
</div>

<script type="text/javascript">
	function openlink(url)
	{
		location.href=url;
		//window.open(url);
	}
	
	function openlink2(url)
	{
		location.href=url;
		//window.open(url);
	}
  </script>
