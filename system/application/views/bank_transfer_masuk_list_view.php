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
					target:        '#bank_transfer_masuklist',
					success: 		bank_transfer_masukshowResponse,
		}; 
		
		$('#bank_transfer_masuklistform').submit(function() { 
			$('#bank_transfer_masuklistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function bank_transfer_masukconfirmdelete(delid, obj)
	{
		$('#bank_transfer_masuk-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', bank_transfer_masukconfirmdelete2(delid, obj));
	}
	
	function bank_transfer_masukconfirmdelete2(delid, obj)
	{
		$( "#bank_transfer_masuk-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					bank_transfer_masukcalldeletefn('bank_transfer_masukdelete', delid, 'bank_transfer_masuklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bank_transfer_masuk-dialog-confirm').html('');
	}
	
	function bank_transfer_masuksortupdown(field, direction)
	{
		$("#bank_transfer_masukcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#bank_transfer_masuklist',
					success: 		bank_transfer_masukshowResponse,
		}; 
		$('#bank_transfer_masuklistform').ajaxSubmit(options);
		return false;
	}
	
	function bank_transfer_masukshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#bank_transfer_masuklist',
					success: 		bank_transfer_masukshowResponse,
		}; 
		
		$('#bank_transfer_masuklistform').submit(function() { 
			$('#bank_transfer_masuklistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function bank_transfer_masukcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function bank_transfer_masukadd()
	{
		$('#bank_transfer_masukformholder').load('<?=site_url()."/bank_transfer_masukadd/";?>', function()
		{$('#bank_transfer_masukclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bank_transfer_masukformholder' + '\').html(\'\');' + '$(\'' + '#bank_transfer_masukclosebutton' + '\').html(\'\');' + '$(\'' + '#bank_transfer_masuklist' + '\').load(\'<?=site_url();?>/bank_transfer_masuklist\');' + ';"></input>');
		});	
	}
	
	function bank_transfer_masukedit(id)
	{
		$('#bank_transfer_masukformholder').load('<?=site_url()."/bank_transfer_masukedit/index/";?>' + id, function()
		{$('#bank_transfer_masukclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bank_transfer_masukformholder' + '\').html(\'\');' + '$(\'' + '#bank_transfer_masukclosebutton' + '\').html(\'\');' + '$(\'' + '#bank_transfer_masuklist' + '\').load(\'<?=site_url();?>/bank_transfer_masuklist\');' + ';"></input>');
		});	
	}
	
	function bank_transfer_masukview(id)
	{
		$('#bank_transfer_masukformholder').load('<?=site_url()."/bank_transfer_masukview/index/";?>' + id, function()
		{$('#bank_transfer_masukclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bank_transfer_masukformholder' + '\').html(\'\');' + '$(\'' + '#bank_transfer_masukclosebutton' + '\').html(\'\');' + '$(\'' + '#bank_transfer_masuklist' + '\').load(\'<?=site_url();?>/bank_transfer_masuklist\');' + ';"></input>');
		});	
	}
	
	function bank_transfer_masukgotopage()
	{
		var page = document.bank_transfer_masuklistform.pageno.options[document.bank_transfer_masuklistform.pageno.selectedIndex].value;
		
		$("#bank_transfer_masukcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#bank_transfer_masuklist',
					success: 		bank_transfer_masukshowResponse,
		}; 
		$('#bank_transfer_masuklistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="bank_transfer_masuk-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="bank_transfer_masukclosebutton"></div>
		<div id="bank_transfer_masukformholder"></div>
		<div id="bank_transfer_masuklist">
		<!--<form method="post" action="<?=site_url();?>/bank_transfer_masuklist/index/" id="bank_transfer_masuklistform" name="bank_transfer_masuklistform">-->
		<form method="post" action="<?=current_url();?>" id="bank_transfer_masuklistform" name="bank_transfer_masuklistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="bank_transfer_masukcurrsort">
			</div>
			<div id="bank_transfer_masuksort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="bank_transfer_masukadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/bank_transfer_masukadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/bank_transfer_masukadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="bank_transfer_masuksortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="bank_transfer_masuksortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="bank_transfer_masuksortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="bank_transfer_masuksortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/bank_transfer_masukview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('bank_transfer_masukview/index/'.$row['id'], $row['banktransfermasuk__idstring']);?></td><td><?=$row['banktransfermasuk__date'];?></td><td><?php if (isset($row['banktransfermasuk__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['banktransfermasuk__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['banktransfermasuk__amount'], 2);?></td><td><?=$row['banktransfermasuk__notes'];?></td><td><?php if ($row['banktransfermasuk__transferedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['banktransfermasuk__lastupdate'];?></td><td><?=$row['banktransfermasuk__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="bank_transfer_masukview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/bank_transfer_masukview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="bank_transfer_masukedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/bank_transfer_masukedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="bank_transfer_masukconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="bank_transfer_masukgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>