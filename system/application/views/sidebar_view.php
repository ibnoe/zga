<script type="text/javascript">
$(document).ready(function() {

//$("#subnav ul").hide();
$("#sidenav li:has(ul)").each(function() {
$(this).children().slideUp(400);
});

$("li.p3 a").each(function() {
//$(this).children().slideUp(400);
//alert($(this).text());
//alert($(this).attr('href') + " == " + '<?=site_url()."/".$this->uri->segment(3);?>');
//alert($(this).attr('href') + " == " + '<?=$this->uri->uri_string();?>');
//alert($(this).parent().parent().text());

if ($(this).attr('href') == '<?=site_url()."/".$this->uri->segment(3);?>')
{
	//alert("hey");	
	$(this).parent().parent().slideDown(400);
	$(this).parent().parent().parent().parent().slideDown(400);
	//$(this).parent().parent().parent().parent().slideDown(400);
}

});

$("li.p2 a").each(function() {
if ($(this).attr('href') == '<?=site_url()."/".$this->uri->segment(3);?>')
{
	$(this).parent().parent().slideDown(400);	
}

});

$("li.p1:has(ul)").click(function(event){
if (this == event.target) {
var current = this;
$("li.p1:has(ul)").each(function() {
//if (this != current) $(this).children().slideUp(400);
});
$("#subnav li:has(ul)").each(function() {
//if (this != current) $(this).children().slideUp(400);
});
$("ul:first", $(this)).slideToggle(400);
}
});

$("li.p2:has(ul)").click(function(event){
if (this == event.target) {
var current = this;
$("li.p2:has(ul)").each(function() {
//if (this != current) $(this).children().slideUp(400);
});
$("li.p3:has(ul)").each(function() {
//if (this != current) $(this).children().slideUp(400);
});
$("ul:first", $(this)).slideToggle(400);
}
});

$("li.p3:has(ul)").click(function(event){
if (this == event.target) {
var current = this;
$("li.p3:has(ul)").each(function() {
if (this != current) $(this).children().slideUp(400);
});
$("ul:first", $(this)).slideToggle(400);
}
});

});
</script>
<div id="sidebar">
<ul id="sidenav">

<script type="text/javascript">
$(document).ready(function() {
	$('.jslinks').click(function()
	{
		//alert('aaa');
		var target = $(this).attr('href');
		var title = $(this).attr('title');
		var targeturl = "<?=site_url();?>" + "/" + target;
		//alert(targeturl);
		$.get(targeturl, function(data)
		{
			//alert(title);
			data = '<h3>' + title + '</h3>' + data;
			$('#maincontent').html(data);
			//alert('ok');
		}
		);
		
		return false;
	});
});
</script>

<?php foreach ($sidebarcontent as $row): ?>
	<li class="p1 down"><?=$row['title'];?>
		<ul class="subsidenav">
				<?php foreach ($row['modules'] as $modrow): ?>
					
					<?php if (isset($modrow['folder'])): ?>
						<li class="p2 down"><?=$modrow['title'];?>
							<ul class="subsidenav">
								<?php foreach ($modrow['modules'] as $modrow2): ?>
							
									<?php if (isset($modrow2['plainlink'])): ?>
										<li class="p3"><a href="<?=site_url()."/".$modrow2['target'];?>"><?=$modrow2['title'];?></a></li>
									<?php elseif (isset($modrow2['target'])): ?>
										<li class="p3"><a class='jslinks' href="<?=$modrow2['target'];?>" title="<?=$modrow2['title'];?>"><?=$modrow2['title'];?></a></li>
									<?php else: ?>
										<ul class="subsidenav">
											<?php foreach ($row['modules'] as $thirdrow): ?>
												<?php if (isset($thirdrow['target'])): ?>
													<li class="p4"><a class='jslinks' href="<?=$thirdrow['target'];?>" title="<?=$thirdrow['title'];?>"><?=$thirdrow['title'];?></a></li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
									
								<?php endforeach; ?>
							</ul>
						</li>
					<?php elseif (isset($modrow['plainlink'])): ?>
						<li class="p2 down"><a href="<?=site_url()."/".$modrow['target'];?>"><?=$modrow['title'];?></a></li>
					<?php elseif (isset($modrow['target'])): ?>
						<li class="p2 down"><a class='jslinks' href="<?=$modrow['target'];?>" title="<?=$modrow['title'];?>"><?=$modrow['title'];?></a></li>
					<?php else: ?>
						<ul class="subsidenav">
							<?php foreach ($row['modules'] as $thirdrow): ?>
								<?php if (isset($thirdrow['target'])): ?>
									<li><a class='jslinks' href="<?=$thirdrow['target'];?>" title="<?=$thirdrow['title'];?>"><?=$thirdrow['title'];?></a></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					
				<?php endforeach; ?>
		</ul>
	</li>
<?php endforeach; ?>

<!--
<li class="p1 down">Contact
	<ul class="subsidenav">
		<li class="p2 down">Customer
			<ul class="subsidenav">
				<li><a href="#">Add New Customer</a></li>
				<li><a href="#">List All Customers</a></li>
			</ul>
		</li>
		<li class="p2 down">Supplier
			<ul class="subsidenav">
				<li><a href="#">Add New Supplier</a></li>
				<li><a href="#">List All Suppliers</a></li>
			</ul>
		</li>
		<li><a href="#">Location</a></li>
	</ul>
</li>

<li class="p1 down">Item
	<ul class="subsidenav">
		<li><a href="#">UOM</a></li>
		<li><a href="#">Blanket</a></li>
		<li><a href="#">Roll</a></li>
		<li><a href="#">Chemical</a></li>
		<li><a href="#">Spray Powder</a></li>
		<li><a href="#">Composite</a></li>
		<li><a href="#">Ink</a></li>
		<li><a href="#">Under Packing Blanket</a></li>
		<li><a href="#">Inking Unit Foil</a></li>
		<li><a href="#">Compound</a></li>
		<li><a href="#">Accessories</a></li>
		<li><a href="#">Consumable</a></li>
		<li><a href="#">Core</a></li>
		<li><a href="#">Filter Vacuum</a></li>
		<li><a href="#">Bar</a></li>
		<li><a href="#">Under Packing Folex</a></li>
		<li><a href="#">Other Item</a></li>
	</ul>
</li>
<li class="p1 down">Purchasing
	<ul class="subsidenav">
		<li><a href="#">Purchase Order</a></li>
		<li><a href="#">Open Purchase Order</a></li>
		<li><a href="#">Purchase Return</a></li>
	</ul>
</li>
<li class="p1 down">Sales
	<ul class="subsidenav">
		<li><a href="#">Sales Order</a></li>
		<li><a href="#">Sales Return</a></li>
	</ul>
</li>
-->

</ul>

</div>
