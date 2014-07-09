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
					target:        '#alokasi_cutilist',
					success: 		alokasi_cutishowResponse,
		}; 
		
		$('#alokasi_cutilistform').submit(function() { 
			$('#alokasi_cutilistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function alokasi_cuticonfirmdelete(delid, obj)
	{
		$('#alokasi_cuti-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', alokasi_cuticonfirmdelete2(delid, obj));
	}
	
	function alokasi_cuticonfirmdelete2(delid, obj)
	{
		$( "#alokasi_cuti-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					alokasi_cuticalldeletefn('alokasi_cutidelete', delid, 'alokasi_cutilist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#alokasi_cuti-dialog-confirm').html('');
	}
	
	function alokasi_cutisortupdown(field, direction)
	{
		$("#alokasi_cuticurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#alokasi_cutilist',
					success: 		alokasi_cutishowResponse,
		}; 
		$('#alokasi_cutilistform').ajaxSubmit(options);
		return false;
	}
	
	function alokasi_cutishowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#alokasi_cutilist',
					success: 		alokasi_cutishowResponse,
		}; 
		
		$('#alokasi_cutilistform').submit(function() { 
			$('#alokasi_cutilistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function alokasi_cuticalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function alokasi_cutiadd()
	{
		$('#alokasi_cutiformholder').load('<?=site_url()."/alokasi_cutiadd/";?>', function()
		{$('#alokasi_cuticlosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#alokasi_cutiformholder' + '\').html(\'\');' + '$(\'' + '#alokasi_cuticlosebutton' + '\').html(\'\');' + '$(\'' + '#alokasi_cutilist' + '\').load(\'<?=site_url();?>/alokasi_cutilist\');' + ';"></input>');
		});	
	}
	
	function alokasi_cutiedit(id)
	{
		$('#alokasi_cutiformholder').load('<?=site_url()."/alokasi_cutiedit/index/";?>' + id, function()
		{$('#alokasi_cuticlosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#alokasi_cutiformholder' + '\').html(\'\');' + '$(\'' + '#alokasi_cuticlosebutton' + '\').html(\'\');' + '$(\'' + '#alokasi_cutilist' + '\').load(\'<?=site_url();?>/alokasi_cutilist\');' + ';"></input>');
		});	
	}
	
	function alokasi_cutiview(id)
	{
		$('#alokasi_cutiformholder').load('<?=site_url()."/alokasi_cutiview/index/";?>' + id, function()
		{$('#alokasi_cuticlosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#alokasi_cutiformholder' + '\').html(\'\');' + '$(\'' + '#alokasi_cuticlosebutton' + '\').html(\'\');' + '$(\'' + '#alokasi_cutilist' + '\').load(\'<?=site_url();?>/alokasi_cutilist\');' + ';"></input>');
		});	
	}
	
	function alokasi_cutigotopage()
	{
		var page = document.alokasi_cutilistform.pageno.options[document.alokasi_cutilistform.pageno.selectedIndex].value;
		
		$("#alokasi_cuticurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#alokasi_cutilist',
					success: 		alokasi_cutishowResponse,
		}; 
		$('#alokasi_cutilistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="alokasi_cuti-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="alokasi_cuticlosebutton"></div>
		<div id="alokasi_cutiformholder"></div>
		<div id="alokasi_cutilist">
		<!--<form method="post" action="<?=site_url();?>/alokasi_cutilist/index/" id="alokasi_cutilistform" name="alokasi_cutilistform">-->
		<form method="post" action="<?=current_url();?>" id="alokasi_cutilistform" name="alokasi_cutilistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="alokasi_cuticurrsort">
			</div>
			<div id="alokasi_cutisort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="alokasi_cutiadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/alokasi_cutiadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/alokasi_cutiadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="alokasi_cutisortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="alokasi_cutisortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="alokasi_cutisortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="alokasi_cutisortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/alokasi_cutiview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('alokasi_cutiview/index/'.$row['id'], $row['cutiallowance__begindate']);?></td><td align='right'><?=number_format($row['cutiallowance__totalcuti'], 2);?></td><td><?=$row['cutiallowance__notes'];?></td><td><?=$row['cutiallowance__lastupdate'];?></td><td><?=$row['cutiallowance__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="alokasi_cutiview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/alokasi_cutiview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="alokasi_cutiedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/alokasi_cutiedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="alokasi_cuticonfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="alokasi_cutigotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>