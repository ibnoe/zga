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
					target:        '#chemicallist',
					success: 		chemicalshowResponse,
		}; 
		
		$('#chemicallistform').submit(function() { 
			$('#chemicallistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function chemicalconfirmdelete(delid, obj)
	{
		$('#chemical-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', chemicalconfirmdelete2(delid, obj));
	}
	
	function chemicalconfirmdelete2(delid, obj)
	{
		$( "#chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					chemicalcalldeletefn('chemicaldelete', delid, 'chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical-dialog-confirm').html('');
	}
	
	function chemicalsortupdown(field, direction)
	{
		$("#chemicalcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#chemicallist',
					success: 		chemicalshowResponse,
		}; 
		$('#chemicallistform').ajaxSubmit(options);
		return false;
	}
	
	function chemicalshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#chemicallist',
					success: 		chemicalshowResponse,
		}; 
		
		$('#chemicallistform').submit(function() { 
			$('#chemicallistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function chemicalcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function chemicaladd()
	{
		$('#chemicalformholder').load('<?=site_url()."/chemicaladd/";?>', function()
		{$('#chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemicalformholder' + '\').html(\'\');' + '$(\'' + '#chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#chemicallist' + '\').load(\'<?=site_url();?>/chemicallist\');' + ';"></input>');
		});	
	}
	
	function chemicaledit(id)
	{
		$('#chemicalformholder').load('<?=site_url()."/chemicaledit/index/";?>' + id, function()
		{$('#chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemicalformholder' + '\').html(\'\');' + '$(\'' + '#chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#chemicallist' + '\').load(\'<?=site_url();?>/chemicallist\');' + ';"></input>');
		});	
	}
	
	function chemicalview(id)
	{
		$('#chemicalformholder').load('<?=site_url()."/chemicalview/index/";?>' + id, function()
		{$('#chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemicalformholder' + '\').html(\'\');' + '$(\'' + '#chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#chemicallist' + '\').load(\'<?=site_url();?>/chemicallist\');' + ';"></input>');
		});	
	}
	
	function chemicalgotopage()
	{
		var page = document.chemicallistform.pageno.options[document.chemicallistform.pageno.selectedIndex].value;
		
		$("#chemicalcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#chemicallist',
					success: 		chemicalshowResponse,
		}; 
		$('#chemicallistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="chemical-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="chemicalclosebutton"></div>
		<div id="chemicalformholder"></div>
		<div id="chemicallist">
		<!--<form method="post" action="<?=site_url();?>/chemicallist/index/" id="chemicallistform" name="chemicallistform">-->
		<form method="post" action="<?=current_url();?>" id="chemicallistform" name="chemicallistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="chemicalcurrsort">
			</div>
			<div id="chemicalsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="chemicaladd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/chemicaladd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/chemicaladd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="chemicalsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="chemicalsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="chemicalsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="chemicalsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['item__idstring'];?></td><td><?=$row['item__name'];?></td><td><?=$row['item__chemicalcode'];?></td><td><?=$row['item__chemicaltype'];?></td><td><?=$row['item__packingsize'];?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['item__itemcategory_id'] > 0) echo $row['itemcategory__name'];?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="chemicalview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/chemicalview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="chemicaledit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/chemicaledit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="chemicalconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="chemicalgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>