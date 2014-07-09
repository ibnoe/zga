<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		/*
		$('a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		*/
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#filter_vacuumlist',
					success: 		filter_vacuumshowResponse,
		}; 
		
		$('#filter_vacuumlistform').submit(function() { 
			$('#filter_vacuumlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function filter_vacuumconfirmdelete(delid, obj)
	{
		$('#filter_vacuum-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', filter_vacuumconfirmdelete2(delid, obj));
	}
	
	function filter_vacuumconfirmdelete2(delid, obj)
	{
		$( "#filter_vacuum-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					filter_vacuumcalldeletefn('filter_vacuumdelete', delid, 'filter_vacuumlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#filter_vacuum-dialog-confirm').html('');
	}
	
	function filter_vacuumsortupdown(field, direction)
	{
		$("#filter_vacuumcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#filter_vacuumlist',
					success: 		filter_vacuumshowResponse,
		}; 
		$('#filter_vacuumlistform').ajaxSubmit(options);
		return false;
	}
	
	function filter_vacuumshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#filter_vacuumlist',
					success: 		filter_vacuumshowResponse,
		}; 
		
		$('#filter_vacuumlistform').submit(function() { 
			$('#filter_vacuumlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function filter_vacuumcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function filter_vacuumadd()
	{
		$('#filter_vacuumformholder').load('<?=site_url()."/filter_vacuumadd/";?>', function()
		{$('#filter_vacuumclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#filter_vacuumformholder' + '\').html(\'\');' + '$(\'' + '#filter_vacuumclosebutton' + '\').html(\'\');' + '$(\'' + '#filter_vacuumlist' + '\').load(\'<?=site_url();?>/filter_vacuumlist\');' + ';"></input>');
		});	
	}
	
	function filter_vacuumedit(id)
	{
		$('#filter_vacuumformholder').load('<?=site_url()."/filter_vacuumedit/index/";?>' + id, function()
		{$('#filter_vacuumclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#filter_vacuumformholder' + '\').html(\'\');' + '$(\'' + '#filter_vacuumclosebutton' + '\').html(\'\');' + '$(\'' + '#filter_vacuumlist' + '\').load(\'<?=site_url();?>/filter_vacuumlist\');' + ';"></input>');
		});	
	}
	
	function filter_vacuumview(id)
	{
		$('#filter_vacuumformholder').load('<?=site_url()."/filter_vacuumview/index/";?>' + id, function()
		{$('#filter_vacuumclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#filter_vacuumformholder' + '\').html(\'\');' + '$(\'' + '#filter_vacuumclosebutton' + '\').html(\'\');' + '$(\'' + '#filter_vacuumlist' + '\').load(\'<?=site_url();?>/filter_vacuumlist\');' + ';"></input>');
		});	
	}
	
	function filter_vacuumgotopage()
	{
		var page = document.filter_vacuumlistform.pageno.options[document.filter_vacuumlistform.pageno.selectedIndex].value;
		
		$("#filter_vacuumcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#filter_vacuumlist',
					success: 		filter_vacuumshowResponse,
		}; 
		$('#filter_vacuumlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="filter_vacuum-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="filter_vacuumclosebutton"></div>
		<div id="filter_vacuumformholder"></div>
		<div id="filter_vacuumlist">
		<form method="post" action="<?=site_url();?>/filter_vacuumlist/index/" id="filter_vacuumlistform" name="filter_vacuumlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="filter_vacuumcurrsort">
			</div>
			<div id="filter_vacuumsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="filter_vacuumadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/filter_vacuumadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/filter_vacuumadd/index/";?>')">
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
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="filter_vacuumsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="filter_vacuumsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="filter_vacuumsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="filter_vacuumsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['filtervacuum__name'];?></td><td><?=$row['filtervacuum__subcategory'];?></td><td><?=$row['filtervacuum__minquantity'];?></td><td><?=$row['filtervacuum__maxquantity'];?></td><td><?=$row['filtervacuum__buffer3months'];?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=$row['filtervacuum__purchaseable'];?></td><td><?=$row['filtervacuum__sellable'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="filter_vacuumview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/filter_vacuumview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="filter_vacuumedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/filter_vacuumedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="filter_vacuumconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="filter_vacuumgotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>