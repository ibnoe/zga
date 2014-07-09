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
					target:        '#purchaseable_itemlist',
					success: 		purchaseable_itemshowResponse,
		}; 
		
		$('#purchaseable_itemlistform').submit(function() { 
			$('#purchaseable_itemlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchaseable_itemconfirmdelete(delid, obj)
	{
		$('#purchaseable_item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchaseable_itemconfirmdelete2(delid, obj));
	}
	
	function purchaseable_itemconfirmdelete2(delid, obj)
	{
		$( "#purchaseable_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchaseable_itemcalldeletefn('purchaseable_itemdelete', delid, 'purchaseable_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchaseable_item-dialog-confirm').html('');
	}
	
	function purchaseable_itemsortupdown(field, direction)
	{
		$("#purchaseable_itemcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchaseable_itemlist',
					success: 		purchaseable_itemshowResponse,
		}; 
		$('#purchaseable_itemlistform').ajaxSubmit(options);
		return false;
	}
	
	function purchaseable_itemshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchaseable_itemlist',
					success: 		purchaseable_itemshowResponse,
		}; 
		
		$('#purchaseable_itemlistform').submit(function() { 
			$('#purchaseable_itemlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchaseable_itemcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchaseable_itemadd()
	{
		$('#purchaseable_itemformholder').load('<?=site_url()."/purchaseable_itemadd/";?>', function()
		{$('#purchaseable_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchaseable_itemformholder' + '\').html(\'\');' + '$(\'' + '#purchaseable_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#purchaseable_itemlist' + '\').load(\'<?=site_url();?>/purchaseable_itemlist\');' + ';"></input>');
		});	
	}
	
	function purchaseable_itemedit(id)
	{
		$('#purchaseable_itemformholder').load('<?=site_url()."/purchaseable_itemedit/index/";?>' + id, function()
		{$('#purchaseable_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchaseable_itemformholder' + '\').html(\'\');' + '$(\'' + '#purchaseable_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#purchaseable_itemlist' + '\').load(\'<?=site_url();?>/purchaseable_itemlist\');' + ';"></input>');
		});	
	}
	
	function purchaseable_itemview(id)
	{
		$('#purchaseable_itemformholder').load('<?=site_url()."/purchaseable_itemview/index/";?>' + id, function()
		{$('#purchaseable_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchaseable_itemformholder' + '\').html(\'\');' + '$(\'' + '#purchaseable_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#purchaseable_itemlist' + '\').load(\'<?=site_url();?>/purchaseable_itemlist\');' + ';"></input>');
		});	
	}
	
	function purchaseable_itemgotopage()
	{
		var page = document.purchaseable_itemlistform.pageno.options[document.purchaseable_itemlistform.pageno.selectedIndex].value;
		
		$("#purchaseable_itemcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchaseable_itemlist',
					success: 		purchaseable_itemshowResponse,
		}; 
		$('#purchaseable_itemlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchaseable_item-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchaseable_itemclosebutton"></div>
		<div id="purchaseable_itemformholder"></div>
		<div id="purchaseable_itemlist">
		<!--<form method="post" action="<?=site_url();?>/purchaseable_itemlist/index/" id="purchaseable_itemlistform" name="purchaseable_itemlistform">-->
		<form method="post" action="<?=current_url();?>" id="purchaseable_itemlistform" name="purchaseable_itemlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchaseable_itemcurrsort">
			</div>
			<div id="purchaseable_itemsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="purchaseable_itemadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchaseable_itemadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchaseable_itemadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				<th></th>
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
									echo '<a href="#" class="updown" onclick="purchaseable_itemsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchaseable_itemsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchaseable_itemsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchaseable_itemsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/purchaseable_itemview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('purchaseable_itemview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchaseable_itemview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchaseable_itemview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchaseable_itemedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchaseable_itemedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchaseable_itemconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchaseable_itemgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>