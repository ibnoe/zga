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
					target:        '#depreciation_accountslist',
					success: 		depreciation_accountsshowResponse,
		}; 
		
		$('#depreciation_accountslistform').submit(function() { 
			$('#depreciation_accountslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function depreciation_accountsconfirmdelete(delid, obj)
	{
		$('#depreciation_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', depreciation_accountsconfirmdelete2(delid, obj));
	}
	
	function depreciation_accountsconfirmdelete2(delid, obj)
	{
		$( "#depreciation_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					depreciation_accountscalldeletefn('depreciation_accountsdelete', delid, 'depreciation_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#depreciation_accounts-dialog-confirm').html('');
	}
	
	function depreciation_accountssortupdown(field, direction)
	{
		$("#depreciation_accountscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#depreciation_accountslist',
					success: 		depreciation_accountsshowResponse,
		}; 
		$('#depreciation_accountslistform').ajaxSubmit(options);
		return false;
	}
	
	function depreciation_accountsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#depreciation_accountslist',
					success: 		depreciation_accountsshowResponse,
		}; 
		
		$('#depreciation_accountslistform').submit(function() { 
			$('#depreciation_accountslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function depreciation_accountscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function depreciation_accountsadd()
	{
		$('#depreciation_accountsformholder').load('<?=site_url()."/depreciation_accountsadd/";?>', function()
		{$('#depreciation_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#depreciation_accountsformholder' + '\').html(\'\');' + '$(\'' + '#depreciation_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#depreciation_accountslist' + '\').load(\'<?=site_url();?>/depreciation_accountslist\');' + ';"></input>');
		});	
	}
	
	function depreciation_accountsedit(id)
	{
		$('#depreciation_accountsformholder').load('<?=site_url()."/depreciation_accountsedit/index/";?>' + id, function()
		{$('#depreciation_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#depreciation_accountsformholder' + '\').html(\'\');' + '$(\'' + '#depreciation_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#depreciation_accountslist' + '\').load(\'<?=site_url();?>/depreciation_accountslist\');' + ';"></input>');
		});	
	}
	
	function depreciation_accountsview(id)
	{
		$('#depreciation_accountsformholder').load('<?=site_url()."/depreciation_accountsview/index/";?>' + id, function()
		{$('#depreciation_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#depreciation_accountsformholder' + '\').html(\'\');' + '$(\'' + '#depreciation_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#depreciation_accountslist' + '\').load(\'<?=site_url();?>/depreciation_accountslist\');' + ';"></input>');
		});	
	}
	
	function depreciation_accountsgotopage()
	{
		var page = document.depreciation_accountslistform.pageno.options[document.depreciation_accountslistform.pageno.selectedIndex].value;
		
		$("#depreciation_accountscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#depreciation_accountslist',
					success: 		depreciation_accountsshowResponse,
		}; 
		$('#depreciation_accountslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="depreciation_accounts-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="depreciation_accountsclosebutton"></div>
		<div id="depreciation_accountsformholder"></div>
		<div id="depreciation_accountslist">
		<!--<form method="post" action="<?=site_url();?>/depreciation_accountslist/index/" id="depreciation_accountslistform" name="depreciation_accountslistform">-->
		<form method="post" action="<?=current_url();?>" id="depreciation_accountslistform" name="depreciation_accountslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="depreciation_accountscurrsort">
			</div>
			<div id="depreciation_accountssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="depreciation_accountsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/depreciation_accountsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/depreciation_accountsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="depreciation_accountssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="depreciation_accountssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="depreciation_accountssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="depreciation_accountssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/depreciation_accountsview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('depreciation_accountsview/index/'.$row['id'], $row['coa__idstring']);?></td><td><?=$row['coa__name'];?></td><td><?php if (isset($row['coa__coatype_id']) && $row['coatype__name'] != "") echo anchor('account_typeview/index/'.$row['coa__coatype_id'], $row['coatype__name']);?></td><td><?=$row['coa__lastupdate'];?></td><td><?=$row['coa__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="depreciation_accountsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/depreciation_accountsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="depreciation_accountsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/depreciation_accountsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="depreciation_accountsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="depreciation_accountsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>