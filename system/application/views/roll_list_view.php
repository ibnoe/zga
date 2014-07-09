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
					target:        '#rolllist',
					success: 		rollshowResponse,
		}; 
		
		$('#rolllistform').submit(function() { 
			$('#rolllistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function rollconfirmdelete(delid, obj)
	{
		$('#roll-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rollconfirmdelete2(delid, obj));
	}
	
	function rollconfirmdelete2(delid, obj)
	{
		$( "#roll-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rollcalldeletefn('rolldelete', delid, 'rolllist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roll-dialog-confirm').html('');
	}
	
	function rollsortupdown(field, direction)
	{
		$("#rollcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#rolllist',
					success: 		rollshowResponse,
		}; 
		$('#rolllistform').ajaxSubmit(options);
		return false;
	}
	
	function rollshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#rolllist',
					success: 		rollshowResponse,
		}; 
		
		$('#rolllistform').submit(function() { 
			$('#rolllistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function rollcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function rolladd()
	{
		$('#rollformholder').load('<?=site_url()."/rolladd/";?>', function()
		{$('#rollclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rollformholder' + '\').html(\'\');' + '$(\'' + '#rollclosebutton' + '\').html(\'\');' + '$(\'' + '#rolllist' + '\').load(\'<?=site_url();?>/rolllist\');' + ';"></input>');
		});	
	}
	
	function rolledit(id)
	{
		$('#rollformholder').load('<?=site_url()."/rolledit/index/";?>' + id, function()
		{$('#rollclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rollformholder' + '\').html(\'\');' + '$(\'' + '#rollclosebutton' + '\').html(\'\');' + '$(\'' + '#rolllist' + '\').load(\'<?=site_url();?>/rolllist\');' + ';"></input>');
		});	
	}
	
	function rollview(id)
	{
		$('#rollformholder').load('<?=site_url()."/rollview/index/";?>' + id, function()
		{$('#rollclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rollformholder' + '\').html(\'\');' + '$(\'' + '#rollclosebutton' + '\').html(\'\');' + '$(\'' + '#rolllist' + '\').load(\'<?=site_url();?>/rolllist\');' + ';"></input>');
		});	
	}
	
	function rollgotopage()
	{
		var page = document.rolllistform.pageno.options[document.rolllistform.pageno.selectedIndex].value;
		
		$("#rollcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#rolllist',
					success: 		rollshowResponse,
		}; 
		$('#rolllistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="roll-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="rollclosebutton"></div>
		<div id="rollformholder"></div>
		<div id="rolllist">
		<!--<form method="post" action="<?=site_url();?>/rolllist/index/" id="rolllistform" name="rolllistform">-->
		<form method="post" action="<?=current_url();?>" id="rolllistform" name="rolllistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="rollcurrsort">
			</div>
			<div id="rollsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="rolladd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rolladd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rolladd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="rollsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="rollsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="rollsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="rollsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/rollview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('rollview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__rollno'];?></td><td><?=$row['item__inktype'];?></td><td><?=$row['item__machinetype'];?></td><td><?=$row['item__core'];?></td><td align='right'><?=number_format($row['item__rd'], 2);?></td><td align='right'><?=number_format($row['item__cd'], 2);?></td><td align='right'><?=number_format($row['item__rl'], 2);?></td><td align='right'><?=number_format($row['item__wl'], 2);?></td><td align='right'><?=number_format($row['item__tl'], 2);?></td><td><?=$row['item__compound'];?></td><td><?=$row['item__processscheme'];?></td><td><?=$row['item__rollertype'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="rollview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/rollview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="rolledit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rolledit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="rollconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="rollgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>