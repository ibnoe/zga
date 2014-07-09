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
					target:        '#accumulated_accountslist',
					success: 		accumulated_accountsshowResponse,
		}; 
		
		$('#accumulated_accountslistform').submit(function() { 
			$('#accumulated_accountslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function accumulated_accountsconfirmdelete(delid, obj)
	{
		$('#accumulated_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', accumulated_accountsconfirmdelete2(delid, obj));
	}
	
	function accumulated_accountsconfirmdelete2(delid, obj)
	{
		$( "#accumulated_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					accumulated_accountscalldeletefn('accumulated_accountsdelete', delid, 'accumulated_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#accumulated_accounts-dialog-confirm').html('');
	}
	
	function accumulated_accountssortupdown(field, direction)
	{
		$("#accumulated_accountscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#accumulated_accountslist',
					success: 		accumulated_accountsshowResponse,
		}; 
		$('#accumulated_accountslistform').ajaxSubmit(options);
		return false;
	}
	
	function accumulated_accountsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#accumulated_accountslist',
					success: 		accumulated_accountsshowResponse,
		}; 
		
		$('#accumulated_accountslistform').submit(function() { 
			$('#accumulated_accountslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function accumulated_accountscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function accumulated_accountsadd()
	{
		$('#accumulated_accountsformholder').load('<?=site_url()."/accumulated_accountsadd/";?>', function()
		{$('#accumulated_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accumulated_accountsformholder' + '\').html(\'\');' + '$(\'' + '#accumulated_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#accumulated_accountslist' + '\').load(\'<?=site_url();?>/accumulated_accountslist\');' + ';"></input>');
		});	
	}
	
	function accumulated_accountsedit(id)
	{
		$('#accumulated_accountsformholder').load('<?=site_url()."/accumulated_accountsedit/index/";?>' + id, function()
		{$('#accumulated_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accumulated_accountsformholder' + '\').html(\'\');' + '$(\'' + '#accumulated_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#accumulated_accountslist' + '\').load(\'<?=site_url();?>/accumulated_accountslist\');' + ';"></input>');
		});	
	}
	
	function accumulated_accountsview(id)
	{
		$('#accumulated_accountsformholder').load('<?=site_url()."/accumulated_accountsview/index/";?>' + id, function()
		{$('#accumulated_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accumulated_accountsformholder' + '\').html(\'\');' + '$(\'' + '#accumulated_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#accumulated_accountslist' + '\').load(\'<?=site_url();?>/accumulated_accountslist\');' + ';"></input>');
		});	
	}
	
	function accumulated_accountsgotopage()
	{
		var page = document.accumulated_accountslistform.pageno.options[document.accumulated_accountslistform.pageno.selectedIndex].value;
		
		$("#accumulated_accountscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#accumulated_accountslist',
					success: 		accumulated_accountsshowResponse,
		}; 
		$('#accumulated_accountslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="accumulated_accounts-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="accumulated_accountsclosebutton"></div>
		<div id="accumulated_accountsformholder"></div>
		<div id="accumulated_accountslist">
		<!--<form method="post" action="<?=site_url();?>/accumulated_accountslist/index/" id="accumulated_accountslistform" name="accumulated_accountslistform">-->
		<form method="post" action="<?=current_url();?>" id="accumulated_accountslistform" name="accumulated_accountslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="accumulated_accountscurrsort">
			</div>
			<div id="accumulated_accountssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="accumulated_accountsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/accumulated_accountsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/accumulated_accountsadd/index/";?>')">
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
							if (false)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="accumulated_accountssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="accumulated_accountssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="accumulated_accountssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="accumulated_accountssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['coa__idstring'];?></td><td><?=$row['coa__name'];?></td><td><?php if (isset($row['coa__coatype_id']) && $row['coa__coatype_id'] > 0) echo $row['coatype__name'];?></td><td><?=$row['coa__lastupdate'];?></td><td><?=$row['coa__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="accumulated_accountsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/accumulated_accountsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="accumulated_accountsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/accumulated_accountsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="accumulated_accountsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="accumulated_accountsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>