<style type='text/css'>
	#gallery-<?=$instance?> {
		margin: auto;
	}
	#gallery-<?=$instance?> .gallery-item {
		float: left;
		margin-top: 10px;
		text-align: center;
		width: 33%;
	}
	#gallery-<?=$instance?> img {
		border: 2px solid #cfcfcf;
	}
	#gallery-<?=$instance?> .gallery-caption {
		margin-left: 0;
	}
</style>

<div id='gallery-<?=$instance?>' class='gallery galleryid-<?=$gallery_atts['id']?> gallery-columns-3 gallery-size-thumbnail'>
	<?php foreach($images as $image) { ?>
	<dl class='gallery-item'>
		<dt class='gallery-icon landscape'>
			<a href='#'><img width="150" height="150" data-width="<?=$image->guid_dimensions[0]?>" data-height="<?=$image->guid_dimensions[1]?>" src="<?=$image->thumbnail?>" data-full-image="<?=$image->guid?>" class="attachment-thumbnail" alt="Test image" aria-describedby="gallery-<?=$instance?>-<?=$image->ID?>" /></a>
		</dt>
		<dd class='wp-caption-text gallery-caption' id='gallery-<?=$instance?>-<?=$image->ID?>'>
		<?=$image->post_excerpt?>
		</dd>
	</dl>
	<?php } ?>
	<br style='clear: both' />
</div>