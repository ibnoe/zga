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
					target:        '#cash_banklist',
					success: 		cash_bankshowResponse,
		}; 
		
		$('#cash_banklistform').submit(function() { 
			$('#cash_banklistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function cash_bankconfirmdelete(delid, obj)
	{
		$('#cash_bank-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cash_bankconfirmdelete2(delid, obj));
	}
	
	function cash_bankconfirmdelete2(delid, obj)
	{
		$( "#cash_bank-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cash_bankcalldeletefn('cash_bankdelete', delid, 'cash_banklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cash_bank-dialog-confirm').html('');
	}
	
	function cash_banksortupdown(field, direction)
	{
		$("#cash_bankcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#cash_banklist',
					success: 		cash_bankshowResponse,
		}; 
		$('#cash_banklistform').ajaxSubmit(options);
		return false;
	}
	
	function cash_bankshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#cash_banklist',
					success: 		cash_bankshowResponse,
		}; 
		
		$('#cash_banklistform').submit(function() { 
			$('#cash_banklistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function cash_bankcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function cash_bankadd()
	{
		$('#cash_bankformholder').load('<?=site_url()."/cash_bankadd/";?>', function()
		{$('#cash_bankclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cash_bankformholder' + '\').html(\'\');' + '$(\'' + '#cash_bankclosebutton' + '\').html(\'\');' + '$(\'' + '#cash_banklist' + '\').load(\'<?=site_url();?>/cash_banklist\');' + ';"></input>');
		});	
	}
	
	function cash_bankedit(id)
	{
		$('#cash_bankformholder').load('<?=site_url()."/cash_bankedit/index/";?>' + id, function()
		{$('#cash_bankclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cash_bankformholder' + '\').html(\'\');' + '$(\'' + '#cash_bankclosebutton' + '\').html(\'\');' + '$(\'' + '#cash_banklist' + '\').load(\'<?=site_url();?>/cash_banklist\');' + ';"></input>');
		});	
	}
	
	function cash_bankview(id)
	{
		$('#cash_bankformholder').load('<?=site_url()."/cash_bankview/index/";?>' + id, function()
		{$('#cash_bankclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cash_bankformholder' + '\').html(\'\');' + '$(\'' + '#cash_bankclosebutton' + '\').html(\'\');' + '$(\'' + '#cash_banklist' + '\').load(\'<?=site_url();?>/cash_banklist\');' + ';"></input>');
		});	
	}
	
	function cash_bankgotopage()
	{
		var page = document.cash_banklistform.pageno.options[document.cash_banklistform.pageno.selectedIndex].value;
		
		$("#cash_bankcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#cash_banklist',
					success: 		cash_bankshowResponse,
		}; 
		$('#cash_banklistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="cash_bank-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="cash_bankclosebutton"></div>
		<div id="cash_bankformholder"></div>
		<div id="cash_banklist">
		<!--<form method="post" action="<?=site_url();?>/cash_banklist/index/" id="cash_banklistform" name="cash_banklistform">-->
		<form method="post" action="<?=current_url();?>" id="cash_banklistform" name="cash_banklistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="cash_bankcurrsort">
			</div>
			<div id="cash_banksort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="cash_bankadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cash_bankadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cash_bankadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="cash_banksortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="cash_banksortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="cash_banksortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="cash_banksortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/cash_bankview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('cash_bankview/index/'.$row['id'], $row['cashbank__name']);?></td><td><?php if (isset($row['cashbank__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['cashbank__currency_id'], $row['currency__name']);?></td><td><?php if (isset($row['cashbank__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['cashbank__coa_id'], $row['coa__name']);?></td><td><?=$row['cashbank__notes'];?></td><td><?=$row['cashbank__lastupdate'];?></td><td><?=$row['cashbank__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="cash_bankview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/cash_bankview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="cash_bankedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cash_bankedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="cash_bankconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="cash_bankgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>