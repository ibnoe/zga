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
					target:        '#roller_inspection_sheetlist',
					success: 		roller_inspection_sheetshowResponse,
		}; 
		
		$('#roller_inspection_sheetlistform').submit(function() { 
			$('#roller_inspection_sheetlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function roller_inspection_sheetconfirmdelete(delid, obj)
	{
		$('#roller_inspection_sheet-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', roller_inspection_sheetconfirmdelete2(delid, obj));
	}
	
	function roller_inspection_sheetconfirmdelete2(delid, obj)
	{
		$( "#roller_inspection_sheet-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					roller_inspection_sheetcalldeletefn('roller_inspection_sheetdelete', delid, 'roller_inspection_sheetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roller_inspection_sheet-dialog-confirm').html('');
	}
	
	function roller_inspection_sheetsortupdown(field, direction)
	{
		$("#roller_inspection_sheetcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#roller_inspection_sheetlist',
					success: 		roller_inspection_sheetshowResponse,
		}; 
		$('#roller_inspection_sheetlistform').ajaxSubmit(options);
		return false;
	}
	
	function roller_inspection_sheetshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#roller_inspection_sheetlist',
					success: 		roller_inspection_sheetshowResponse,
		}; 
		
		$('#roller_inspection_sheetlistform').submit(function() { 
			$('#roller_inspection_sheetlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function roller_inspection_sheetcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function roller_inspection_sheetadd()
	{
		$('#roller_inspection_sheetformholder').load('<?=site_url()."/roller_inspection_sheetadd/";?>', function()
		{$('#roller_inspection_sheetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roller_inspection_sheetformholder' + '\').html(\'\');' + '$(\'' + '#roller_inspection_sheetclosebutton' + '\').html(\'\');' + '$(\'' + '#roller_inspection_sheetlist' + '\').load(\'<?=site_url();?>/roller_inspection_sheetlist\');' + ';"></input>');
		});	
	}
	
	function roller_inspection_sheetedit(id)
	{
		$('#roller_inspection_sheetformholder').load('<?=site_url()."/roller_inspection_sheetedit/index/";?>' + id, function()
		{$('#roller_inspection_sheetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roller_inspection_sheetformholder' + '\').html(\'\');' + '$(\'' + '#roller_inspection_sheetclosebutton' + '\').html(\'\');' + '$(\'' + '#roller_inspection_sheetlist' + '\').load(\'<?=site_url();?>/roller_inspection_sheetlist\');' + ';"></input>');
		});	
	}
	
	function roller_inspection_sheetview(id)
	{
		$('#roller_inspection_sheetformholder').load('<?=site_url()."/roller_inspection_sheetview/index/";?>' + id, function()
		{$('#roller_inspection_sheetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roller_inspection_sheetformholder' + '\').html(\'\');' + '$(\'' + '#roller_inspection_sheetclosebutton' + '\').html(\'\');' + '$(\'' + '#roller_inspection_sheetlist' + '\').load(\'<?=site_url();?>/roller_inspection_sheetlist\');' + ';"></input>');
		});	
	}
	
	function roller_inspection_sheetgotopage()
	{
		var page = document.roller_inspection_sheetlistform.pageno.options[document.roller_inspection_sheetlistform.pageno.selectedIndex].value;
		
		$("#roller_inspection_sheetcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#roller_inspection_sheetlist',
					success: 		roller_inspection_sheetshowResponse,
		}; 
		$('#roller_inspection_sheetlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="roller_inspection_sheet-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="roller_inspection_sheetclosebutton"></div>
		<div id="roller_inspection_sheetformholder"></div>
		<div id="roller_inspection_sheetlist">
		<!--<form method="post" action="<?=site_url();?>/roller_inspection_sheetlist/index/" id="roller_inspection_sheetlistform" name="roller_inspection_sheetlistform">-->
		<form method="post" action="<?=current_url();?>" id="roller_inspection_sheetlistform" name="roller_inspection_sheetlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="roller_inspection_sheetcurrsort">
			</div>
			<div id="roller_inspection_sheetsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="roller_inspection_sheetadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/roller_inspection_sheetadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/roller_inspection_sheetadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="roller_inspection_sheetsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="roller_inspection_sheetsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="roller_inspection_sheetsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="roller_inspection_sheetsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/roller_inspection_sheetview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('roller_inspection_sheetview/index/'.$row['id'], $row['rollerinspectionsheet__idstring']);?></td><td><?=$row['rollerinspectionsheet__date'];?></td><td><?php if (isset($row['rollerinspectionsheet__customer_id']) && $row['customer__idstring'] != "") echo anchor('customerview/index/'.$row['rollerinspectionsheet__customer_id'], $row['customer__idstring']);?></td><td><?php if (isset($row['rollerinspectionsheet__mesin_id']) && $row['mesin__typename'] != "") echo anchor('mesinview/index/'.$row['rollerinspectionsheet__mesin_id'], $row['mesin__typename']);?></td><td><?php if (isset($row['rollerinspectionsheet__roll_id']) && $row['item__name'] != "") echo anchor('rollview/index/'.$row['rollerinspectionsheet__roll_id'], $row['item__name']);?></td><td><?=$row['rollerinspectionsheet__orderno'];?></td><td><?php if (isset($row['rollerinspectionsheet__compound_id']) && $row['item1__name'] != "") echo anchor('compoundview/index/'.$row['rollerinspectionsheet__compound_id'], $row['item1__name']);?></td><td><?=$row['rollerinspectionsheet__lastupdate'];?></td><td><?=$row['rollerinspectionsheet__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="roller_inspection_sheetview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/roller_inspection_sheetview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="roller_inspection_sheetedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/roller_inspection_sheetedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="roller_inspection_sheetconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="roller_inspection_sheetgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>