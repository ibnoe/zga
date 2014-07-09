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
					target:        '#penambahan_stock_chemicallist',
					success: 		penambahan_stock_chemicalshowResponse,
		}; 
		
		$('#penambahan_stock_chemicallistform').submit(function() { 
			$('#penambahan_stock_chemicallistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function penambahan_stock_chemicalconfirmdelete(delid, obj)
	{
		$('#penambahan_stock_chemical-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', penambahan_stock_chemicalconfirmdelete2(delid, obj));
	}
	
	function penambahan_stock_chemicalconfirmdelete2(delid, obj)
	{
		$( "#penambahan_stock_chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					penambahan_stock_chemicalcalldeletefn('penambahan_stock_chemicaldelete', delid, 'penambahan_stock_chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#penambahan_stock_chemical-dialog-confirm').html('');
	}
	
	function penambahan_stock_chemicalsortupdown(field, direction)
	{
		$("#penambahan_stock_chemicalcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#penambahan_stock_chemicallist',
					success: 		penambahan_stock_chemicalshowResponse,
		}; 
		$('#penambahan_stock_chemicallistform').ajaxSubmit(options);
		return false;
	}
	
	function penambahan_stock_chemicalshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#penambahan_stock_chemicallist',
					success: 		penambahan_stock_chemicalshowResponse,
		}; 
		
		$('#penambahan_stock_chemicallistform').submit(function() { 
			$('#penambahan_stock_chemicallistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function penambahan_stock_chemicalcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function penambahan_stock_chemicaladd()
	{
		$('#penambahan_stock_chemicalformholder').load('<?=site_url()."/penambahan_stock_chemicaladd/";?>', function()
		{$('#penambahan_stock_chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penambahan_stock_chemicalformholder' + '\').html(\'\');' + '$(\'' + '#penambahan_stock_chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#penambahan_stock_chemicallist' + '\').load(\'<?=site_url();?>/penambahan_stock_chemicallist\');' + ';"></input>');
		});	
	}
	
	function penambahan_stock_chemicaledit(id)
	{
		$('#penambahan_stock_chemicalformholder').load('<?=site_url()."/penambahan_stock_chemicaledit/index/";?>' + id, function()
		{$('#penambahan_stock_chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penambahan_stock_chemicalformholder' + '\').html(\'\');' + '$(\'' + '#penambahan_stock_chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#penambahan_stock_chemicallist' + '\').load(\'<?=site_url();?>/penambahan_stock_chemicallist\');' + ';"></input>');
		});	
	}
	
	function penambahan_stock_chemicalview(id)
	{
		$('#penambahan_stock_chemicalformholder').load('<?=site_url()."/penambahan_stock_chemicalview/index/";?>' + id, function()
		{$('#penambahan_stock_chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#penambahan_stock_chemicalformholder' + '\').html(\'\');' + '$(\'' + '#penambahan_stock_chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#penambahan_stock_chemicallist' + '\').load(\'<?=site_url();?>/penambahan_stock_chemicallist\');' + ';"></input>');
		});	
	}
	
	function penambahan_stock_chemicalgotopage()
	{
		var page = document.penambahan_stock_chemicallistform.pageno.options[document.penambahan_stock_chemicallistform.pageno.selectedIndex].value;
		
		$("#penambahan_stock_chemicalcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#penambahan_stock_chemicallist',
					success: 		penambahan_stock_chemicalshowResponse,
		}; 
		$('#penambahan_stock_chemicallistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="penambahan_stock_chemical-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="penambahan_stock_chemicalclosebutton"></div>
		<div id="penambahan_stock_chemicalformholder"></div>
		<div id="penambahan_stock_chemicallist">
		<!--<form method="post" action="<?=site_url();?>/penambahan_stock_chemicallist/index/" id="penambahan_stock_chemicallistform" name="penambahan_stock_chemicallistform">-->
		<form method="post" action="<?=current_url();?>" id="penambahan_stock_chemicallistform" name="penambahan_stock_chemicallistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="penambahan_stock_chemicalcurrsort">
			</div>
			<div id="penambahan_stock_chemicalsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="penambahan_stock_chemicaladd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penambahan_stock_chemicaladd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/penambahan_stock_chemicaladd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="penambahan_stock_chemicalsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="penambahan_stock_chemicalsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="penambahan_stock_chemicalsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="penambahan_stock_chemicalsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['penambahanstockchemical__idstring'];?></td><td><?=$row['penambahanstockchemical__date'];?></td><td><?=$row['penambahanstockchemical__name'];?></td><td><?=$row['penambahanstockchemical__joborderno'];?></td><td><?=$row['penambahanstockchemical__batchno'];?></td><td><?=$row['penambahanstockchemical__packing'];?></td><td><?=$row['penambahanstockchemical__qtyliterkg'];?></td><td><?=$row['penambahanstockchemical__notes'];?></td><td><?=$row['penambahanstockchemical__lastupdate'];?></td><td><?=$row['penambahanstockchemical__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="penambahan_stock_chemicalview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/penambahan_stock_chemicalview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="penambahan_stock_chemicaledit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/penambahan_stock_chemicaledit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="penambahan_stock_chemicalconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="penambahan_stock_chemicalgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>