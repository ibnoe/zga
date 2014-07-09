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
					target:        '#insert_itemlist',
					success: 		insert_itemshowResponse,
		}; 
		
		$('#insert_itemlistform').submit(function() { 
			$('#insert_itemlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function insert_itemconfirmdelete(delid, obj)
	{
		$('#insert_item-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', insert_itemconfirmdelete2(delid, obj));
	}
	
	function insert_itemconfirmdelete2(delid, obj)
	{
		$( "#insert_item-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					insert_itemcalldeletefn('insert_itemdelete', delid, 'insert_itemlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#insert_item-dialog-confirm').html('');
	}
	
	function insert_itemsortupdown(field, direction)
	{
		$("#insert_itemcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#insert_itemlist',
					success: 		insert_itemshowResponse,
		}; 
		$('#insert_itemlistform').ajaxSubmit(options);
		return false;
	}
	
	function insert_itemshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#insert_itemlist',
					success: 		insert_itemshowResponse,
		}; 
		
		$('#insert_itemlistform').submit(function() { 
			$('#insert_itemlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function insert_itemcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function insert_itemadd()
	{
		$('#insert_itemformholder').load('<?=site_url()."/insert_itemadd/";?>', function()
		{$('#insert_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#insert_itemformholder' + '\').html(\'\');' + '$(\'' + '#insert_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#insert_itemlist' + '\').load(\'<?=site_url();?>/insert_itemlist\');' + ';"></input>');
		});	
	}
	
	function insert_itemedit(id)
	{
		$('#insert_itemformholder').load('<?=site_url()."/insert_itemedit/index/";?>' + id, function()
		{$('#insert_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#insert_itemformholder' + '\').html(\'\');' + '$(\'' + '#insert_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#insert_itemlist' + '\').load(\'<?=site_url();?>/insert_itemlist\');' + ';"></input>');
		});	
	}
	
	function insert_itemview(id)
	{
		$('#insert_itemformholder').load('<?=site_url()."/insert_itemview/index/";?>' + id, function()
		{$('#insert_itemclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#insert_itemformholder' + '\').html(\'\');' + '$(\'' + '#insert_itemclosebutton' + '\').html(\'\');' + '$(\'' + '#insert_itemlist' + '\').load(\'<?=site_url();?>/insert_itemlist\');' + ';"></input>');
		});	
	}
	
	function insert_itemgotopage()
	{
		var page = document.insert_itemlistform.pageno.options[document.insert_itemlistform.pageno.selectedIndex].value;
		
		$("#insert_itemcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#insert_itemlist',
					success: 		insert_itemshowResponse,
		}; 
		$('#insert_itemlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="insert_item-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="insert_itemclosebutton"></div>
		<div id="insert_itemformholder"></div>
		<div id="insert_itemlist">
		<!--<form method="post" action="<?=site_url();?>/insert_itemlist/index/" id="insert_itemlistform" name="insert_itemlistform">-->
		<form method="post" action="<?=current_url();?>" id="insert_itemlistform" name="insert_itemlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="insert_itemcurrsort">
			</div>
			<div id="insert_itemsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="insert_itemadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/insert_itemadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/insert_itemadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="insert_itemsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="insert_itemsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="insert_itemsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="insert_itemsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/insert_itemview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('insert_itemview/index/'.$row['id'], $row['insertitem__idstring']);?></td><td><?=$row['insertitem__date'];?></td><td><?=$row['insertitem__notes'];?></td><td><?=$row['insertitem__lastupdate'];?></td><td><?=$row['insertitem__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="insert_itemview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/insert_itemview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="insert_itemedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/insert_itemedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="insert_itemconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="insert_itemgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>