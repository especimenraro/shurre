<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shurre
 */

?>

<section class="no-results not-found">

	<header class="page-header">
	
		<h1 class="page-title"><?php esc_html_e( 'No Encotramos Nada! ', 'shurre' ); ?></h1>
		
	</header><!-- .page-header -->

	<div class="page-content">
	
		<?php
		
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Listo para publicar tu receta? <a href="%1$s">Comienza Aquí</a>.', 'shurre' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Lo siento, no hubo coincidencias con su búsqueda. Prueba con otras palabras.', 'shurre' ); ?></p>
			
			<?php
			

		else :
		
			?>

			<p><?php esc_html_e( 'Lo siento, no hubo coincidencias con su búsqueda. Prueba con otras palabras.', 'shurre' ); ?></p>
			
			<?php
			
		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
