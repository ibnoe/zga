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
					target:        '#fixed_assetlist',
					success: 		fixed_assetshowResponse,
		}; 
		
		$('#fixed_assetlistform').submit(function() { 
			$('#fixed_assetlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function fixed_assetconfirmdelete(delid, obj)
	{
		$('#fixed_asset-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', fixed_assetconfirmdelete2(delid, obj));
	}
	
	function fixed_assetconfirmdelete2(delid, obj)
	{
		$( "#fixed_asset-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					fixed_assetcalldeletefn('fixed_assetdelete', delid, 'fixed_assetlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#fixed_asset-dialog-confirm').html('');
	}
	
	function fixed_assetsortupdown(field, direction)
	{
		$("#fixed_assetcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#fixed_assetlist',
					success: 		fixed_assetshowResponse,
		}; 
		$('#fixed_assetlistform').ajaxSubmit(options);
		return false;
	}
	
	function fixed_assetshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#fixed_assetlist',
					success: 		fixed_assetshowResponse,
		}; 
		
		$('#fixed_assetlistform').submit(function() { 
			$('#fixed_assetlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function fixed_assetcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function fixed_assetadd()
	{
		$('#fixed_assetformholder').load('<?=site_url()."/fixed_assetadd/";?>', function()
		{$('#fixed_assetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#fixed_assetformholder' + '\').html(\'\');' + '$(\'' + '#fixed_assetclosebutton' + '\').html(\'\');' + '$(\'' + '#fixed_assetlist' + '\').load(\'<?=site_url();?>/fixed_assetlist\');' + ';"></input>');
		});	
	}
	
	function fixed_assetedit(id)
	{
		$('#fixed_assetformholder').load('<?=site_url()."/fixed_assetedit/index/";?>' + id, function()
		{$('#fixed_assetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#fixed_assetformholder' + '\').html(\'\');' + '$(\'' + '#fixed_assetclosebutton' + '\').html(\'\');' + '$(\'' + '#fixed_assetlist' + '\').load(\'<?=site_url();?>/fixed_assetlist\');' + ';"></input>');
		});	
	}
	
	function fixed_assetview(id)
	{
		$('#fixed_assetformholder').load('<?=site_url()."/fixed_assetview/index/";?>' + id, function()
		{$('#fixed_assetclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#fixed_assetformholder' + '\').html(\'\');' + '$(\'' + '#fixed_assetclosebutton' + '\').html(\'\');' + '$(\'' + '#fixed_assetlist' + '\').load(\'<?=site_url();?>/fixed_assetlist\');' + ';"></input>');
		});	
	}
	
	function fixed_assetgotopage()
	{
		var page = document.fixed_assetlistform.pageno.options[document.fixed_assetlistform.pageno.selectedIndex].value;
		
		$("#fixed_assetcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#fixed_assetlist',
					success: 		fixed_assetshowResponse,
		}; 
		$('#fixed_assetlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="fixed_asset-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="fixed_assetclosebutton"></div>
		<div id="fixed_assetformholder"></div>
		<div id="fixed_assetlist">
		<!--<form method="post" action="<?=site_url();?>/fixed_assetlist/index/" id="fixed_assetlistform" name="fixed_assetlistform">-->
		<form method="post" action="<?=current_url();?>" id="fixed_assetlistform" name="fixed_assetlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="fixed_assetcurrsort">
			</div>
			<div id="fixed_assetsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="fixed_assetadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/fixed_assetadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/fixed_assetadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="fixed_assetsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="fixed_assetsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="fixed_assetsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="fixed_assetsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/fixed_assetview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('fixed_assetview/index/'.$row['id'], $row['fixedasset__name']);?></td><td><?=$row['fixedasset__datebought'];?></td><td><?php if (isset($row['fixedasset__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['fixedasset__coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['fixedasset__paidusing_coa_id']) && $row['coa1__name'] != "") echo anchor('pay_accountsview/index/'.$row['fixedasset__paidusing_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['fixedasset__depreciation_coa_id']) && $row['coa2__name'] != "") echo anchor('depreciation_accountsview/index/'.$row['fixedasset__depreciation_coa_id'], $row['coa2__name']);?></td><td><?php if (isset($row['fixedasset__accumulated_coa_id']) && $row['coa3__name'] != "") echo anchor('accumulated_accountsview/index/'.$row['fixedasset__accumulated_coa_id'], $row['coa3__name']);?></td><td align='right'><?=number_format($row['fixedasset__estlifetime'], 2);?></td><td align='right'><?=number_format($row['fixedasset__cost'], 2);?></td><td align='right'><?=number_format($row['fixedasset__salvage'], 2);?></td><td><?=$row['fixedasset__notes'];?></td><td><?=$row['fixedasset__lastupdate'];?></td><td><?=$row['fixedasset__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="fixed_assetview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/fixed_assetview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="fixed_assetedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/fixed_assetedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="fixed_assetconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="fixed_assetgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>