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
					target:        '#cuti_approvallist',
					success: 		cuti_approvalshowResponse,
		}; 
		
		$('#cuti_approvallistform').submit(function() { 
			$('#cuti_approvallistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function cuti_approvalconfirmdelete(delid, obj)
	{
		$('#cuti_approval-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cuti_approvalconfirmdelete2(delid, obj));
	}
	
	function cuti_approvalconfirmdelete2(delid, obj)
	{
		$( "#cuti_approval-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cuti_approvalcalldeletefn('cuti_approvaldelete', delid, 'cuti_approvallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_approval-dialog-confirm').html('');
	}
	
	function cuti_approvalsortupdown(field, direction)
	{
		$("#cuti_approvalcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#cuti_approvallist',
					success: 		cuti_approvalshowResponse,
		}; 
		$('#cuti_approvallistform').ajaxSubmit(options);
		return false;
	}
	
	function cuti_approvalshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#cuti_approvallist',
					success: 		cuti_approvalshowResponse,
		}; 
		
		$('#cuti_approvallistform').submit(function() { 
			$('#cuti_approvallistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function cuti_approvalcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function cuti_approvaladd()
	{
		$('#cuti_approvalformholder').load('<?=site_url()."/cuti_approvaladd/";?>', function()
		{$('#cuti_approvalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_approvalformholder' + '\').html(\'\');' + '$(\'' + '#cuti_approvalclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_approvallist' + '\').load(\'<?=site_url();?>/cuti_approvallist\');' + ';"></input>');
		});	
	}
	
	function cuti_approvaledit(id)
	{
		$('#cuti_approvalformholder').load('<?=site_url()."/cuti_approvaledit/index/";?>' + id, function()
		{$('#cuti_approvalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_approvalformholder' + '\').html(\'\');' + '$(\'' + '#cuti_approvalclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_approvallist' + '\').load(\'<?=site_url();?>/cuti_approvallist\');' + ';"></input>');
		});	
	}
	
	function cuti_approvalview(id)
	{
		$('#cuti_approvalformholder').load('<?=site_url()."/cuti_approvalview/index/";?>' + id, function()
		{$('#cuti_approvalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_approvalformholder' + '\').html(\'\');' + '$(\'' + '#cuti_approvalclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_approvallist' + '\').load(\'<?=site_url();?>/cuti_approvallist\');' + ';"></input>');
		});	
	}
	
	function cuti_approvalgotopage()
	{
		var page = document.cuti_approvallistform.pageno.options[document.cuti_approvallistform.pageno.selectedIndex].value;
		
		$("#cuti_approvalcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#cuti_approvallist',
					success: 		cuti_approvalshowResponse,
		}; 
		$('#cuti_approvallistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="cuti_approval-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="cuti_approvalclosebutton"></div>
		<div id="cuti_approvalformholder"></div>
		<div id="cuti_approvallist">
		<!--<form method="post" action="<?=site_url();?>/cuti_approvallist/index/" id="cuti_approvallistform" name="cuti_approvallistform">-->
		<form method="post" action="<?=current_url();?>" id="cuti_approvallistform" name="cuti_approvallistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="cuti_approvalcurrsort">
			</div>
			<div id="cuti_approvalsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="cuti_approvaladd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cuti_approvaladd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cuti_approvaladd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="cuti_approvalsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="cuti_approvalsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="cuti_approvalsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="cuti_approvalsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/cuti_approvalview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('cuti_approvalview/index/'.$row['id'], $row['cutiklaim__date']);?></td><td align='right'><?=number_format($row['cutiklaim__totalcutiklaimed'], 2);?></td><td><?=$row['cutiklaim__notes'];?></td><td><?=$row['cutiklaim__status'];?></td><td><?=$row['cutiklaim__lastupdate'];?></td><td><?=$row['cutiklaim__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="cuti_approvalview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/cuti_approvalview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="cuti_approvaledit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cuti_approvaledit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="cuti_approvalconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="cuti_approvalgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>