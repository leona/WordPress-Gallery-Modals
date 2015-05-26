<?php
/**
 * Load plugin javascript
 */
add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('fusio-modal-styles', modal_dir_uri . '/css/fusio-gallery.css');
	wp_enqueue_script('fusio-jquery', modal_dir_uri . 'js/jquery.min.js', null, null, true);
	wp_enqueue_script('fusio-gallery', modal_dir_uri . 'js/fusio-gallery.js', null, null, true);
});

add_action('wp_footer', function() {
	include(modal_dir . '/modal_template.php');
});


add_filter('post_gallery', function($output, $attr) {
	global $post;
	static $instance = 0;
    $instance++;

    $gallery_atts = shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr);

    $include = preg_replace( '/[^0-9,]+/', '', $gallery_atts['include'] );
    $images = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $gallery_atts['order'], 'orderby' => $gallery_atts['orderby']) );

	foreach($images as $key => $image) {
		$image_src = wp_get_attachment_image_src($image->ID, 'full');

		$images[$key]->guid_dimensions = array($image_src[1], $image_src[2]);
		$images[$key]->thumbnail = wp_get_attachment_image_src($image->ID, array(150, 150))[0];
	}

	ob_start();
	include('gallery_template.php');

	$output = ob_get_clean();

	return $output;
}, 10, 2);
