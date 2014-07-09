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
					target:        '#cuti_klaimlist',
					success: 		cuti_klaimshowResponse,
		}; 
		
		$('#cuti_klaimlistform').submit(function() { 
			$('#cuti_klaimlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function cuti_klaimconfirmdelete(delid, obj)
	{
		$('#cuti_klaim-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cuti_klaimconfirmdelete2(delid, obj));
	}
	
	function cuti_klaimconfirmdelete2(delid, obj)
	{
		$( "#cuti_klaim-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cuti_klaimcalldeletefn('cuti_klaimdelete', delid, 'cuti_klaimlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_klaim-dialog-confirm').html('');
	}
	
	function cuti_klaimsortupdown(field, direction)
	{
		$("#cuti_klaimcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#cuti_klaimlist',
					success: 		cuti_klaimshowResponse,
		}; 
		$('#cuti_klaimlistform').ajaxSubmit(options);
		return false;
	}
	
	function cuti_klaimshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#cuti_klaimlist',
					success: 		cuti_klaimshowResponse,
		}; 
		
		$('#cuti_klaimlistform').submit(function() { 
			$('#cuti_klaimlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function cuti_klaimcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function cuti_klaimadd()
	{
		$('#cuti_klaimformholder').load('<?=site_url()."/cuti_klaimadd/";?>', function()
		{$('#cuti_klaimclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_klaimformholder' + '\').html(\'\');' + '$(\'' + '#cuti_klaimclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_klaimlist' + '\').load(\'<?=site_url();?>/cuti_klaimlist\');' + ';"></input>');
		});	
	}
	
	function cuti_klaimedit(id)
	{
		$('#cuti_klaimformholder').load('<?=site_url()."/cuti_klaimedit/index/";?>' + id, function()
		{$('#cuti_klaimclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_klaimformholder' + '\').html(\'\');' + '$(\'' + '#cuti_klaimclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_klaimlist' + '\').load(\'<?=site_url();?>/cuti_klaimlist\');' + ';"></input>');
		});	
	}
	
	function cuti_klaimview(id)
	{
		$('#cuti_klaimformholder').load('<?=site_url()."/cuti_klaimview/index/";?>' + id, function()
		{$('#cuti_klaimclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_klaimformholder' + '\').html(\'\');' + '$(\'' + '#cuti_klaimclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_klaimlist' + '\').load(\'<?=site_url();?>/cuti_klaimlist\');' + ';"></input>');
		});	
	}
	
	function cuti_klaimgotopage()
	{
		var page = document.cuti_klaimlistform.pageno.options[document.cuti_klaimlistform.pageno.selectedIndex].value;
		
		$("#cuti_klaimcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#cuti_klaimlist',
					success: 		cuti_klaimshowResponse,
		}; 
		$('#cuti_klaimlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="cuti_klaim-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="cuti_klaimclosebutton"></div>
		<div id="cuti_klaimformholder"></div>
		<div id="cuti_klaimlist">
		<!--<form method="post" action="<?=site_url();?>/cuti_klaimlist/index/" id="cuti_klaimlistform" name="cuti_klaimlistform">-->
		<form method="post" action="<?=current_url();?>" id="cuti_klaimlistform" name="cuti_klaimlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="cuti_klaimcurrsort">
			</div>
			<div id="cuti_klaimsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="cuti_klaimadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cuti_klaimadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cuti_klaimadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="cuti_klaimsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="cuti_klaimsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="cuti_klaimsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="cuti_klaimsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/cuti_klaimview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('cuti_klaimview/index/'.$row['id'], $row['cutiklaim__date']);?></td><td align='right'><?=number_format($row['cutiklaim__totalcutiklaimed'], 2);?></td><td><?php if (isset($row['cutiklaim__users_id']) && $row['users__firstname'] != "") echo anchor('hr_usersview/index/'.$row['cutiklaim__users_id'], $row['users__firstname']);?></td><td><?=$row['cutiklaim__notes'];?></td><td><?=$row['cutiklaim__lastupdate'];?></td><td><?=$row['cutiklaim__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="cuti_klaimview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/cuti_klaimview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="cuti_klaimedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cuti_klaimedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="cuti_klaimconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="cuti_klaimgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>