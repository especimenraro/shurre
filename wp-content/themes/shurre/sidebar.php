<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shurre
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area hide-on-small-only hide-on-med-only">

	<div class="col s3">
	
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	
	</div>			
		

</aside><!-- #secondary -->
