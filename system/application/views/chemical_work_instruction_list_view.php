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
					target:        '#chemical_work_instructionlist',
					success: 		chemical_work_instructionshowResponse,
		}; 
		
		$('#chemical_work_instructionlistform').submit(function() { 
			$('#chemical_work_instructionlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function chemical_work_instructionconfirmdelete(delid, obj)
	{
		$('#chemical_work_instruction-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', chemical_work_instructionconfirmdelete2(delid, obj));
	}
	
	function chemical_work_instructionconfirmdelete2(delid, obj)
	{
		$( "#chemical_work_instruction-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					chemical_work_instructioncalldeletefn('chemical_work_instructiondelete', delid, 'chemical_work_instructionlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical_work_instruction-dialog-confirm').html('');
	}
	
	function chemical_work_instructionsortupdown(field, direction)
	{
		$("#chemical_work_instructioncurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#chemical_work_instructionlist',
					success: 		chemical_work_instructionshowResponse,
		}; 
		$('#chemical_work_instructionlistform').ajaxSubmit(options);
		return false;
	}
	
	function chemical_work_instructionshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#chemical_work_instructionlist',
					success: 		chemical_work_instructionshowResponse,
		}; 
		
		$('#chemical_work_instructionlistform').submit(function() { 
			$('#chemical_work_instructionlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function chemical_work_instructioncalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function chemical_work_instructionadd()
	{
		$('#chemical_work_instructionformholder').load('<?=site_url()."/chemical_work_instructionadd/";?>', function()
		{$('#chemical_work_instructionclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemical_work_instructionformholder' + '\').html(\'\');' + '$(\'' + '#chemical_work_instructionclosebutton' + '\').html(\'\');' + '$(\'' + '#chemical_work_instructionlist' + '\').load(\'<?=site_url();?>/chemical_work_instructionlist\');' + ';"></input>');
		});	
	}
	
	function chemical_work_instructionedit(id)
	{
		$('#chemical_work_instructionformholder').load('<?=site_url()."/chemical_work_instructionedit/index/";?>' + id, function()
		{$('#chemical_work_instructionclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemical_work_instructionformholder' + '\').html(\'\');' + '$(\'' + '#chemical_work_instructionclosebutton' + '\').html(\'\');' + '$(\'' + '#chemical_work_instructionlist' + '\').load(\'<?=site_url();?>/chemical_work_instructionlist\');' + ';"></input>');
		});	
	}
	
	function chemical_work_instructionview(id)
	{
		$('#chemical_work_instructionformholder').load('<?=site_url()."/chemical_work_instructionview/index/";?>' + id, function()
		{$('#chemical_work_instructionclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemical_work_instructionformholder' + '\').html(\'\');' + '$(\'' + '#chemical_work_instructionclosebutton' + '\').html(\'\');' + '$(\'' + '#chemical_work_instructionlist' + '\').load(\'<?=site_url();?>/chemical_work_instructionlist\');' + ';"></input>');
		});	
	}
	
	function chemical_work_instructiongotopage()
	{
		var page = document.chemical_work_instructionlistform.pageno.options[document.chemical_work_instructionlistform.pageno.selectedIndex].value;
		
		$("#chemical_work_instructioncurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#chemical_work_instructionlist',
					success: 		chemical_work_instructionshowResponse,
		}; 
		$('#chemical_work_instructionlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="chemical_work_instruction-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="chemical_work_instructionclosebutton"></div>
		<div id="chemical_work_instructionformholder"></div>
		<div id="chemical_work_instructionlist">
		<!--<form method="post" action="<?=site_url();?>/chemical_work_instructionlist/index/" id="chemical_work_instructionlistform" name="chemical_work_instructionlistform">-->
		<form method="post" action="<?=current_url();?>" id="chemical_work_instructionlistform" name="chemical_work_instructionlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="chemical_work_instructioncurrsort">
			</div>
			<div id="chemical_work_instructionsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="chemical_work_instructionadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/chemical_work_instructionadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/chemical_work_instructionadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="chemical_work_instructionsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="chemical_work_instructionsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="chemical_work_instructionsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="chemical_work_instructionsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/chemical_work_instructionview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('chemical_work_instructionview/index/'.$row['id'], $row['chemicalworkinstruction__idstring']);?></td><td><?=$row['chemicalworkinstruction__date'];?></td><td><?=$row['chemicalworkinstruction__name'];?></td><td><?=$row['chemicalworkinstruction__joborderno'];?></td><td><?=$row['chemicalworkinstruction__packing'];?></td><td><?=$row['chemicalworkinstruction__qtyliterkg'];?></td><td><?=$row['chemicalworkinstruction__notes'];?></td><td><?=$row['chemicalworkinstruction__lastupdate'];?></td><td><?=$row['chemicalworkinstruction__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="chemical_work_instructionview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/chemical_work_instructionview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="chemical_work_instructionedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/chemical_work_instructionedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="chemical_work_instructionconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="chemical_work_instructiongotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>