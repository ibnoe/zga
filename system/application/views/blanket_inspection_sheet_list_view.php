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
					target:        '#blanket_inspection_sheetlist',
					success: 		blanket_inspection_sheetshowResponse,
		}; 
		
		$('#blanket_inspection_sheetlistform').submit(function() { 
			$('#blanket_inspection_sheetlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function blanket_inspection_sheetconfirmdelete(delid, obj)
	{
		$('#blanket_inspection_sheet-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', blanket_inspection_sheetconfirmdelete2(delid, obj));
	}
	
	function blanket_inspection_sheetconfirmdelete2(delid, obj)
	{
		$( "#blanket_inspection_sheet-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					blanket_inspection_sheetcalldeletefn('blanket_inspection_sheetdelete', delid, 'blanket_inspection_sheetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_inspection_sheet-dialog-confirm').html('');
	}
	
	function blanket_inspection_sheetsortupdown(field, direction)
	{
		$("#blanket_inspection_sheetcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#blanket_inspection_sheetlist',
					success: 		blanket_inspection_sheetshowResponse,
		}; 
		$('#blanket_inspection_sheetlistform').ajaxSubmit(options);
		return false;
	}
	
	function blanket_inspection_sheetshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#blanket_inspection_sheetlist',
					success: 		blanket_inspection_sheetshowResponse,
		}; 
		
		$('#blanket_inspection_sheetlistform').submit(function() { 
			$('#blanket_inspection_sheetlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function blanket_inspection_sheetcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function blanket_inspection_sheetadd()
	{
		$('#blanket_inspection_sheetformholder').load('<?=site_url()."/blanket_inspection_sheetadd/";?>', function()
		{$('#blanket_inspection_sheetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_inspection_sheetformholder' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheetclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheetlist' + '\').load(\'<?=site_url();?>/blanket_inspection_sheetlist\');' + ';"></input>');
		});	
	}
	
	function blanket_inspection_sheetedit(id)
	{
		$('#blanket_inspection_sheetformholder').load('<?=site_url()."/blanket_inspection_sheetedit/index/";?>' + id, function()
		{$('#blanket_inspection_sheetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_inspection_sheetformholder' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheetclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheetlist' + '\').load(\'<?=site_url();?>/blanket_inspection_sheetlist\');' + ';"></input>');
		});	
	}
	
	function blanket_inspection_sheetview(id)
	{
		$('#blanket_inspection_sheetformholder').load('<?=site_url()."/blanket_inspection_sheetview/index/";?>' + id, function()
		{$('#blanket_inspection_sheetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_inspection_sheetformholder' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheetclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_inspection_sheetlist' + '\').load(\'<?=site_url();?>/blanket_inspection_sheetlist\');' + ';"></input>');
		});	
	}
	
	function blanket_inspection_sheetgotopage()
	{
		var page = document.blanket_inspection_sheetlistform.pageno.options[document.blanket_inspection_sheetlistform.pageno.selectedIndex].value;
		
		$("#blanket_inspection_sheetcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#blanket_inspection_sheetlist',
					success: 		blanket_inspection_sheetshowResponse,
		}; 
		$('#blanket_inspection_sheetlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="blanket_inspection_sheet-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="blanket_inspection_sheetclosebutton"></div>
		<div id="blanket_inspection_sheetformholder"></div>
		<div id="blanket_inspection_sheetlist">
		<!--<form method="post" action="<?=site_url();?>/blanket_inspection_sheetlist/index/" id="blanket_inspection_sheetlistform" name="blanket_inspection_sheetlistform">-->
		<form method="post" action="<?=current_url();?>" id="blanket_inspection_sheetlistform" name="blanket_inspection_sheetlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="blanket_inspection_sheetcurrsort">
			</div>
			<div id="blanket_inspection_sheetsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="blanket_inspection_sheetadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/blanket_inspection_sheetadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/blanket_inspection_sheetadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="blanket_inspection_sheetsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="blanket_inspection_sheetsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="blanket_inspection_sheetsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="blanket_inspection_sheetsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/blanket_inspection_sheetview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('blanket_inspection_sheetview/index/'.$row['id'], $row['blanketinspectionsheet__date']);?></td><td><?php if (isset($row['blanketinspectionsheet__customer_id']) && $row['customer__idstring'] != "") echo anchor('customerview/index/'.$row['blanketinspectionsheet__customer_id'], $row['customer__idstring']);?></td><td><?=$row['blanketinspectionsheet__productname'];?></td><td><?=$row['blanketinspectionsheet__presstype'];?></td><td><?=$row['blanketinspectionsheet__barsize'];?></td><td><?=$row['blanketinspectionsheet__lastupdate'];?></td><td><?=$row['blanketinspectionsheet__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="blanket_inspection_sheetview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/blanket_inspection_sheetview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="blanket_inspection_sheetedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/blanket_inspection_sheetedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="blanket_inspection_sheetconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="blanket_inspection_sheetgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>