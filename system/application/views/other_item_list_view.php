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
					target:        '#other_itemlist',
					success: 		other_itemshowResponse,
		}; 
		
		$('#other_itemlistform').submit(function() { 
			$('#other_itemlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function other_itemconfirmdelete(delid, obj)
	{
		$('#other_item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', other_itemconfirmdelete2(delid, obj));
	}
	
	function other_itemconfirmdelete2(delid, obj)
	{
		$( "#other_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					other_itemcalldeletefn('other_itemdelete', delid, 'other_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#other_item-dialog-confirm').html('');
	}
	
	function other_itemsortupdown(field, direction)
	{
		$("#other_itemcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#other_itemlist',
					success: 		other_itemshowResponse,
		}; 
		$('#other_itemlistform').ajaxSubmit(options);
		return false;
	}
	
	function other_itemshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#other_itemlist',
					success: 		other_itemshowResponse,
		}; 
		
		$('#other_itemlistform').submit(function() { 
			$('#other_itemlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function other_itemcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function other_itemadd()
	{
		$('#other_itemformholder').load('<?=site_url()."/other_itemadd/";?>', function()
		{$('#other_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#other_itemformholder' + '\').html(\'\');' + '$(\'' + '#other_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#other_itemlist' + '\').load(\'<?=site_url();?>/other_itemlist\');' + ';"></input>');
		});	
	}
	
	function other_itemedit(id)
	{
		$('#other_itemformholder').load('<?=site_url()."/other_itemedit/index/";?>' + id, function()
		{$('#other_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#other_itemformholder' + '\').html(\'\');' + '$(\'' + '#other_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#other_itemlist' + '\').load(\'<?=site_url();?>/other_itemlist\');' + ';"></input>');
		});	
	}
	
	function other_itemview(id)
	{
		$('#other_itemformholder').load('<?=site_url()."/other_itemview/index/";?>' + id, function()
		{$('#other_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#other_itemformholder' + '\').html(\'\');' + '$(\'' + '#other_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#other_itemlist' + '\').load(\'<?=site_url();?>/other_itemlist\');' + ';"></input>');
		});	
	}
	
	function other_itemgotopage()
	{
		var page = document.other_itemlistform.pageno.options[document.other_itemlistform.pageno.selectedIndex].value;
		
		$("#other_itemcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#other_itemlist',
					success: 		other_itemshowResponse,
		}; 
		$('#other_itemlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="other_item-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="other_itemclosebutton"></div>
		<div id="other_itemformholder"></div>
		<div id="other_itemlist">
		<form method="post" action="<?=site_url();?>/other_itemlist/index/" id="other_itemlistform" name="other_itemlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="other_itemcurrsort">
			</div>
			<div id="other_itemsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="other_itemadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/other_itemadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/other_itemadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="other_itemsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="other_itemsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="other_itemsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="other_itemsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['item__name'];?></td><td><?=$row['item__type'];?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=$row['item__purchaseable'];?></td><td><?=$row['item__sellable'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="other_itemview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/other_itemview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="other_itemedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/other_itemedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="other_itemconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="other_itemgotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>