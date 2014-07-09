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
					target:        '#giro_inlist',
					success: 		giro_inshowResponse,
		}; 
		
		$('#giro_inlistform').submit(function() { 
			$('#giro_inlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function giro_inconfirmdelete(delid, obj)
	{
		$('#giro_in-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_inconfirmdelete2(delid, obj));
	}
	
	function giro_inconfirmdelete2(delid, obj)
	{
		$( "#giro_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_incalldeletefn('giro_indelete', delid, 'giro_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in-dialog-confirm').html('');
	}
	
	function giro_insortupdown(field, direction)
	{
		$("#giro_incurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#giro_inlist',
					success: 		giro_inshowResponse,
		}; 
		$('#giro_inlistform').ajaxSubmit(options);
		return false;
	}
	
	function giro_inshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#giro_inlist',
					success: 		giro_inshowResponse,
		}; 
		
		$('#giro_inlistform').submit(function() { 
			$('#giro_inlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function giro_incalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function giro_inadd()
	{
		$('#giro_informholder').load('<?=site_url()."/giro_inadd/";?>', function()
		{$('#giro_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_informholder' + '\').html(\'\');' + '$(\'' + '#giro_inclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_inlist' + '\').load(\'<?=site_url();?>/giro_inlist\');' + ';"></input>');
		});	
	}
	
	function giro_inedit(id)
	{
		$('#giro_informholder').load('<?=site_url()."/giro_inedit/index/";?>' + id, function()
		{$('#giro_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_informholder' + '\').html(\'\');' + '$(\'' + '#giro_inclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_inlist' + '\').load(\'<?=site_url();?>/giro_inlist\');' + ';"></input>');
		});	
	}
	
	function giro_inview(id)
	{
		$('#giro_informholder').load('<?=site_url()."/giro_inview/index/";?>' + id, function()
		{$('#giro_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_informholder' + '\').html(\'\');' + '$(\'' + '#giro_inclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_inlist' + '\').load(\'<?=site_url();?>/giro_inlist\');' + ';"></input>');
		});	
	}
	
	function giro_ingotopage()
	{
		var page = document.giro_inlistform.pageno.options[document.giro_inlistform.pageno.selectedIndex].value;
		
		$("#giro_incurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#giro_inlist',
					success: 		giro_inshowResponse,
		}; 
		$('#giro_inlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="giro_in-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="giro_inclosebutton"></div>
		<div id="giro_informholder"></div>
		<div id="giro_inlist">
		<!--<form method="post" action="<?=site_url();?>/giro_inlist/index/" id="giro_inlistform" name="giro_inlistform">-->
		<form method="post" action="<?=current_url();?>" id="giro_inlistform" name="giro_inlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="giro_incurrsort">
			</div>
			<div id="giro_insort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="giro_inadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_inadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_inadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="giro_insortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="giro_insortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="giro_insortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="giro_insortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['giroin__giroinid'];?></td><td><?=$row['giroin__createdate'];?></td><td><?php if (isset($row['giroin__customer_id']) && $row['giroin__customer_id'] > 0) echo $row['customer__firstname'];?></td><td><?php if (isset($row['giroin__currency_id']) && $row['giroin__currency_id'] > 0) echo $row['currency__name'];?></td><td align='right'><?=number_format($row['giroin__amount'], 2);?></td><td align='right'><?=number_format($row['giroin__amountused'], 2);?></td><td><?php if (isset($row['giroin__coa_id']) && $row['giroin__coa_id'] > 0) echo $row['coa__name'];?></td><td><?=$row['giroin__notes'];?></td><td><?php if ($row['giroin__usedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['giroin__lastupdate'];?></td><td><?=$row['giroin__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="giro_inview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/giro_inview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="giro_inedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_inedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_inconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="giro_ingotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>