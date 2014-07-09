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
					target:        '#klaim_tunjangan_kesehatanlist',
					success: 		klaim_tunjangan_kesehatanshowResponse,
		}; 
		
		$('#klaim_tunjangan_kesehatanlistform').submit(function() { 
			$('#klaim_tunjangan_kesehatanlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function klaim_tunjangan_kesehatanconfirmdelete(delid, obj)
	{
		$('#klaim_tunjangan_kesehatan-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', klaim_tunjangan_kesehatanconfirmdelete2(delid, obj));
	}
	
	function klaim_tunjangan_kesehatanconfirmdelete2(delid, obj)
	{
		$( "#klaim_tunjangan_kesehatan-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					klaim_tunjangan_kesehatancalldeletefn('klaim_tunjangan_kesehatandelete', delid, 'klaim_tunjangan_kesehatanlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#klaim_tunjangan_kesehatan-dialog-confirm').html('');
	}
	
	function klaim_tunjangan_kesehatansortupdown(field, direction)
	{
		$("#klaim_tunjangan_kesehatancurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#klaim_tunjangan_kesehatanlist',
					success: 		klaim_tunjangan_kesehatanshowResponse,
		}; 
		$('#klaim_tunjangan_kesehatanlistform').ajaxSubmit(options);
		return false;
	}
	
	function klaim_tunjangan_kesehatanshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#klaim_tunjangan_kesehatanlist',
					success: 		klaim_tunjangan_kesehatanshowResponse,
		}; 
		
		$('#klaim_tunjangan_kesehatanlistform').submit(function() { 
			$('#klaim_tunjangan_kesehatanlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function klaim_tunjangan_kesehatancalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function klaim_tunjangan_kesehatanadd()
	{
		$('#klaim_tunjangan_kesehatanformholder').load('<?=site_url()."/klaim_tunjangan_kesehatanadd/";?>', function()
		{$('#klaim_tunjangan_kesehatanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#klaim_tunjangan_kesehatanformholder' + '\').html(\'\');' + '$(\'' + '#klaim_tunjangan_kesehatanclosebutton' + '\').html(\'\');' + '$(\'' + '#klaim_tunjangan_kesehatanlist' + '\').load(\'<?=site_url();?>/klaim_tunjangan_kesehatanlist\');' + ';"></input>');
		});	
	}
	
	function klaim_tunjangan_kesehatanedit(id)
	{
		$('#klaim_tunjangan_kesehatanformholder').load('<?=site_url()."/klaim_tunjangan_kesehatanedit/index/";?>' + id, function()
		{$('#klaim_tunjangan_kesehatanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#klaim_tunjangan_kesehatanformholder' + '\').html(\'\');' + '$(\'' + '#klaim_tunjangan_kesehatanclosebutton' + '\').html(\'\');' + '$(\'' + '#klaim_tunjangan_kesehatanlist' + '\').load(\'<?=site_url();?>/klaim_tunjangan_kesehatanlist\');' + ';"></input>');
		});	
	}
	
	function klaim_tunjangan_kesehatanview(id)
	{
		$('#klaim_tunjangan_kesehatanformholder').load('<?=site_url()."/klaim_tunjangan_kesehatanview/index/";?>' + id, function()
		{$('#klaim_tunjangan_kesehatanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#klaim_tunjangan_kesehatanformholder' + '\').html(\'\');' + '$(\'' + '#klaim_tunjangan_kesehatanclosebutton' + '\').html(\'\');' + '$(\'' + '#klaim_tunjangan_kesehatanlist' + '\').load(\'<?=site_url();?>/klaim_tunjangan_kesehatanlist\');' + ';"></input>');
		});	
	}
	
	function klaim_tunjangan_kesehatangotopage()
	{
		var page = document.klaim_tunjangan_kesehatanlistform.pageno.options[document.klaim_tunjangan_kesehatanlistform.pageno.selectedIndex].value;
		
		$("#klaim_tunjangan_kesehatancurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#klaim_tunjangan_kesehatanlist',
					success: 		klaim_tunjangan_kesehatanshowResponse,
		}; 
		$('#klaim_tunjangan_kesehatanlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="klaim_tunjangan_kesehatan-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="klaim_tunjangan_kesehatanclosebutton"></div>
		<div id="klaim_tunjangan_kesehatanformholder"></div>
		<div id="klaim_tunjangan_kesehatanlist">
		<!--<form method="post" action="<?=site_url();?>/klaim_tunjangan_kesehatanlist/index/" id="klaim_tunjangan_kesehatanlistform" name="klaim_tunjangan_kesehatanlistform">-->
		<form method="post" action="<?=current_url();?>" id="klaim_tunjangan_kesehatanlistform" name="klaim_tunjangan_kesehatanlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="klaim_tunjangan_kesehatancurrsort">
			</div>
			<div id="klaim_tunjangan_kesehatansort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="klaim_tunjangan_kesehatanadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/klaim_tunjangan_kesehatanadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/klaim_tunjangan_kesehatanadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="klaim_tunjangan_kesehatansortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="klaim_tunjangan_kesehatansortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="klaim_tunjangan_kesehatansortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="klaim_tunjangan_kesehatansortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/klaim_tunjangan_kesehatanview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('klaim_tunjangan_kesehatanview/index/'.$row['id'], $row['tunjangankesehatanusage__date']);?></td><td><?=$row['tunjangankesehatanusage__description'];?></td><td align='right'><?=number_format($row['tunjangankesehatanusage__amount'], 2);?></td><td align='right'><?=number_format($row['tunjangankesehatanusage__amountpaid'], 2);?></td><td><?=$row['tunjangankesehatanusage__notes'];?></td><td><?=$row['tunjangankesehatanusage__lastupdate'];?></td><td><?=$row['tunjangankesehatanusage__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="klaim_tunjangan_kesehatanview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/klaim_tunjangan_kesehatanview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="klaim_tunjangan_kesehatanedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/klaim_tunjangan_kesehatanedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="klaim_tunjangan_kesehatanconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="klaim_tunjangan_kesehatangotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>