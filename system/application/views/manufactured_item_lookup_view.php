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
					target:        '#manufactured_itemlist',
					success: 		manufactured_itemshowResponse,
		}; 
		
		$('#manufactured_itemlistform').submit(function() { 
			$('#manufactured_itemlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufactured_itemconfirmdelete(delid, obj)
	{
		$('#manufactured_item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufactured_itemconfirmdelete2(delid, obj));
	}
	
	function manufactured_itemconfirmdelete2(delid, obj)
	{
		$( "#manufactured_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufactured_itemcalldeletefn('manufactured_itemdelete', delid, 'manufactured_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufactured_item-dialog-confirm').html('');
	}
	
	function manufactured_itemsortupdown(field, direction)
	{
		$("#manufactured_itemcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufactured_itemlist',
					success: 		manufactured_itemshowResponse,
		}; 
		$('#manufactured_itemlistform').ajaxSubmit(options);
		return false;
	}
	
	function manufactured_itemshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufactured_itemlist',
					success: 		manufactured_itemshowResponse,
		}; 
		
		$('#manufactured_itemlistform').submit(function() { 
			$('#manufactured_itemlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufactured_itemcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufactured_itemadd()
	{
		$('#manufactured_itemformholder').load('<?=site_url()."/manufactured_itemadd/";?>', function()
		{$('#manufactured_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufactured_itemformholder' + '\').html(\'\');' + '$(\'' + '#manufactured_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#manufactured_itemlist' + '\').load(\'<?=site_url();?>/manufactured_itemlist\');' + ';"></input>');
		});	
	}
	
	function manufactured_itemedit(id)
	{
		$('#manufactured_itemformholder').load('<?=site_url()."/manufactured_itemedit/index/";?>' + id, function()
		{$('#manufactured_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufactured_itemformholder' + '\').html(\'\');' + '$(\'' + '#manufactured_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#manufactured_itemlist' + '\').load(\'<?=site_url();?>/manufactured_itemlist\');' + ';"></input>');
		});	
	}
	
	function manufactured_itemview(id)
	{
		$('#manufactured_itemformholder').load('<?=site_url()."/manufactured_itemview/index/";?>' + id, function()
		{$('#manufactured_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufactured_itemformholder' + '\').html(\'\');' + '$(\'' + '#manufactured_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#manufactured_itemlist' + '\').load(\'<?=site_url();?>/manufactured_itemlist\');' + ';"></input>');
		});	
	}
	
	function manufactured_itemgotopage()
	{
		var page = document.manufactured_itemlistform.pageno.options[document.manufactured_itemlistform.pageno.selectedIndex].value;
		
		$("#manufactured_itemcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufactured_itemlist',
					success: 		manufactured_itemshowResponse,
		}; 
		$('#manufactured_itemlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufactured_item-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufactured_itemclosebutton"></div>
		<div id="manufactured_itemformholder"></div>
		<div id="manufactured_itemlist">
		<!--<form method="post" action="<?=site_url();?>/manufactured_itemlist/index/" id="manufactured_itemlistform" name="manufactured_itemlistform">-->
		<form method="post" action="<?=current_url();?>" id="manufactured_itemlistform" name="manufactured_itemlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufactured_itemcurrsort">
			</div>
			<div id="manufactured_itemsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="manufactured_itemadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufactured_itemadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufactured_itemadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="manufactured_itemsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufactured_itemsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="manufactured_itemsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufactured_itemsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufactured_itemview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufactured_itemview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufactured_itemedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufactured_itemedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufactured_itemconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufactured_itemgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>