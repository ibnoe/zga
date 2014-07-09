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
					target:        '#sales_returnlist',
					success: 		sales_returnshowResponse,
		}; 
		
		$('#sales_returnlistform').submit(function() { 
			$('#sales_returnlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_returnconfirmdelete(delid, obj)
	{
		$('#sales_return-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_returnconfirmdelete2(delid, obj));
	}
	
	function sales_returnconfirmdelete2(delid, obj)
	{
		$( "#sales_return-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_returncalldeletefn('sales_returndelete', delid, 'sales_returnlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return-dialog-confirm').html('');
	}
	
	function sales_returnsortupdown(field, direction)
	{
		$("#sales_returncurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_returnlist',
					success: 		sales_returnshowResponse,
		}; 
		$('#sales_returnlistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_returnshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_returnlist',
					success: 		sales_returnshowResponse,
		}; 
		
		$('#sales_returnlistform').submit(function() { 
			$('#sales_returnlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_returncalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_returnadd()
	{
		$('#sales_returnformholder').load('<?=site_url()."/sales_returnadd/";?>', function()
		{$('#sales_returnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_returnformholder' + '\').html(\'\');' + '$(\'' + '#sales_returnclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_returnlist' + '\').load(\'<?=site_url();?>/sales_returnlist\');' + ';"></input>');
		});	
	}
	
	function sales_returnedit(id)
	{
		$('#sales_returnformholder').load('<?=site_url()."/sales_returnedit/index/";?>' + id, function()
		{$('#sales_returnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_returnformholder' + '\').html(\'\');' + '$(\'' + '#sales_returnclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_returnlist' + '\').load(\'<?=site_url();?>/sales_returnlist\');' + ';"></input>');
		});	
	}
	
	function sales_returnview(id)
	{
		$('#sales_returnformholder').load('<?=site_url()."/sales_returnview/index/";?>' + id, function()
		{$('#sales_returnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_returnformholder' + '\').html(\'\');' + '$(\'' + '#sales_returnclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_returnlist' + '\').load(\'<?=site_url();?>/sales_returnlist\');' + ';"></input>');
		});	
	}
	
	function sales_returngotopage()
	{
		var page = document.sales_returnlistform.pageno.options[document.sales_returnlistform.pageno.selectedIndex].value;
		
		$("#sales_returncurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_returnlist',
					success: 		sales_returnshowResponse,
		}; 
		$('#sales_returnlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="sales_return-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_returnclosebutton"></div>
		<div id="sales_returnformholder"></div>
		<div id="sales_returnlist">
		<form method="post" action="<?=site_url();?>/sales_returnlist/index/" id="sales_returnlistform" name="sales_returnlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_returncurrsort">
			</div>
			<div id="sales_returnsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sales_returnadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_returnadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_returnadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_returnsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_returnsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_returnsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_returnsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['sreturn__orderid'];?></td><td><?=$row['sreturn__date'];?></td><td><?=anchor('sales_orderview/index/'.$row['id'], $row['sorder__orderid']);?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['sreturn__orderid'];?></td><td><?=$row['sreturn__date'];?></td><td><?=anchor('sales_orderview/index/'.$row['id'], $row['sorder__orderid']);?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['sreturn__'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_returnview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_returnview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_returnedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_returnedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_returnconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_returngotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>