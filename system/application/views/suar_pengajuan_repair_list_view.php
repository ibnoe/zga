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
					target:        '#suar_pengajuan_repairlist',
					success: 		suar_pengajuan_repairshowResponse,
		}; 
		
		$('#suar_pengajuan_repairlistform').submit(function() { 
			$('#suar_pengajuan_repairlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function suar_pengajuan_repairconfirmdelete(delid, obj)
	{
		$('#suar_pengajuan_repair-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', suar_pengajuan_repairconfirmdelete2(delid, obj));
	}
	
	function suar_pengajuan_repairconfirmdelete2(delid, obj)
	{
		$( "#suar_pengajuan_repair-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					suar_pengajuan_repaircalldeletefn('suar_pengajuan_repairdelete', delid, 'suar_pengajuan_repairlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#suar_pengajuan_repair-dialog-confirm').html('');
	}
	
	function suar_pengajuan_repairsortupdown(field, direction)
	{
		$("#suar_pengajuan_repaircurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#suar_pengajuan_repairlist',
					success: 		suar_pengajuan_repairshowResponse,
		}; 
		$('#suar_pengajuan_repairlistform').ajaxSubmit(options);
		return false;
	}
	
	function suar_pengajuan_repairshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#suar_pengajuan_repairlist',
					success: 		suar_pengajuan_repairshowResponse,
		}; 
		
		$('#suar_pengajuan_repairlistform').submit(function() { 
			$('#suar_pengajuan_repairlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function suar_pengajuan_repaircalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function suar_pengajuan_repairadd()
	{
		$('#suar_pengajuan_repairformholder').load('<?=site_url()."/suar_pengajuan_repairadd/";?>', function()
		{$('#suar_pengajuan_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#suar_pengajuan_repairformholder' + '\').html(\'\');' + '$(\'' + '#suar_pengajuan_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#suar_pengajuan_repairlist' + '\').load(\'<?=site_url();?>/suar_pengajuan_repairlist\');' + ';"></input>');
		});	
	}
	
	function suar_pengajuan_repairedit(id)
	{
		$('#suar_pengajuan_repairformholder').load('<?=site_url()."/suar_pengajuan_repairedit/index/";?>' + id, function()
		{$('#suar_pengajuan_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#suar_pengajuan_repairformholder' + '\').html(\'\');' + '$(\'' + '#suar_pengajuan_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#suar_pengajuan_repairlist' + '\').load(\'<?=site_url();?>/suar_pengajuan_repairlist\');' + ';"></input>');
		});	
	}
	
	function suar_pengajuan_repairview(id)
	{
		$('#suar_pengajuan_repairformholder').load('<?=site_url()."/suar_pengajuan_repairview/index/";?>' + id, function()
		{$('#suar_pengajuan_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#suar_pengajuan_repairformholder' + '\').html(\'\');' + '$(\'' + '#suar_pengajuan_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#suar_pengajuan_repairlist' + '\').load(\'<?=site_url();?>/suar_pengajuan_repairlist\');' + ';"></input>');
		});	
	}
	
	function suar_pengajuan_repairgotopage()
	{
		var page = document.suar_pengajuan_repairlistform.pageno.options[document.suar_pengajuan_repairlistform.pageno.selectedIndex].value;
		
		$("#suar_pengajuan_repaircurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#suar_pengajuan_repairlist',
					success: 		suar_pengajuan_repairshowResponse,
		}; 
		$('#suar_pengajuan_repairlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="suar_pengajuan_repair-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="suar_pengajuan_repairclosebutton"></div>
		<div id="suar_pengajuan_repairformholder"></div>
		<div id="suar_pengajuan_repairlist">
		<!--<form method="post" action="<?=site_url();?>/suar_pengajuan_repairlist/index/" id="suar_pengajuan_repairlistform" name="suar_pengajuan_repairlistform">-->
		<form method="post" action="<?=current_url();?>" id="suar_pengajuan_repairlistform" name="suar_pengajuan_repairlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="suar_pengajuan_repaircurrsort">
			</div>
			<div id="suar_pengajuan_repairsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="suar_pengajuan_repairadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/suar_pengajuan_repairadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/suar_pengajuan_repairadd/index/";?>')">
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
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="suar_pengajuan_repairsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="suar_pengajuan_repairsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="suar_pengajuan_repairsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="suar_pengajuan_repairsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('suar_pengajuan_repairview/index/'.$row['id'], $row['suratpengajuanrepair__idstring']);?></td><td><?=$row['suratpengajuanrepair__date'];?></td><td><?=$row['suratpengajuanrepair__requester'];?></td><td><?=$row['suratpengajuanrepair__lastupdate'];?></td><td><?=$row['suratpengajuanrepair__updatedby'];?></td><td><?=$row['suratpengajuanrepair__created'];?></td><td><?=$row['suratpengajuanrepair__createdby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="suar_pengajuan_repairview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/suar_pengajuan_repairview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="suar_pengajuan_repairedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/suar_pengajuan_repairedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="suar_pengajuan_repairconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="suar_pengajuan_repairgotopage();"');?>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>