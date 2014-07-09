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
					target:        '#inventory_accountslist',
					success: 		inventory_accountsshowResponse,
		}; 
		
		$('#inventory_accountslistform').submit(function() { 
			$('#inventory_accountslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function inventory_accountsconfirmdelete(delid, obj)
	{
		$('#inventory_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', inventory_accountsconfirmdelete2(delid, obj));
	}
	
	function inventory_accountsconfirmdelete2(delid, obj)
	{
		$( "#inventory_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					inventory_accountscalldeletefn('inventory_accountsdelete', delid, 'inventory_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#inventory_accounts-dialog-confirm').html('');
	}
	
	function inventory_accountssortupdown(field, direction)
	{
		$("#inventory_accountscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#inventory_accountslist',
					success: 		inventory_accountsshowResponse,
		}; 
		$('#inventory_accountslistform').ajaxSubmit(options);
		return false;
	}
	
	function inventory_accountsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#inventory_accountslist',
					success: 		inventory_accountsshowResponse,
		}; 
		
		$('#inventory_accountslistform').submit(function() { 
			$('#inventory_accountslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function inventory_accountscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function inventory_accountsadd()
	{
		$('#inventory_accountsformholder').load('<?=site_url()."/inventory_accountsadd/";?>', function()
		{$('#inventory_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inventory_accountsformholder' + '\').html(\'\');' + '$(\'' + '#inventory_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#inventory_accountslist' + '\').load(\'<?=site_url();?>/inventory_accountslist\');' + ';"></input>');
		});	
	}
	
	function inventory_accountsedit(id)
	{
		$('#inventory_accountsformholder').load('<?=site_url()."/inventory_accountsedit/index/";?>' + id, function()
		{$('#inventory_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inventory_accountsformholder' + '\').html(\'\');' + '$(\'' + '#inventory_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#inventory_accountslist' + '\').load(\'<?=site_url();?>/inventory_accountslist\');' + ';"></input>');
		});	
	}
	
	function inventory_accountsview(id)
	{
		$('#inventory_accountsformholder').load('<?=site_url()."/inventory_accountsview/index/";?>' + id, function()
		{$('#inventory_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inventory_accountsformholder' + '\').html(\'\');' + '$(\'' + '#inventory_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#inventory_accountslist' + '\').load(\'<?=site_url();?>/inventory_accountslist\');' + ';"></input>');
		});	
	}
	
	function inventory_accountsgotopage()
	{
		var page = document.inventory_accountslistform.pageno.options[document.inventory_accountslistform.pageno.selectedIndex].value;
		
		$("#inventory_accountscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#inventory_accountslist',
					success: 		inventory_accountsshowResponse,
		}; 
		$('#inventory_accountslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="inventory_accounts-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="inventory_accountsclosebutton"></div>
		<div id="inventory_accountsformholder"></div>
		<div id="inventory_accountslist">
		<!--<form method="post" action="<?=site_url();?>/inventory_accountslist/index/" id="inventory_accountslistform" name="inventory_accountslistform">-->
		<form method="post" action="<?=current_url();?>" id="inventory_accountslistform" name="inventory_accountslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="inventory_accountscurrsort">
			</div>
			<div id="inventory_accountssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="inventory_accountsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/inventory_accountsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/inventory_accountsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="inventory_accountssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="inventory_accountssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="inventory_accountssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="inventory_accountssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/inventory_accountsview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('inventory_accountsview/index/'.$row['id'], $row['coa__idstring']);?></td><td><?=$row['coa__name'];?></td><td><?php if (isset($row['coa__coatype_id']) && $row['coatype__name'] != "") echo anchor('account_typeview/index/'.$row['coa__coatype_id'], $row['coatype__name']);?></td><td><?=$row['coa__lastupdate'];?></td><td><?=$row['coa__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="inventory_accountsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/inventory_accountsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="inventory_accountsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/inventory_accountsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="inventory_accountsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="inventory_accountsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>