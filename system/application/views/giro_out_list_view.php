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
					target:        '#giro_outlist',
					success: 		giro_outshowResponse,
		}; 
		
		$('#giro_outlistform').submit(function() { 
			$('#giro_outlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function giro_outconfirmdelete(delid, obj)
	{
		$('#giro_out-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_outconfirmdelete2(delid, obj));
	}
	
	function giro_outconfirmdelete2(delid, obj)
	{
		$( "#giro_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_outcalldeletefn('giro_outdelete', delid, 'giro_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out-dialog-confirm').html('');
	}
	
	function giro_outsortupdown(field, direction)
	{
		$("#giro_outcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#giro_outlist',
					success: 		giro_outshowResponse,
		}; 
		$('#giro_outlistform').ajaxSubmit(options);
		return false;
	}
	
	function giro_outshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#giro_outlist',
					success: 		giro_outshowResponse,
		}; 
		
		$('#giro_outlistform').submit(function() { 
			$('#giro_outlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function giro_outcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function giro_outadd()
	{
		$('#giro_outformholder').load('<?=site_url()."/giro_outadd/";?>', function()
		{$('#giro_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_outformholder' + '\').html(\'\');' + '$(\'' + '#giro_outclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_outlist' + '\').load(\'<?=site_url();?>/giro_outlist\');' + ';"></input>');
		});	
	}
	
	function giro_outedit(id)
	{
		$('#giro_outformholder').load('<?=site_url()."/giro_outedit/index/";?>' + id, function()
		{$('#giro_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_outformholder' + '\').html(\'\');' + '$(\'' + '#giro_outclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_outlist' + '\').load(\'<?=site_url();?>/giro_outlist\');' + ';"></input>');
		});	
	}
	
	function giro_outview(id)
	{
		$('#giro_outformholder').load('<?=site_url()."/giro_outview/index/";?>' + id, function()
		{$('#giro_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_outformholder' + '\').html(\'\');' + '$(\'' + '#giro_outclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_outlist' + '\').load(\'<?=site_url();?>/giro_outlist\');' + ';"></input>');
		});	
	}
	
	function giro_outgotopage()
	{
		var page = document.giro_outlistform.pageno.options[document.giro_outlistform.pageno.selectedIndex].value;
		
		$("#giro_outcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#giro_outlist',
					success: 		giro_outshowResponse,
		}; 
		$('#giro_outlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="giro_out-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="giro_outclosebutton"></div>
		<div id="giro_outformholder"></div>
		<div id="giro_outlist">
		<!--<form method="post" action="<?=site_url();?>/giro_outlist/index/" id="giro_outlistform" name="giro_outlistform">-->
		<form method="post" action="<?=current_url();?>" id="giro_outlistform" name="giro_outlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="giro_outcurrsort">
			</div>
			<div id="giro_outsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="giro_outadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_outadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_outadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="giro_outsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="giro_outsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="giro_outsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="giro_outsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/giro_outview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('giro_outview/index/'.$row['id'], $row['giroout__girooutid']);?></td><td><?=$row['giroout__createdate'];?></td><td><?php if (isset($row['giroout__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['giroout__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['giroout__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['giroout__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['giroout__amount'], 2);?></td><td align='right'><?=number_format($row['giroout__amountused'], 2);?></td><td><?php if (isset($row['giroout__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['giroout__coa_id'], $row['coa__name']);?></td><td><?=$row['giroout__notes'];?></td><td><?php if ($row['giroout__usedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['giroout__lastupdate'];?></td><td><?=$row['giroout__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="giro_outview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/giro_outview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="giro_outedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_outedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_outconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="giro_outgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>