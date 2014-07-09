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
					target:        '#accountslist',
					success: 		accountsshowResponse,
		}; 
		
		$('#accountslistform').submit(function() { 
			$('#accountslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function accountsconfirmdelete(delid, obj)
	{
		$('#accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', accountsconfirmdelete2(delid, obj));
	}
	
	function accountsconfirmdelete2(delid, obj)
	{
		$( "#accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					accountscalldeletefn('accountsdelete', delid, 'accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#accounts-dialog-confirm').html('');
	}
	
	function accountssortupdown(field, direction)
	{
		$("#accountscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#accountslist',
					success: 		accountsshowResponse,
		}; 
		$('#accountslistform').ajaxSubmit(options);
		return false;
	}
	
	function accountsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#accountslist',
					success: 		accountsshowResponse,
		}; 
		
		$('#accountslistform').submit(function() { 
			$('#accountslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function accountscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function accountsadd()
	{
		$('#accountsformholder').load('<?=site_url()."/accountsadd/";?>', function()
		{$('#accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accountsformholder' + '\').html(\'\');' + '$(\'' + '#accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#accountslist' + '\').load(\'<?=site_url();?>/accountslist\');' + ';"></input>');
		});	
	}
	
	function accountsedit(id)
	{
		$('#accountsformholder').load('<?=site_url()."/accountsedit/index/";?>' + id, function()
		{$('#accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accountsformholder' + '\').html(\'\');' + '$(\'' + '#accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#accountslist' + '\').load(\'<?=site_url();?>/accountslist\');' + ';"></input>');
		});	
	}
	
	function accountsview(id)
	{
		$('#accountsformholder').load('<?=site_url()."/accountsview/index/";?>' + id, function()
		{$('#accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accountsformholder' + '\').html(\'\');' + '$(\'' + '#accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#accountslist' + '\').load(\'<?=site_url();?>/accountslist\');' + ';"></input>');
		});	
	}
	
	function accountsgotopage()
	{
		var page = document.accountslistform.pageno.options[document.accountslistform.pageno.selectedIndex].value;
		
		$("#accountscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#accountslist',
					success: 		accountsshowResponse,
		}; 
		$('#accountslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="accounts-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="accountsclosebutton"></div>
		<div id="accountsformholder"></div>
		<div id="accountslist">
		<!--<form method="post" action="<?=site_url();?>/accountslist/index/" id="accountslistform" name="accountslistform">-->
		<form method="post" action="<?=current_url();?>" id="accountslistform" name="accountslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="accountscurrsort">
			</div>
			<div id="accountssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="accountsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/accountsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/accountsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="accountssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="accountssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="accountssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="accountssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
						<!--<td class="view"><input class="button" type="button" value="View" onclick="accountsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/accountsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="accountsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/accountsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="accountsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="accountsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>