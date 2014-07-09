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
					target:        '#contact_personlist',
					success: 		contact_personshowResponse,
		}; 
		
		$('#contact_personlistform').submit(function() { 
			$('#contact_personlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function contact_personconfirmdelete(delid, obj)
	{
		$('#contact_person-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', contact_personconfirmdelete2(delid, obj));
	}
	
	function contact_personconfirmdelete2(delid, obj)
	{
		$( "#contact_person-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					contact_personcalldeletefn('contact_persondelete', delid, 'contact_personlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#contact_person-dialog-confirm').html('');
	}
	
	function contact_personsortupdown(field, direction)
	{
		$("#contact_personcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#contact_personlist',
					success: 		contact_personshowResponse,
		}; 
		$('#contact_personlistform').ajaxSubmit(options);
		return false;
	}
	
	function contact_personshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#contact_personlist',
					success: 		contact_personshowResponse,
		}; 
		
		$('#contact_personlistform').submit(function() { 
			$('#contact_personlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function contact_personcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function contact_personadd()
	{
		$('#contact_personformholder').load('<?=site_url()."/contact_personadd/";?>', function()
		{$('#contact_personclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#contact_personformholder' + '\').html(\'\');' + '$(\'' + '#contact_personclosebutton' + '\').html(\'\');' + '$(\'' + '#contact_personlist' + '\').load(\'<?=site_url();?>/contact_personlist\');' + ';"></input>');
		});	
	}
	
	function contact_personedit(id)
	{
		$('#contact_personformholder').load('<?=site_url()."/contact_personedit/index/";?>' + id, function()
		{$('#contact_personclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#contact_personformholder' + '\').html(\'\');' + '$(\'' + '#contact_personclosebutton' + '\').html(\'\');' + '$(\'' + '#contact_personlist' + '\').load(\'<?=site_url();?>/contact_personlist\');' + ';"></input>');
		});	
	}
	
	function contact_personview(id)
	{
		$('#contact_personformholder').load('<?=site_url()."/contact_personview/index/";?>' + id, function()
		{$('#contact_personclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#contact_personformholder' + '\').html(\'\');' + '$(\'' + '#contact_personclosebutton' + '\').html(\'\');' + '$(\'' + '#contact_personlist' + '\').load(\'<?=site_url();?>/contact_personlist\');' + ';"></input>');
		});	
	}
	
	function contact_persongotopage()
	{
		var page = document.contact_personlistform.pageno.options[document.contact_personlistform.pageno.selectedIndex].value;
		
		$("#contact_personcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#contact_personlist',
					success: 		contact_personshowResponse,
		}; 
		$('#contact_personlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="contact_person-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="contact_personclosebutton"></div>
		<div id="contact_personformholder"></div>
		<div id="contact_personlist">
		<!--<form method="post" action="<?=site_url();?>/contact_personlist/index/" id="contact_personlistform" name="contact_personlistform">-->
		<form method="post" action="<?=current_url();?>" id="contact_personlistform" name="contact_personlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="contact_personcurrsort">
			</div>
			<div id="contact_personsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="contact_personadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/contact_personadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/contact_personadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="contact_personsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="contact_personsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="contact_personsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="contact_personsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/contact_personview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('contact_personview/index/'.$row['id'], $row['contactperson__idstring']);?></td><td><?=$row['contactperson__name'];?></td><td><?=$row['contactperson__position'];?></td><td><?=$row['contactperson__address'];?></td><td><?=$row['contactperson__phone'];?></td><td><?=$row['contactperson__fax'];?></td><td><?=$row['contactperson__mobile'];?></td><td><?=$row['contactperson__email'];?></td><td><?=$row['contactperson__bank'];?></td><td><?=$row['contactperson__bankaccno'];?></td><td><?=$row['contactperson__bankbranch'];?></td><td><?=$row['contactperson__status'];?></td><td><?=$row['contactperson__dob'];?></td><td><?=$row['contactperson__children'];?></td><td><?=$row['contactperson__lastupdate'];?></td><td><?=$row['contactperson__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="contact_personview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/contact_personview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="contact_personedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/contact_personedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="contact_personconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="contact_persongotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>