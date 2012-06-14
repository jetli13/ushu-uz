<?
	$link = '/publication/view/' . $data->id . '.html'
?>
	<li class="items">
	<h2><? echo $data->ru_title ?></h2>
	<p><a href="<?=$link?>">
			<? 
				$TEXT_LIMIT = 50;
				print Publication::getPreview($data->ru_text, $TEXT_LIMIT); 
			?>
			</a>
		<div class="clear"></div>
	</p>
	</li>
