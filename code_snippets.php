//Sidebar snippets

function wp_register_widgets() {

	register_sidebar( array(
	'name' => 'Footer Sidebar links',
	'id' => 'footer-sidebar-1',
	'description' => 'Wird im Footer links angezeigt',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<strong>',
	'after_title' => '</strong>',
	) );
	register_sidebar( array(
	'name' => 'Footer Sidebar mitte',
	'id' => 'footer-sidebar-2',
	'description' => 'Wird im Footer in der Mitte angezeigt',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<strong>',
	'after_title' => '</strong>',
	) );
	register_sidebar( array(
	'name' => 'Footer Sidebar rechts',
	'id' => 'footer-sidebar-3',
	'description' => 'Wird im Footer rechts angezeigt',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<strong>',
	'after_title' => '</strong>',
	) );

}

//Bootstrap carousel with CPT

add_action("widgets_init", "wp_register_widgets");

	function display_bootstrap_slider() {
	$args = array(
		'post_type' => 'slider-photo'
	);

	$loop = new WP_Query($args);
	$images = array();

	while ($loop->have_posts()) {
		$loop->the_post();

		$images[] = array(
			'title' => get_the_title(),
			'image' => types_render_field('foto', array("output"=>"raw"))
		);
	}

	if (count($images) > 0) {
		ob_start();
		?>
		<div id="bootstrap-carousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
			<?php foreach ($images as $key => $image) : ?>
				<li data-target="#bootstrap-carousel" data-slide-to="<?= $key; ?>" <?= $key == 0 ? 'class="active"' : ''; ?>></li>
			<?php endforeach; ?>
			</ol>

			<div class="carousel-inner">
			<?php foreach ($images as $key => $image) : ?>
				<div class="item <?php echo $key == 0 ? 'active' : ''; ?>">
					<img src="<?php echo $image['image']; ?>" alt="<?php echo $image['title']; ?>">
					<div class="carousel-caption">
						<p></p>
					</div>
				</div>
			<?php endforeach; ?>
			</div>

			<a class="left carousel-control" href="#bootstrap-carousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#bootstrap-carousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
<?php
	}
	
	$output = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
	
	return $output;
}

//Add .active to active menu item
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
   	}
   	return $classes;
}

//CSS comment

/*
Theme Name: Twenty Fifteen
Theme URI: https://wordpress.org/themes/twentyfifteen/
Author: the WordPress team
Author URI: https://wordpress.org/
Description: Our 2015 default theme is clean, blog-focused, and designed for clarity. Twenty Fifteen's simple, straightforward typography is readable on a wide variety of screen sizes, and suitable for multiple languages. We designed it using a mobile-first approach, meaning your content takes center-stage, regardless of whether your visitors arrive by smartphone, tablet, laptop, or desktop computer.
Version: 1.2
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: black, blue, gray, pink, purple, white, yellow, dark, light, two-columns, left-sidebar, fixed-layout, responsive-layout, accessibility-ready, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, microformats, post-formats, rtl-language-support, sticky-post, threaded-comments, translation-ready
Text Domain: twentyfifteen

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/