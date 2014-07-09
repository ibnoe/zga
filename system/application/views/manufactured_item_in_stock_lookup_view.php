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
					target:        '#manufactured_item_in_stocklist',
					success: 		manufactured_item_in_stockshowResponse,
		}; 
		
		$('#manufactured_item_in_stocklistform').submit(function() { 
			$('#manufactured_item_in_stocklistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufactured_item_in_stockconfirmdelete(delid, obj)
	{
		$('#manufactured_item_in_stock-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufactured_item_in_stockconfirmdelete2(delid, obj));
	}
	
	function manufactured_item_in_stockconfirmdelete2(delid, obj)
	{
		$( "#manufactured_item_in_stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufactured_item_in_stockcalldeletefn('manufactured_item_in_stockdelete', delid, 'manufactured_item_in_stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufactured_item_in_stock-dialog-confirm').html('');
	}
	
	function manufactured_item_in_stocksortupdown(field, direction)
	{
		$("#manufactured_item_in_stockcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufactured_item_in_stocklist',
					success: 		manufactured_item_in_stockshowResponse,
		}; 
		$('#manufactured_item_in_stocklistform').ajaxSubmit(options);
		return false;
	}
	
	function manufactured_item_in_stockshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufactured_item_in_stocklist',
					success: 		manufactured_item_in_stockshowResponse,
		}; 
		
		$('#manufactured_item_in_stocklistform').submit(function() { 
			$('#manufactured_item_in_stocklistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufactured_item_in_stockcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufactured_item_in_stockadd()
	{
		$('#manufactured_item_in_stockformholder').load('<?=site_url()."/manufactured_item_in_stockadd/";?>', function()
		{$('#manufactured_item_in_stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufactured_item_in_stockformholder' + '\').html(\'\');' + '$(\'' + '#manufactured_item_in_stockclosebutton' + '\').html(\'\');' + '$(\'' + '#manufactured_item_in_stocklist' + '\').load(\'<?=site_url();?>/manufactured_item_in_stocklist\');' + ';"></input>');
		});	
	}
	
	function manufactured_item_in_stockedit(id)
	{
		$('#manufactured_item_in_stockformholder').load('<?=site_url()."/manufactured_item_in_stockedit/index/";?>' + id, function()
		{$('#manufactured_item_in_stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufactured_item_in_stockformholder' + '\').html(\'\');' + '$(\'' + '#manufactured_item_in_stockclosebutton' + '\').html(\'\');' + '$(\'' + '#manufactured_item_in_stocklist' + '\').load(\'<?=site_url();?>/manufactured_item_in_stocklist\');' + ';"></input>');
		});	
	}
	
	function manufactured_item_in_stockview(id)
	{
		$('#manufactured_item_in_stockformholder').load('<?=site_url()."/manufactured_item_in_stockview/index/";?>' + id, function()
		{$('#manufactured_item_in_stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufactured_item_in_stockformholder' + '\').html(\'\');' + '$(\'' + '#manufactured_item_in_stockclosebutton' + '\').html(\'\');' + '$(\'' + '#manufactured_item_in_stocklist' + '\').load(\'<?=site_url();?>/manufactured_item_in_stocklist\');' + ';"></input>');
		});	
	}
	
	function manufactured_item_in_stockgotopage()
	{
		var page = document.manufactured_item_in_stocklistform.pageno.options[document.manufactured_item_in_stocklistform.pageno.selectedIndex].value;
		
		$("#manufactured_item_in_stockcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufactured_item_in_stocklist',
					success: 		manufactured_item_in_stockshowResponse,
		}; 
		$('#manufactured_item_in_stocklistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufactured_item_in_stock-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufactured_item_in_stockclosebutton"></div>
		<div id="manufactured_item_in_stockformholder"></div>
		<div id="manufactured_item_in_stocklist">
		<!--<form method="post" action="<?=site_url();?>/manufactured_item_in_stocklist/index/" id="manufactured_item_in_stocklistform" name="manufactured_item_in_stocklistform">-->
		<form method="post" action="<?=current_url();?>" id="manufactured_item_in_stocklistform" name="manufactured_item_in_stocklistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufactured_item_in_stockcurrsort">
			</div>
			<div id="manufactured_item_in_stocksort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="manufactured_item_in_stockadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufactured_item_in_stockadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufactured_item_in_stockadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="manufactured_item_in_stocksortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufactured_item_in_stocksortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="manufactured_item_in_stocksortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufactured_item_in_stocksortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufactured_item_in_stockview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufactured_item_in_stockview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufactured_item_in_stockedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufactured_item_in_stockedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufactured_item_in_stockconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufactured_item_in_stockgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>