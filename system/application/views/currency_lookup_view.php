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
					target:        '#currencylist',
					success: 		currencyshowResponse,
		}; 
		
		$('#currencylistform').submit(function() { 
			$('#currencylistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function currencyconfirmdelete(delid, obj)
	{
		$('#currency-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', currencyconfirmdelete2(delid, obj));
	}
	
	function currencyconfirmdelete2(delid, obj)
	{
		$( "#currency-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					currencycalldeletefn('currencydelete', delid, 'currencylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#currency-dialog-confirm').html('');
	}
	
	function currencysortupdown(field, direction)
	{
		$("#currencycurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#currencylist',
					success: 		currencyshowResponse,
		}; 
		$('#currencylistform').ajaxSubmit(options);
		return false;
	}
	
	function currencyshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#currencylist',
					success: 		currencyshowResponse,
		}; 
		
		$('#currencylistform').submit(function() { 
			$('#currencylistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function currencycalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function currencyadd()
	{
		$('#currencyformholder').load('<?=site_url()."/currencyadd/";?>', function()
		{$('#currencyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#currencyformholder' + '\').html(\'\');' + '$(\'' + '#currencyclosebutton' + '\').html(\'\');' + '$(\'' + '#currencylist' + '\').load(\'<?=site_url();?>/currencylist\');' + ';"></input>');
		});	
	}
	
	function currencyedit(id)
	{
		$('#currencyformholder').load('<?=site_url()."/currencyedit/index/";?>' + id, function()
		{$('#currencyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#currencyformholder' + '\').html(\'\');' + '$(\'' + '#currencyclosebutton' + '\').html(\'\');' + '$(\'' + '#currencylist' + '\').load(\'<?=site_url();?>/currencylist\');' + ';"></input>');
		});	
	}
	
	function currencyview(id)
	{
		$('#currencyformholder').load('<?=site_url()."/currencyview/index/";?>' + id, function()
		{$('#currencyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#currencyformholder' + '\').html(\'\');' + '$(\'' + '#currencyclosebutton' + '\').html(\'\');' + '$(\'' + '#currencylist' + '\').load(\'<?=site_url();?>/currencylist\');' + ';"></input>');
		});	
	}
	
	function currencygotopage()
	{
		var page = document.currencylistform.pageno.options[document.currencylistform.pageno.selectedIndex].value;
		
		$("#currencycurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#currencylist',
					success: 		currencyshowResponse,
		}; 
		$('#currencylistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="currency-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="currencyclosebutton"></div>
		<div id="currencyformholder"></div>
		<div id="currencylist">
		<!--<form method="post" action="<?=site_url();?>/currencylist/index/" id="currencylistform" name="currencylistform">-->
		<form method="post" action="<?=current_url();?>" id="currencylistform" name="currencylistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="currencycurrsort">
			</div>
			<div id="currencysort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="currencyadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/currencyadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/currencyadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="currencysortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="currencysortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="currencysortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="currencysortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['currency__idstring'];?></td><td><?=$row['currency__name'];?></td><td align='right'><?=number_format($row['currency__rate'], 2);?></td><td><?=$row['currency__lastupdate'];?></td><td><?=$row['currency__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="currencyview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/currencyview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="currencyedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/currencyedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="currencyconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="currencygotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>