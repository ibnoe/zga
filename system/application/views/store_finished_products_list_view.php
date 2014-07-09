<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		/*
		$('a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		*/
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#store_finished_productslist',
					success: 		store_finished_productsshowResponse,
		}; 
		
		$('#store_finished_productslistform').submit(function() { 
			$('#store_finished_productslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function store_finished_productsconfirmdelete(delid, obj)
	{
		$('#store_finished_products-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', store_finished_productsconfirmdelete2(delid, obj));
	}
	
	function store_finished_productsconfirmdelete2(delid, obj)
	{
		$( "#store_finished_products-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					store_finished_productscalldeletefn('store_finished_productsdelete', delid, 'store_finished_productslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#store_finished_products-dialog-confirm').html('');
	}
	
	function store_finished_productssortupdown(field, direction)
	{
		$("#store_finished_productscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#store_finished_productslist',
					success: 		store_finished_productsshowResponse,
		}; 
		$('#store_finished_productslistform').ajaxSubmit(options);
		return false;
	}
	
	function store_finished_productsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#store_finished_productslist',
					success: 		store_finished_productsshowResponse,
		}; 
		
		$('#store_finished_productslistform').submit(function() { 
			$('#store_finished_productslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function store_finished_productscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function store_finished_productsadd()
	{
		$('#store_finished_productsformholder').load('<?=site_url()."/store_finished_productsadd/";?>', function()
		{$('#store_finished_productsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#store_finished_productsformholder' + '\').html(\'\');' + '$(\'' + '#store_finished_productsclosebutton' + '\').html(\'\');' + '$(\'' + '#store_finished_productslist' + '\').load(\'<?=site_url();?>/store_finished_productslist\');' + ';"></input>');
		});	
	}
	
	function store_finished_productsedit(id)
	{
		$('#store_finished_productsformholder').load('<?=site_url()."/store_finished_productsedit/index/";?>' + id, function()
		{$('#store_finished_productsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#store_finished_productsformholder' + '\').html(\'\');' + '$(\'' + '#store_finished_productsclosebutton' + '\').html(\'\');' + '$(\'' + '#store_finished_productslist' + '\').load(\'<?=site_url();?>/store_finished_productslist\');' + ';"></input>');
		});	
	}
	
	function store_finished_productsview(id)
	{
		$('#store_finished_productsformholder').load('<?=site_url()."/store_finished_productsview/index/";?>' + id, function()
		{$('#store_finished_productsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#store_finished_productsformholder' + '\').html(\'\');' + '$(\'' + '#store_finished_productsclosebutton' + '\').html(\'\');' + '$(\'' + '#store_finished_productslist' + '\').load(\'<?=site_url();?>/store_finished_productslist\');' + ';"></input>');
		});	
	}
	
	function store_finished_productsgotopage()
	{
		var page = document.store_finished_productslistform.pageno.options[document.store_finished_productslistform.pageno.selectedIndex].value;
		
		$("#store_finished_productscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#store_finished_productslist',
					success: 		store_finished_productsshowResponse,
		}; 
		$('#store_finished_productslistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="store_finished_products-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="store_finished_productsclosebutton"></div>
		<div id="store_finished_productsformholder"></div>
		<div id="store_finished_productslist">
		<form method="post" action="<?=site_url();?>/store_finished_productslist/index/" id="store_finished_productslistform" name="store_finished_productslistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="store_finished_productscurrsort">
			</div>
			<div id="store_finished_productssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="store_finished_productsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/store_finished_productsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/store_finished_productsadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="store_finished_productssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="store_finished_productssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="store_finished_productssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="store_finished_productssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
							<?php endif; ?>
						<?php } ?>
					</th>
				<?php endforeach; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				</tr>

				<?php foreach ($rows as $row): ?>
					<tr>
					<td><?=$row['morder__orderid'];?></td><td><?=$row['morder__date'];?></td><td><?=$row['morder__notes'];?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['morder__orderid'];?></td><td><?=$row['morder__date'];?></td><td><?=$row['morder__notes'];?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['morder__'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="store_finished_productsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/store_finished_productsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="store_finished_productsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/store_finished_productsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="store_finished_productsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="store_finished_productsgotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>