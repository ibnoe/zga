<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		$('.hidden').hide();
		$('input:reset').button();
		$('input:button').button();
		$('input:submit').button();
		$('input:text').addClass("text ui-widget-content ui-corner-all");
		
		$('form table.main td a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		
		
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#sellable_itemlist',
					success: 		sellable_itemshowResponse,
		}; 
		
		$('#sellable_itemlistform').submit(function() { 
			$('#sellable_itemlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sellable_itemconfirmdelete(delid, obj)
	{
		$('#sellable_item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sellable_itemconfirmdelete2(delid, obj));
	}
	
	function sellable_itemconfirmdelete2(delid, obj)
	{
		$( "#sellable_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sellable_itemcalldeletefn('sellable_itemdelete', delid, 'sellable_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sellable_item-dialog-confirm').html('');
	}
	
	function sellable_itemsortupdown(field, direction)
	{
		$("#sellable_itemcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sellable_itemlist',
					success: 		sellable_itemshowResponse,
		}; 
		$('#sellable_itemlistform').ajaxSubmit(options);
		return false;
	}
	
	function sellable_itemshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sellable_itemlist',
					success: 		sellable_itemshowResponse,
		}; 
		
		$('#sellable_itemlistform').submit(function() { 
			$('#sellable_itemlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sellable_itemcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sellable_itemadd()
	{
		$('#sellable_itemformholder').load('<?=site_url()."/sellable_itemadd/";?>', function()
		{$('#sellable_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sellable_itemformholder' + '\').html(\'\');' + '$(\'' + '#sellable_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#sellable_itemlist' + '\').load(\'<?=site_url();?>/sellable_itemlist\');' + ';"></input>');
		});	
	}
	
	function sellable_itemedit(id)
	{
		$('#sellable_itemformholder').load('<?=site_url()."/sellable_itemedit/index/";?>' + id, function()
		{$('#sellable_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sellable_itemformholder' + '\').html(\'\');' + '$(\'' + '#sellable_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#sellable_itemlist' + '\').load(\'<?=site_url();?>/sellable_itemlist\');' + ';"></input>');
		});	
	}
	
	function sellable_itemview(id)
	{
		$('#sellable_itemformholder').load('<?=site_url()."/sellable_itemview/index/";?>' + id, function()
		{$('#sellable_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sellable_itemformholder' + '\').html(\'\');' + '$(\'' + '#sellable_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#sellable_itemlist' + '\').load(\'<?=site_url();?>/sellable_itemlist\');' + ';"></input>');
		});	
	}
	
	function sellable_itemgotopage()
	{
		var page = document.sellable_itemlistform.pageno.options[document.sellable_itemlistform.pageno.selectedIndex].value;
		
		$("#sellable_itemcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sellable_itemlist',
					success: 		sellable_itemshowResponse,
		}; 
		$('#sellable_itemlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sellable_item-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sellable_itemclosebutton"></div>
		<div id="sellable_itemformholder"></div>
		<div id="sellable_itemlist">
		<!--<form method="post" action="<?=site_url();?>/sellable_itemlist/index/" id="sellable_itemlistform" name="sellable_itemlistform">-->
		<form method="post" action="<?=current_url();?>" id="sellable_itemlistform" name="sellable_itemlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sellable_itemcurrsort">
			</div>
			<div id="sellable_itemsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="sellable_itemadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sellable_itemadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sellable_itemadd/index/";?>')">
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
							if (false)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="sellable_itemsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sellable_itemsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="sellable_itemsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sellable_itemsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['item__idstring'];?></td><td><?=$row['item__name'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['item__itemcategory_id'] > 0) echo $row['itemcategory__name'];?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sellable_itemview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sellable_itemview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sellable_itemedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sellable_itemedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sellable_itemconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sellable_itemgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>