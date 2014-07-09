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
					target:        '#consumablelist',
					success: 		consumableshowResponse,
		}; 
		
		$('#consumablelistform').submit(function() { 
			$('#consumablelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function consumableconfirmdelete(delid, obj)
	{
		$('#consumable-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', consumableconfirmdelete2(delid, obj));
	}
	
	function consumableconfirmdelete2(delid, obj)
	{
		$( "#consumable-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					consumablecalldeletefn('consumabledelete', delid, 'consumablelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#consumable-dialog-confirm').html('');
	}
	
	function consumablesortupdown(field, direction)
	{
		$("#consumablecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#consumablelist',
					success: 		consumableshowResponse,
		}; 
		$('#consumablelistform').ajaxSubmit(options);
		return false;
	}
	
	function consumableshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#consumablelist',
					success: 		consumableshowResponse,
		}; 
		
		$('#consumablelistform').submit(function() { 
			$('#consumablelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function consumablecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function consumableadd()
	{
		$('#consumableformholder').load('<?=site_url()."/consumableadd/";?>', function()
		{$('#consumableclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#consumableformholder' + '\').html(\'\');' + '$(\'' + '#consumableclosebutton' + '\').html(\'\');' + '$(\'' + '#consumablelist' + '\').load(\'<?=site_url();?>/consumablelist\');' + ';"></input>');
		});	
	}
	
	function consumableedit(id)
	{
		$('#consumableformholder').load('<?=site_url()."/consumableedit/index/";?>' + id, function()
		{$('#consumableclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#consumableformholder' + '\').html(\'\');' + '$(\'' + '#consumableclosebutton' + '\').html(\'\');' + '$(\'' + '#consumablelist' + '\').load(\'<?=site_url();?>/consumablelist\');' + ';"></input>');
		});	
	}
	
	function consumableview(id)
	{
		$('#consumableformholder').load('<?=site_url()."/consumableview/index/";?>' + id, function()
		{$('#consumableclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#consumableformholder' + '\').html(\'\');' + '$(\'' + '#consumableclosebutton' + '\').html(\'\');' + '$(\'' + '#consumablelist' + '\').load(\'<?=site_url();?>/consumablelist\');' + ';"></input>');
		});	
	}
	
	function consumablegotopage()
	{
		var page = document.consumablelistform.pageno.options[document.consumablelistform.pageno.selectedIndex].value;
		
		$("#consumablecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#consumablelist',
					success: 		consumableshowResponse,
		}; 
		$('#consumablelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="consumable-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="consumableclosebutton"></div>
		<div id="consumableformholder"></div>
		<div id="consumablelist">
		<!--<form method="post" action="<?=site_url();?>/consumablelist/index/" id="consumablelistform" name="consumablelistform">-->
		<form method="post" action="<?=current_url();?>" id="consumablelistform" name="consumablelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="consumablecurrsort">
			</div>
			<div id="consumablesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="consumableadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/consumableadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/consumableadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="consumablesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="consumablesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="consumablesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="consumablesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/consumableview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('consumableview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__subcategory'];?></td><td><?=$row['item__brand'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="consumableview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/consumableview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="consumableedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/consumableedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="consumableconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="consumablegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>