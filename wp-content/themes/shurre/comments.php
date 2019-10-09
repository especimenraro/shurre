<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shurre
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area row">

	<div class="col s8">

	<?php
	// You can start editing here -- including this comment!
	
	if ( have_comments() ) :
	
		?>
		
		<h5 class="comments-title">
		
			<?php
			
			$shurre_comment_count = get_comments_number();
			
			if ( '1' === $shurre_comment_count ) {
				
				printf(
				
					/* translators: 1: title. */
					
					esc_html__( 'Un Comentario en &ldquo;%1$s&rdquo;', 'shurre' ),
					
					'<span>' . get_the_title() . '</span>'
					
				);
				
			} else {
				
				?>
				
								
				
				<?php
				
				printf( // WPCS: XSS OK.
				
					/* translators: 1: comment count number, 2: title. */
					
					esc_html( _nx( '%1$s Comentario en &ldquo;%2$s&rdquo;', '%1$s Comentarios en &ldquo;%2$s&rdquo;',
					
					$shurre_comment_count, 'comments title', 'shurre' ) ),
					
					number_format_i18n( $shurre_comment_count ),
					
					'<span>' . get_the_title() . '</span>'
					
				);
				
				?>
				
				
				
				<?php
				
			}
			
			?>
			
		</h5><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
		
			<?php
			
			wp_list_comments( array(
			
				'style'      => 'ol',
				
				'short_ping' => true,
				
			) );
			
			?>
			
		</ol><!-- .comment-list -->

		<?php
		
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		
		if ( ! comments_open() ) :
		
			?>
			
			<p class="no-comments"><?php esc_html_e( 'No hay más comentarios.', 'shurre' ); ?></p>
			
			<?php
			
		endif;

	endif; // Check for have_comments().
	
	$comment_args = array(
	
		
	
	);

	comment_form();
	
	?>
	
	</div>

</div><!-- #comments -->
