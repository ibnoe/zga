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
					target:        '#permintaan_stock_chemicallist',
					success: 		permintaan_stock_chemicalshowResponse,
		}; 
		
		$('#permintaan_stock_chemicallistform').submit(function() { 
			$('#permintaan_stock_chemicallistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function permintaan_stock_chemicalconfirmdelete(delid, obj)
	{
		$('#permintaan_stock_chemical-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', permintaan_stock_chemicalconfirmdelete2(delid, obj));
	}
	
	function permintaan_stock_chemicalconfirmdelete2(delid, obj)
	{
		$( "#permintaan_stock_chemical-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					permintaan_stock_chemicalcalldeletefn('permintaan_stock_chemicaldelete', delid, 'permintaan_stock_chemicallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock_chemical-dialog-confirm').html('');
	}
	
	function permintaan_stock_chemicalsortupdown(field, direction)
	{
		$("#permintaan_stock_chemicalcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#permintaan_stock_chemicallist',
					success: 		permintaan_stock_chemicalshowResponse,
		}; 
		$('#permintaan_stock_chemicallistform').ajaxSubmit(options);
		return false;
	}
	
	function permintaan_stock_chemicalshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#permintaan_stock_chemicallist',
					success: 		permintaan_stock_chemicalshowResponse,
		}; 
		
		$('#permintaan_stock_chemicallistform').submit(function() { 
			$('#permintaan_stock_chemicallistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function permintaan_stock_chemicalcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function permintaan_stock_chemicaladd()
	{
		$('#permintaan_stock_chemicalformholder').load('<?=site_url()."/permintaan_stock_chemicaladd/";?>', function()
		{$('#permintaan_stock_chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stock_chemicalformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_chemicallist' + '\').load(\'<?=site_url();?>/permintaan_stock_chemicallist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stock_chemicaledit(id)
	{
		$('#permintaan_stock_chemicalformholder').load('<?=site_url()."/permintaan_stock_chemicaledit/index/";?>' + id, function()
		{$('#permintaan_stock_chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stock_chemicalformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_chemicallist' + '\').load(\'<?=site_url();?>/permintaan_stock_chemicallist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stock_chemicalview(id)
	{
		$('#permintaan_stock_chemicalformholder').load('<?=site_url()."/permintaan_stock_chemicalview/index/";?>' + id, function()
		{$('#permintaan_stock_chemicalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stock_chemicalformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_chemicalclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stock_chemicallist' + '\').load(\'<?=site_url();?>/permintaan_stock_chemicallist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stock_chemicalgotopage()
	{
		var page = document.permintaan_stock_chemicallistform.pageno.options[document.permintaan_stock_chemicallistform.pageno.selectedIndex].value;
		
		$("#permintaan_stock_chemicalcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#permintaan_stock_chemicallist',
					success: 		permintaan_stock_chemicalshowResponse,
		}; 
		$('#permintaan_stock_chemicallistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="permintaan_stock_chemical-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="permintaan_stock_chemicalclosebutton"></div>
		<div id="permintaan_stock_chemicalformholder"></div>
		<div id="permintaan_stock_chemicallist">
		<!--<form method="post" action="<?=site_url();?>/permintaan_stock_chemicallist/index/" id="permintaan_stock_chemicallistform" name="permintaan_stock_chemicallistform">-->
		<form method="post" action="<?=current_url();?>" id="permintaan_stock_chemicallistform" name="permintaan_stock_chemicallistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="permintaan_stock_chemicalcurrsort">
			</div>
			<div id="permintaan_stock_chemicalsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="permintaan_stock_chemicaladd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/permintaan_stock_chemicaladd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/permintaan_stock_chemicaladd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="permintaan_stock_chemicalsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="permintaan_stock_chemicalsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="permintaan_stock_chemicalsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="permintaan_stock_chemicalsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['permintaanstockchemical__idstring'];?></td><td><?=$row['permintaanstockchemical__date'];?></td><td><?=$row['permintaanstockchemical__notes'];?></td><td><?=$row['permintaanstockchemical__lastupdate'];?></td><td><?=$row['permintaanstockchemical__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="permintaan_stock_chemicalview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/permintaan_stock_chemicalview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="permintaan_stock_chemicaledit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/permintaan_stock_chemicaledit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="permintaan_stock_chemicalconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="permintaan_stock_chemicalgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>