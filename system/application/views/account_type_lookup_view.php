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
					target:        '#account_typelist',
					success: 		account_typeshowResponse,
		}; 
		
		$('#account_typelistform').submit(function() { 
			$('#account_typelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function account_typeconfirmdelete(delid, obj)
	{
		$('#account_type-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', account_typeconfirmdelete2(delid, obj));
	}
	
	function account_typeconfirmdelete2(delid, obj)
	{
		$( "#account_type-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					account_typecalldeletefn('account_typedelete', delid, 'account_typelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#account_type-dialog-confirm').html('');
	}
	
	function account_typesortupdown(field, direction)
	{
		$("#account_typecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#account_typelist',
					success: 		account_typeshowResponse,
		}; 
		$('#account_typelistform').ajaxSubmit(options);
		return false;
	}
	
	function account_typeshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#account_typelist',
					success: 		account_typeshowResponse,
		}; 
		
		$('#account_typelistform').submit(function() { 
			$('#account_typelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function account_typecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function account_typeadd()
	{
		$('#account_typeformholder').load('<?=site_url()."/account_typeadd/";?>', function()
		{$('#account_typeclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#account_typeformholder' + '\').html(\'\');' + '$(\'' + '#account_typeclosebutton' + '\').html(\'\');' + '$(\'' + '#account_typelist' + '\').load(\'<?=site_url();?>/account_typelist\');' + ';"></input>');
		});	
	}
	
	function account_typeedit(id)
	{
		$('#account_typeformholder').load('<?=site_url()."/account_typeedit/index/";?>' + id, function()
		{$('#account_typeclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#account_typeformholder' + '\').html(\'\');' + '$(\'' + '#account_typeclosebutton' + '\').html(\'\');' + '$(\'' + '#account_typelist' + '\').load(\'<?=site_url();?>/account_typelist\');' + ';"></input>');
		});	
	}
	
	function account_typeview(id)
	{
		$('#account_typeformholder').load('<?=site_url()."/account_typeview/index/";?>' + id, function()
		{$('#account_typeclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#account_typeformholder' + '\').html(\'\');' + '$(\'' + '#account_typeclosebutton' + '\').html(\'\');' + '$(\'' + '#account_typelist' + '\').load(\'<?=site_url();?>/account_typelist\');' + ';"></input>');
		});	
	}
	
	function account_typegotopage()
	{
		var page = document.account_typelistform.pageno.options[document.account_typelistform.pageno.selectedIndex].value;
		
		$("#account_typecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#account_typelist',
					success: 		account_typeshowResponse,
		}; 
		$('#account_typelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="account_type-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="account_typeclosebutton"></div>
		<div id="account_typeformholder"></div>
		<div id="account_typelist">
		<!--<form method="post" action="<?=site_url();?>/account_typelist/index/" id="account_typelistform" name="account_typelistform">-->
		<form method="post" action="<?=current_url();?>" id="account_typelistform" name="account_typelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="account_typecurrsort">
			</div>
			<div id="account_typesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="account_typeadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/account_typeadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/account_typeadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="account_typesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="account_typesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="account_typesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="account_typesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['coatype__classtype'];?></td><td><?=$row['coatype__name'];?></td><td><?=$row['coatype__lastupdate'];?></td><td><?=$row['coatype__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="account_typeview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/account_typeview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="account_typeedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/account_typeedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="account_typeconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="account_typegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>