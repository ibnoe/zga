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
					target:        '#cogs_accountslist',
					success: 		cogs_accountsshowResponse,
		}; 
		
		$('#cogs_accountslistform').submit(function() { 
			$('#cogs_accountslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function cogs_accountsconfirmdelete(delid, obj)
	{
		$('#cogs_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cogs_accountsconfirmdelete2(delid, obj));
	}
	
	function cogs_accountsconfirmdelete2(delid, obj)
	{
		$( "#cogs_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cogs_accountscalldeletefn('cogs_accountsdelete', delid, 'cogs_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cogs_accounts-dialog-confirm').html('');
	}
	
	function cogs_accountssortupdown(field, direction)
	{
		$("#cogs_accountscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#cogs_accountslist',
					success: 		cogs_accountsshowResponse,
		}; 
		$('#cogs_accountslistform').ajaxSubmit(options);
		return false;
	}
	
	function cogs_accountsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#cogs_accountslist',
					success: 		cogs_accountsshowResponse,
		}; 
		
		$('#cogs_accountslistform').submit(function() { 
			$('#cogs_accountslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function cogs_accountscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function cogs_accountsadd()
	{
		$('#cogs_accountsformholder').load('<?=site_url()."/cogs_accountsadd/";?>', function()
		{$('#cogs_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cogs_accountsformholder' + '\').html(\'\');' + '$(\'' + '#cogs_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#cogs_accountslist' + '\').load(\'<?=site_url();?>/cogs_accountslist\');' + ';"></input>');
		});	
	}
	
	function cogs_accountsedit(id)
	{
		$('#cogs_accountsformholder').load('<?=site_url()."/cogs_accountsedit/index/";?>' + id, function()
		{$('#cogs_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cogs_accountsformholder' + '\').html(\'\');' + '$(\'' + '#cogs_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#cogs_accountslist' + '\').load(\'<?=site_url();?>/cogs_accountslist\');' + ';"></input>');
		});	
	}
	
	function cogs_accountsview(id)
	{
		$('#cogs_accountsformholder').load('<?=site_url()."/cogs_accountsview/index/";?>' + id, function()
		{$('#cogs_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cogs_accountsformholder' + '\').html(\'\');' + '$(\'' + '#cogs_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#cogs_accountslist' + '\').load(\'<?=site_url();?>/cogs_accountslist\');' + ';"></input>');
		});	
	}
	
	function cogs_accountsgotopage()
	{
		var page = document.cogs_accountslistform.pageno.options[document.cogs_accountslistform.pageno.selectedIndex].value;
		
		$("#cogs_accountscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#cogs_accountslist',
					success: 		cogs_accountsshowResponse,
		}; 
		$('#cogs_accountslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="cogs_accounts-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="cogs_accountsclosebutton"></div>
		<div id="cogs_accountsformholder"></div>
		<div id="cogs_accountslist">
		<!--<form method="post" action="<?=site_url();?>/cogs_accountslist/index/" id="cogs_accountslistform" name="cogs_accountslistform">-->
		<form method="post" action="<?=current_url();?>" id="cogs_accountslistform" name="cogs_accountslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="cogs_accountscurrsort">
			</div>
			<div id="cogs_accountssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="cogs_accountsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cogs_accountsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cogs_accountsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="cogs_accountssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="cogs_accountssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="cogs_accountssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="cogs_accountssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/cogs_accountsview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('cogs_accountsview/index/'.$row['id'], $row['coa__idstring']);?></td><td><?=$row['coa__name'];?></td><td><?php if (isset($row['coa__coatype_id']) && $row['coatype__name'] != "") echo anchor('account_typeview/index/'.$row['coa__coatype_id'], $row['coatype__name']);?></td><td><?=$row['coa__lastupdate'];?></td><td><?=$row['coa__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="cogs_accountsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/cogs_accountsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="cogs_accountsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cogs_accountsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="cogs_accountsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="cogs_accountsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>