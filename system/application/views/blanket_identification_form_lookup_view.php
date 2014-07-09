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
					target:        '#blanket_identification_formlist',
					success: 		blanket_identification_formshowResponse,
		}; 
		
		$('#blanket_identification_formlistform').submit(function() { 
			$('#blanket_identification_formlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function blanket_identification_formconfirmdelete(delid, obj)
	{
		$('#blanket_identification_form-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', blanket_identification_formconfirmdelete2(delid, obj));
	}
	
	function blanket_identification_formconfirmdelete2(delid, obj)
	{
		$( "#blanket_identification_form-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					blanket_identification_formcalldeletefn('blanket_identification_formdelete', delid, 'blanket_identification_formlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket_identification_form-dialog-confirm').html('');
	}
	
	function blanket_identification_formsortupdown(field, direction)
	{
		$("#blanket_identification_formcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#blanket_identification_formlist',
					success: 		blanket_identification_formshowResponse,
		}; 
		$('#blanket_identification_formlistform').ajaxSubmit(options);
		return false;
	}
	
	function blanket_identification_formshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#blanket_identification_formlist',
					success: 		blanket_identification_formshowResponse,
		}; 
		
		$('#blanket_identification_formlistform').submit(function() { 
			$('#blanket_identification_formlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function blanket_identification_formcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function blanket_identification_formadd()
	{
		$('#blanket_identification_formformholder').load('<?=site_url()."/blanket_identification_formadd/";?>', function()
		{$('#blanket_identification_formclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_identification_formformholder' + '\').html(\'\');' + '$(\'' + '#blanket_identification_formclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_identification_formlist' + '\').load(\'<?=site_url();?>/blanket_identification_formlist\');' + ';"></input>');
		});	
	}
	
	function blanket_identification_formedit(id)
	{
		$('#blanket_identification_formformholder').load('<?=site_url()."/blanket_identification_formedit/index/";?>' + id, function()
		{$('#blanket_identification_formclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_identification_formformholder' + '\').html(\'\');' + '$(\'' + '#blanket_identification_formclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_identification_formlist' + '\').load(\'<?=site_url();?>/blanket_identification_formlist\');' + ';"></input>');
		});	
	}
	
	function blanket_identification_formview(id)
	{
		$('#blanket_identification_formformholder').load('<?=site_url()."/blanket_identification_formview/index/";?>' + id, function()
		{$('#blanket_identification_formclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanket_identification_formformholder' + '\').html(\'\');' + '$(\'' + '#blanket_identification_formclosebutton' + '\').html(\'\');' + '$(\'' + '#blanket_identification_formlist' + '\').load(\'<?=site_url();?>/blanket_identification_formlist\');' + ';"></input>');
		});	
	}
	
	function blanket_identification_formgotopage()
	{
		var page = document.blanket_identification_formlistform.pageno.options[document.blanket_identification_formlistform.pageno.selectedIndex].value;
		
		$("#blanket_identification_formcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#blanket_identification_formlist',
					success: 		blanket_identification_formshowResponse,
		}; 
		$('#blanket_identification_formlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="blanket_identification_form-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="blanket_identification_formclosebutton"></div>
		<div id="blanket_identification_formformholder"></div>
		<div id="blanket_identification_formlist">
		<!--<form method="post" action="<?=site_url();?>/blanket_identification_formlist/index/" id="blanket_identification_formlistform" name="blanket_identification_formlistform">-->
		<form method="post" action="<?=current_url();?>" id="blanket_identification_formlistform" name="blanket_identification_formlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="blanket_identification_formcurrsort">
			</div>
			<div id="blanket_identification_formsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="blanket_identification_formadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/blanket_identification_formadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/blanket_identification_formadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="blanket_identification_formsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="blanket_identification_formsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="blanket_identification_formsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="blanket_identification_formsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['bif__idstring'];?></td><td><?=$row['bif__date'];?></td><td><?php if (isset($row['bif__marketingofficer_id']) && $row['bif__marketingofficer_id'] > 0) echo $row['marketingofficer__name'];?></td><td><?php if (isset($row['bif__customer_id']) && $row['bif__customer_id'] > 0) echo $row['customer__firstname'];?></td><td><?=$row['bif__pressmodel'];?></td><td><?=$row['bif__ac'];?></td><td><?=$row['bif__ar'];?></td><td><?=$row['bif__thickness'];?></td><td><?=$row['bif__typebar1'];?></td><td><?=$row['bif__lengthbar1'];?></td><td><?=$row['bif__positionbar1'];?></td><td><?=$row['bif__typebar2'];?></td><td><?=$row['bif__lengthbar2'];?></td><td><?=$row['bif__positionbar2'];?></td><td><?=$row['bif__corner'];?></td><td><?=$row['bif__needs'];?></td><td><a href="<?=base_url().'/upload//'.$row['bif__drawingfile'];?>"> <?=$row['bif__drawingfile'];?></a></td><td><?=$row['bif__notes'];?></td><td><?=$row['bif__lastupdate'];?></td><td><?=$row['bif__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="blanket_identification_formview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/blanket_identification_formview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="blanket_identification_formedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/blanket_identification_formedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="blanket_identification_formconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="blanket_identification_formgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>