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
					target:        '#spplist',
					success: 		sppshowResponse,
		}; 
		
		$('#spplistform').submit(function() { 
			$('#spplistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sppconfirmdelete(delid, obj)
	{
		$('#spp-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sppconfirmdelete2(delid, obj));
	}
	
	function sppconfirmdelete2(delid, obj)
	{
		$( "#spp-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sppcalldeletefn('sppdelete', delid, 'spplist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#spp-dialog-confirm').html('');
	}
	
	function sppsortupdown(field, direction)
	{
		$("#sppcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#spplist',
					success: 		sppshowResponse,
		}; 
		$('#spplistform').ajaxSubmit(options);
		return false;
	}
	
	function sppshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#spplist',
					success: 		sppshowResponse,
		}; 
		
		$('#spplistform').submit(function() { 
			$('#spplistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sppcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sppadd()
	{
		$('#sppformholder').load('<?=site_url()."/sppadd/";?>', function()
		{$('#sppclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sppformholder' + '\').html(\'\');' + '$(\'' + '#sppclosebutton' + '\').html(\'\');' + '$(\'' + '#spplist' + '\').load(\'<?=site_url();?>/spplist\');' + ';"></input>');
		});	
	}
	
	function sppedit(id)
	{
		$('#sppformholder').load('<?=site_url()."/sppedit/index/";?>' + id, function()
		{$('#sppclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sppformholder' + '\').html(\'\');' + '$(\'' + '#sppclosebutton' + '\').html(\'\');' + '$(\'' + '#spplist' + '\').load(\'<?=site_url();?>/spplist\');' + ';"></input>');
		});	
	}
	
	function sppview(id)
	{
		$('#sppformholder').load('<?=site_url()."/sppview/index/";?>' + id, function()
		{$('#sppclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sppformholder' + '\').html(\'\');' + '$(\'' + '#sppclosebutton' + '\').html(\'\');' + '$(\'' + '#spplist' + '\').load(\'<?=site_url();?>/spplist\');' + ';"></input>');
		});	
	}
	
	function sppgotopage()
	{
		var page = document.spplistform.pageno.options[document.spplistform.pageno.selectedIndex].value;
		
		$("#sppcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#spplist',
					success: 		sppshowResponse,
		}; 
		$('#spplistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="spp-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sppclosebutton"></div>
		<div id="sppformholder"></div>
		<div id="spplist">
		<!--<form method="post" action="<?=site_url();?>/spplist/index/" id="spplistform" name="spplistform">-->
		<form method="post" action="<?=current_url();?>" id="spplistform" name="spplistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sppcurrsort">
			</div>
			<div id="sppsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sppadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sppadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sppadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sppsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sppsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sppsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sppsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sppview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('sppview/index/'.$row['id'], $row['suratpermintaanpembelian__orderid']);?></td><td><?=$row['suratpermintaanpembelian__date'];?></td><td><?=$row['suratpermintaanpembelian__requester'];?></td><td><?=$row['suratpermintaanpembelian__divisi'];?></td><td><?=$row['suratpermintaanpembelian__buysource'];?></td><td><?=$row['suratpermintaanpembelian__notes'];?></td><td><?=$row['suratpermintaanpembelian__status'];?></td><td><?=$row['suratpermintaanpembelian__lastupdate'];?></td><td><?=$row['suratpermintaanpembelian__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sppview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sppview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sppedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sppedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sppconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sppgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>