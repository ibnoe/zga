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
					target:        '#surat_pengajuan_repairlist',
					success: 		surat_pengajuan_repairshowResponse,
		}; 
		
		$('#surat_pengajuan_repairlistform').submit(function() { 
			$('#surat_pengajuan_repairlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function surat_pengajuan_repairconfirmdelete(delid, obj)
	{
		$('#surat_pengajuan_repair-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', surat_pengajuan_repairconfirmdelete2(delid, obj));
	}
	
	function surat_pengajuan_repairconfirmdelete2(delid, obj)
	{
		$( "#surat_pengajuan_repair-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					surat_pengajuan_repaircalldeletefn('surat_pengajuan_repairdelete', delid, 'surat_pengajuan_repairlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#surat_pengajuan_repair-dialog-confirm').html('');
	}
	
	function surat_pengajuan_repairsortupdown(field, direction)
	{
		$("#surat_pengajuan_repaircurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#surat_pengajuan_repairlist',
					success: 		surat_pengajuan_repairshowResponse,
		}; 
		$('#surat_pengajuan_repairlistform').ajaxSubmit(options);
		return false;
	}
	
	function surat_pengajuan_repairshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#surat_pengajuan_repairlist',
					success: 		surat_pengajuan_repairshowResponse,
		}; 
		
		$('#surat_pengajuan_repairlistform').submit(function() { 
			$('#surat_pengajuan_repairlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function surat_pengajuan_repaircalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function surat_pengajuan_repairadd()
	{
		$('#surat_pengajuan_repairformholder').load('<?=site_url()."/surat_pengajuan_repairadd/";?>', function()
		{$('#surat_pengajuan_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#surat_pengajuan_repairformholder' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repairlist' + '\').load(\'<?=site_url();?>/surat_pengajuan_repairlist\');' + ';"></input>');
		});	
	}
	
	function surat_pengajuan_repairedit(id)
	{
		$('#surat_pengajuan_repairformholder').load('<?=site_url()."/surat_pengajuan_repairedit/index/";?>' + id, function()
		{$('#surat_pengajuan_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#surat_pengajuan_repairformholder' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repairlist' + '\').load(\'<?=site_url();?>/surat_pengajuan_repairlist\');' + ';"></input>');
		});	
	}
	
	function surat_pengajuan_repairview(id)
	{
		$('#surat_pengajuan_repairformholder').load('<?=site_url()."/surat_pengajuan_repairview/index/";?>' + id, function()
		{$('#surat_pengajuan_repairclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#surat_pengajuan_repairformholder' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repairclosebutton' + '\').html(\'\');' + '$(\'' + '#surat_pengajuan_repairlist' + '\').load(\'<?=site_url();?>/surat_pengajuan_repairlist\');' + ';"></input>');
		});	
	}
	
	function surat_pengajuan_repairgotopage()
	{
		var page = document.surat_pengajuan_repairlistform.pageno.options[document.surat_pengajuan_repairlistform.pageno.selectedIndex].value;
		
		$("#surat_pengajuan_repaircurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#surat_pengajuan_repairlist',
					success: 		surat_pengajuan_repairshowResponse,
		}; 
		$('#surat_pengajuan_repairlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="surat_pengajuan_repair-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="surat_pengajuan_repairclosebutton"></div>
		<div id="surat_pengajuan_repairformholder"></div>
		<div id="surat_pengajuan_repairlist">
		<!--<form method="post" action="<?=site_url();?>/surat_pengajuan_repairlist/index/" id="surat_pengajuan_repairlistform" name="surat_pengajuan_repairlistform">-->
		<form method="post" action="<?=current_url();?>" id="surat_pengajuan_repairlistform" name="surat_pengajuan_repairlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="surat_pengajuan_repaircurrsort">
			</div>
			<div id="surat_pengajuan_repairsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="surat_pengajuan_repairadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/surat_pengajuan_repairadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/surat_pengajuan_repairadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="surat_pengajuan_repairsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="surat_pengajuan_repairsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="surat_pengajuan_repairsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="surat_pengajuan_repairsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/surat_pengajuan_repairview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('surat_pengajuan_repairview/index/'.$row['id'], $row['suratpengajuanrepair__idstring']);?></td><td><?=$row['suratpengajuanrepair__date'];?></td><td><?=$row['suratpengajuanrepair__requester'];?></td><td><?=$row['suratpengajuanrepair__lastupdate'];?></td><td><?=$row['suratpengajuanrepair__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="surat_pengajuan_repairview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/surat_pengajuan_repairview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="surat_pengajuan_repairedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/surat_pengajuan_repairedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="surat_pengajuan_repairconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="surat_pengajuan_repairgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>