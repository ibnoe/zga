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
					target:        '#penawaranlist',
					success: 		penawaranshowResponse,
		}; 
		
		$('#penawaranlistform').submit(function() { 
			$('#penawaranlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function penawaranconfirmdelete(delid, obj)
	{
		$('#penawaran-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penawaranconfirmdelete2(delid, obj));
	}
	
	function penawaranconfirmdelete2(delid, obj)
	{
		$( "#penawaran-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penawarancalldeletefn('penawarandelete', delid, 'penawaranlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penawaran-dialog-confirm').html('');
	}
	
	function penawaransortupdown(field, direction)
	{
		$("#penawarancurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#penawaranlist',
					success: 		penawaranshowResponse,
		}; 
		$('#penawaranlistform').ajaxSubmit(options);
		return false;
	}
	
	function penawaranshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#penawaranlist',
					success: 		penawaranshowResponse,
		}; 
		
		$('#penawaranlistform').submit(function() { 
			$('#penawaranlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function penawarancalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function penawaranadd()
	{
		$('#penawaranformholder').load('<?=site_url()."/penawaranadd/";?>', function()
		{$('#penawaranclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penawaranformholder' + '\').html(\'\');' + '$(\'' + '#penawaranclosebutton' + '\').html(\'\');' + '$(\'' + '#penawaranlist' + '\').load(\'<?=site_url();?>/penawaranlist\');' + ';"></input>');
		});	
	}
	
	function penawaranedit(id)
	{
		$('#penawaranformholder').load('<?=site_url()."/penawaranedit/index/";?>' + id, function()
		{$('#penawaranclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penawaranformholder' + '\').html(\'\');' + '$(\'' + '#penawaranclosebutton' + '\').html(\'\');' + '$(\'' + '#penawaranlist' + '\').load(\'<?=site_url();?>/penawaranlist\');' + ';"></input>');
		});	
	}
	
	function penawaranview(id)
	{
		$('#penawaranformholder').load('<?=site_url()."/penawaranview/index/";?>' + id, function()
		{$('#penawaranclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penawaranformholder' + '\').html(\'\');' + '$(\'' + '#penawaranclosebutton' + '\').html(\'\');' + '$(\'' + '#penawaranlist' + '\').load(\'<?=site_url();?>/penawaranlist\');' + ';"></input>');
		});	
	}
	
	function penawarangotopage()
	{
		var page = document.penawaranlistform.pageno.options[document.penawaranlistform.pageno.selectedIndex].value;
		
		$("#penawarancurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#penawaranlist',
					success: 		penawaranshowResponse,
		}; 
		$('#penawaranlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="penawaran-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="penawaranclosebutton"></div>
		<div id="penawaranformholder"></div>
		<div id="penawaranlist">
		<!--<form method="post" action="<?=site_url();?>/penawaranlist/index/" id="penawaranlistform" name="penawaranlistform">-->
		<form method="post" action="<?=current_url();?>" id="penawaranlistform" name="penawaranlistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#statusfilter').change(function() { $('#penawaranlistform').submit();});});</script>Status:&nbsp;<?=form_dropdown('status', $status_opt, $status, 'id="statusfilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="penawarancurrsort">
			</div>
			<div id="penawaransort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="penawaranadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penawaranadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penawaranadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="penawaransortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="penawaransortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="penawaransortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="penawaransortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/penawaranview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('penawaranview/index/'.$row['id'], $row['salesorderquote__nopenawaran']);?></td><td><?=$row['salesorderquote__customerponumber'];?></td><td><?=$row['salesorderquote__date'];?></td><td><?=$row['salesorderquote__notes'];?></td><td><?php if (isset($row['salesorderquote__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesorderquote__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesorderquote__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['salesorderquote__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['salesorderquote__currencyrate'], 2);?></td><td><?php if (isset($row['salesorderquote__marketingofficer_id']) && $row['marketingofficer__name'] != "") echo anchor('marketing_officerview/index/'.$row['salesorderquote__marketingofficer_id'], $row['marketingofficer__name']);?></td><td><?=$row['salesorderquote__status'];?></td><td><?=$row['salesorderquote__orderid'];?></td><td><?=$row['salesorderquote__lastupdate'];?></td><td><?=$row['salesorderquote__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="penawaranview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/penawaranview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="penawaranedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penawaranedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="penawaranconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="penawarangotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>