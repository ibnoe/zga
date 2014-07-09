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
					target:        '#to_warehouselist',
					success: 		to_warehouseshowResponse,
		}; 
		
		$('#to_warehouselistform').submit(function() { 
			$('#to_warehouselistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function to_warehouseconfirmdelete(delid, obj)
	{
		$('#to_warehouse-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', to_warehouseconfirmdelete2(delid, obj));
	}
	
	function to_warehouseconfirmdelete2(delid, obj)
	{
		$( "#to_warehouse-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					to_warehousecalldeletefn('to_warehousedelete', delid, 'to_warehouselist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#to_warehouse-dialog-confirm').html('');
	}
	
	function to_warehousesortupdown(field, direction)
	{
		$("#to_warehousecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#to_warehouselist',
					success: 		to_warehouseshowResponse,
		}; 
		$('#to_warehouselistform').ajaxSubmit(options);
		return false;
	}
	
	function to_warehouseshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#to_warehouselist',
					success: 		to_warehouseshowResponse,
		}; 
		
		$('#to_warehouselistform').submit(function() { 
			$('#to_warehouselistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function to_warehousecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function to_warehouseadd()
	{
		$('#to_warehouseformholder').load('<?=site_url()."/to_warehouseadd/";?>', function()
		{$('#to_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#to_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#to_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#to_warehouselist' + '\').load(\'<?=site_url();?>/to_warehouselist\');' + ';"></input>');
		});	
	}
	
	function to_warehouseedit(id)
	{
		$('#to_warehouseformholder').load('<?=site_url()."/to_warehouseedit/index/";?>' + id, function()
		{$('#to_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#to_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#to_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#to_warehouselist' + '\').load(\'<?=site_url();?>/to_warehouselist\');' + ';"></input>');
		});	
	}
	
	function to_warehouseview(id)
	{
		$('#to_warehouseformholder').load('<?=site_url()."/to_warehouseview/index/";?>' + id, function()
		{$('#to_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#to_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#to_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#to_warehouselist' + '\').load(\'<?=site_url();?>/to_warehouselist\');' + ';"></input>');
		});	
	}
	
	function to_warehousegotopage()
	{
		var page = document.to_warehouselistform.pageno.options[document.to_warehouselistform.pageno.selectedIndex].value;
		
		$("#to_warehousecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#to_warehouselist',
					success: 		to_warehouseshowResponse,
		}; 
		$('#to_warehouselistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="to_warehouse-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="to_warehouseclosebutton"></div>
		<div id="to_warehouseformholder"></div>
		<div id="to_warehouselist">
		<!--<form method="post" action="<?=site_url();?>/to_warehouselist/index/" id="to_warehouselistform" name="to_warehouselistform">-->
		<form method="post" action="<?=current_url();?>" id="to_warehouselistform" name="to_warehouselistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="to_warehousecurrsort">
			</div>
			<div id="to_warehousesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="to_warehouseadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/to_warehouseadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/to_warehouseadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="to_warehousesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="to_warehousesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="to_warehousesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="to_warehousesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['warehouse__name'];?></td><td><?=$row['warehouse__address'];?></td><td><?=$row['warehouse__phone'];?></td><td><?=$row['warehouse__fax'];?></td><td><?=$row['warehouse__lastupdate'];?></td><td><?=$row['warehouse__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="to_warehouseview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/to_warehouseview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="to_warehouseedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/to_warehouseedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="to_warehouseconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="to_warehousegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>