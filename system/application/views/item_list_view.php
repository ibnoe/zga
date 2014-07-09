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
					target:        '#itemlist',
					success: 		itemshowResponse,
		}; 
		
		$('#itemlistform').submit(function() { 
			$('#itemlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function itemconfirmdelete(delid, obj)
	{
		$('#item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', itemconfirmdelete2(delid, obj));
	}
	
	function itemconfirmdelete2(delid, obj)
	{
		$( "#item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					itemcalldeletefn('itemdelete', delid, 'itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#item-dialog-confirm').html('');
	}
	
	function itemsortupdown(field, direction)
	{
		$("#itemcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#itemlist',
					success: 		itemshowResponse,
		}; 
		$('#itemlistform').ajaxSubmit(options);
		return false;
	}
	
	function itemshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#itemlist',
					success: 		itemshowResponse,
		}; 
		
		$('#itemlistform').submit(function() { 
			$('#itemlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function itemcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function itemadd()
	{
		$('#itemformholder').load('<?=site_url()."/itemadd/";?>', function()
		{$('#itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#itemformholder' + '\').html(\'\');' + '$(\'' + '#itemclosebutton' + '\').html(\'\');' + '$(\'' + '#itemlist' + '\').load(\'<?=site_url();?>/itemlist\');' + ';"></input>');
		});	
	}
	
	function itemedit(id)
	{
		$('#itemformholder').load('<?=site_url()."/itemedit/index/";?>' + id, function()
		{$('#itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#itemformholder' + '\').html(\'\');' + '$(\'' + '#itemclosebutton' + '\').html(\'\');' + '$(\'' + '#itemlist' + '\').load(\'<?=site_url();?>/itemlist\');' + ';"></input>');
		});	
	}
	
	function itemview(id)
	{
		$('#itemformholder').load('<?=site_url()."/itemview/index/";?>' + id, function()
		{$('#itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#itemformholder' + '\').html(\'\');' + '$(\'' + '#itemclosebutton' + '\').html(\'\');' + '$(\'' + '#itemlist' + '\').load(\'<?=site_url();?>/itemlist\');' + ';"></input>');
		});	
	}
	
	function itemgotopage()
	{
		var page = document.itemlistform.pageno.options[document.itemlistform.pageno.selectedIndex].value;
		
		$("#itemcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#itemlist',
					success: 		itemshowResponse,
		}; 
		$('#itemlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="item-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="itemclosebutton"></div>
		<div id="itemformholder"></div>
		<div id="itemlist">
		<!--<form method="post" action="<?=site_url();?>/itemlist/index/" id="itemlistform" name="itemlistform">-->
		<form method="post" action="<?=current_url();?>" id="itemlistform" name="itemlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="itemcurrsort">
			</div>
			<div id="itemsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="itemadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/itemadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/itemadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="itemsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="itemsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="itemsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="itemsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/itemview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('itemview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="itemview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/itemview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="itemedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/itemedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="itemconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="itemgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>