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
					target:        '#alokasi_tunjangan_kesehatanlist',
					success: 		alokasi_tunjangan_kesehatanshowResponse,
		}; 
		
		$('#alokasi_tunjangan_kesehatanlistform').submit(function() { 
			$('#alokasi_tunjangan_kesehatanlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function alokasi_tunjangan_kesehatanconfirmdelete(delid, obj)
	{
		$('#alokasi_tunjangan_kesehatan-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', alokasi_tunjangan_kesehatanconfirmdelete2(delid, obj));
	}
	
	function alokasi_tunjangan_kesehatanconfirmdelete2(delid, obj)
	{
		$( "#alokasi_tunjangan_kesehatan-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					alokasi_tunjangan_kesehatancalldeletefn('alokasi_tunjangan_kesehatandelete', delid, 'alokasi_tunjangan_kesehatanlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#alokasi_tunjangan_kesehatan-dialog-confirm').html('');
	}
	
	function alokasi_tunjangan_kesehatansortupdown(field, direction)
	{
		$("#alokasi_tunjangan_kesehatancurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#alokasi_tunjangan_kesehatanlist',
					success: 		alokasi_tunjangan_kesehatanshowResponse,
		}; 
		$('#alokasi_tunjangan_kesehatanlistform').ajaxSubmit(options);
		return false;
	}
	
	function alokasi_tunjangan_kesehatanshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#alokasi_tunjangan_kesehatanlist',
					success: 		alokasi_tunjangan_kesehatanshowResponse,
		}; 
		
		$('#alokasi_tunjangan_kesehatanlistform').submit(function() { 
			$('#alokasi_tunjangan_kesehatanlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function alokasi_tunjangan_kesehatancalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function alokasi_tunjangan_kesehatanadd()
	{
		$('#alokasi_tunjangan_kesehatanformholder').load('<?=site_url()."/alokasi_tunjangan_kesehatanadd/";?>', function()
		{$('#alokasi_tunjangan_kesehatanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#alokasi_tunjangan_kesehatanformholder' + '\').html(\'\');' + '$(\'' + '#alokasi_tunjangan_kesehatanclosebutton' + '\').html(\'\');' + '$(\'' + '#alokasi_tunjangan_kesehatanlist' + '\').load(\'<?=site_url();?>/alokasi_tunjangan_kesehatanlist\');' + ';"></input>');
		});	
	}
	
	function alokasi_tunjangan_kesehatanedit(id)
	{
		$('#alokasi_tunjangan_kesehatanformholder').load('<?=site_url()."/alokasi_tunjangan_kesehatanedit/index/";?>' + id, function()
		{$('#alokasi_tunjangan_kesehatanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#alokasi_tunjangan_kesehatanformholder' + '\').html(\'\');' + '$(\'' + '#alokasi_tunjangan_kesehatanclosebutton' + '\').html(\'\');' + '$(\'' + '#alokasi_tunjangan_kesehatanlist' + '\').load(\'<?=site_url();?>/alokasi_tunjangan_kesehatanlist\');' + ';"></input>');
		});	
	}
	
	function alokasi_tunjangan_kesehatanview(id)
	{
		$('#alokasi_tunjangan_kesehatanformholder').load('<?=site_url()."/alokasi_tunjangan_kesehatanview/index/";?>' + id, function()
		{$('#alokasi_tunjangan_kesehatanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#alokasi_tunjangan_kesehatanformholder' + '\').html(\'\');' + '$(\'' + '#alokasi_tunjangan_kesehatanclosebutton' + '\').html(\'\');' + '$(\'' + '#alokasi_tunjangan_kesehatanlist' + '\').load(\'<?=site_url();?>/alokasi_tunjangan_kesehatanlist\');' + ';"></input>');
		});	
	}
	
	function alokasi_tunjangan_kesehatangotopage()
	{
		var page = document.alokasi_tunjangan_kesehatanlistform.pageno.options[document.alokasi_tunjangan_kesehatanlistform.pageno.selectedIndex].value;
		
		$("#alokasi_tunjangan_kesehatancurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#alokasi_tunjangan_kesehatanlist',
					success: 		alokasi_tunjangan_kesehatanshowResponse,
		}; 
		$('#alokasi_tunjangan_kesehatanlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="alokasi_tunjangan_kesehatan-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="alokasi_tunjangan_kesehatanclosebutton"></div>
		<div id="alokasi_tunjangan_kesehatanformholder"></div>
		<div id="alokasi_tunjangan_kesehatanlist">
		<!--<form method="post" action="<?=site_url();?>/alokasi_tunjangan_kesehatanlist/index/" id="alokasi_tunjangan_kesehatanlistform" name="alokasi_tunjangan_kesehatanlistform">-->
		<form method="post" action="<?=current_url();?>" id="alokasi_tunjangan_kesehatanlistform" name="alokasi_tunjangan_kesehatanlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="alokasi_tunjangan_kesehatancurrsort">
			</div>
			<div id="alokasi_tunjangan_kesehatansort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="alokasi_tunjangan_kesehatanadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/alokasi_tunjangan_kesehatanadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/alokasi_tunjangan_kesehatanadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="alokasi_tunjangan_kesehatansortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="alokasi_tunjangan_kesehatansortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="alokasi_tunjangan_kesehatansortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="alokasi_tunjangan_kesehatansortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/alokasi_tunjangan_kesehatanview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('alokasi_tunjangan_kesehatanview/index/'.$row['id'], $row['tunjangankesehatanallowance__date']);?></td><td><?=$row['tunjangankesehatanallowance__description'];?></td><td align='right'><?=number_format($row['tunjangankesehatanallowance__amount'], 2);?></td><td><?=$row['tunjangankesehatanallowance__notes'];?></td><td><?=$row['tunjangankesehatanallowance__lastupdate'];?></td><td><?=$row['tunjangankesehatanallowance__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="alokasi_tunjangan_kesehatanview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/alokasi_tunjangan_kesehatanview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="alokasi_tunjangan_kesehatanedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/alokasi_tunjangan_kesehatanedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="alokasi_tunjangan_kesehatanconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="alokasi_tunjangan_kesehatangotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>