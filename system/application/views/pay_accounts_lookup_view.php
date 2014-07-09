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
					target:        '#pay_accountslist',
					success: 		pay_accountsshowResponse,
		}; 
		
		$('#pay_accountslistform').submit(function() { 
			$('#pay_accountslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function pay_accountsconfirmdelete(delid, obj)
	{
		$('#pay_accounts-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', pay_accountsconfirmdelete2(delid, obj));
	}
	
	function pay_accountsconfirmdelete2(delid, obj)
	{
		$( "#pay_accounts-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					pay_accountscalldeletefn('pay_accountsdelete', delid, 'pay_accountslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#pay_accounts-dialog-confirm').html('');
	}
	
	function pay_accountssortupdown(field, direction)
	{
		$("#pay_accountscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#pay_accountslist',
					success: 		pay_accountsshowResponse,
		}; 
		$('#pay_accountslistform').ajaxSubmit(options);
		return false;
	}
	
	function pay_accountsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#pay_accountslist',
					success: 		pay_accountsshowResponse,
		}; 
		
		$('#pay_accountslistform').submit(function() { 
			$('#pay_accountslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function pay_accountscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function pay_accountsadd()
	{
		$('#pay_accountsformholder').load('<?=site_url()."/pay_accountsadd/";?>', function()
		{$('#pay_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#pay_accountsformholder' + '\').html(\'\');' + '$(\'' + '#pay_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#pay_accountslist' + '\').load(\'<?=site_url();?>/pay_accountslist\');' + ';"></input>');
		});	
	}
	
	function pay_accountsedit(id)
	{
		$('#pay_accountsformholder').load('<?=site_url()."/pay_accountsedit/index/";?>' + id, function()
		{$('#pay_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#pay_accountsformholder' + '\').html(\'\');' + '$(\'' + '#pay_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#pay_accountslist' + '\').load(\'<?=site_url();?>/pay_accountslist\');' + ';"></input>');
		});	
	}
	
	function pay_accountsview(id)
	{
		$('#pay_accountsformholder').load('<?=site_url()."/pay_accountsview/index/";?>' + id, function()
		{$('#pay_accountsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#pay_accountsformholder' + '\').html(\'\');' + '$(\'' + '#pay_accountsclosebutton' + '\').html(\'\');' + '$(\'' + '#pay_accountslist' + '\').load(\'<?=site_url();?>/pay_accountslist\');' + ';"></input>');
		});	
	}
	
	function pay_accountsgotopage()
	{
		var page = document.pay_accountslistform.pageno.options[document.pay_accountslistform.pageno.selectedIndex].value;
		
		$("#pay_accountscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#pay_accountslist',
					success: 		pay_accountsshowResponse,
		}; 
		$('#pay_accountslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="pay_accounts-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="pay_accountsclosebutton"></div>
		<div id="pay_accountsformholder"></div>
		<div id="pay_accountslist">
		<!--<form method="post" action="<?=site_url();?>/pay_accountslist/index/" id="pay_accountslistform" name="pay_accountslistform">-->
		<form method="post" action="<?=current_url();?>" id="pay_accountslistform" name="pay_accountslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="pay_accountscurrsort">
			</div>
			<div id="pay_accountssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="pay_accountsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/pay_accountsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/pay_accountsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="pay_accountssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="pay_accountssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="pay_accountssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="pay_accountssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
						<!--<td class="view"><input class="button" type="button" value="View" onclick="pay_accountsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/pay_accountsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="pay_accountsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/pay_accountsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="pay_accountsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="pay_accountsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>