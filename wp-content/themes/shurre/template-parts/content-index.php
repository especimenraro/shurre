<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shurre
 */

get_header();
?>

	<div id="primary" class="content-area">
	
		<main id="main" class="site-main">

		<?php
		
		
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
				
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					
				</header>
				<?php
			endif;
			
			?>
			
			<div class="row ">
			
			<div class="col s1 offset-s2 ">
			
				<a class="btn-floating btn-large red modal-trigger" href="#agrega-post"><i class="material-icons">add</i></a>
			
			</div>
			
			<div class="modal" id="agrega-post">
			
				<div class="modal-content">
				
					<h4>Agrega tu Receta</h4>
					
						<div class="row">
						
							<form class="col s10" method="post" action="wp-admin/admin-ajax.php" enctype="multipart/form-data">
							
								<div class="row">
								
									<div class="input-field col s12">
									
										<input type="text" id="post-titulo" name="post-titulo" class="validate" required />
										
										<label for="post-titulo" class="active">Titulo</label>
									
									</div>
								
								</div>
								
								<div class="row">
								
									<div class="input-field col s12">
									
										<textarea id="post-intro" name="post-intro" class="materialize-textarea" required></textarea>
										
										<label for="post-intro">Dinos de qué se trata tu receta</label>
									
									</div>
								
								</div>
								
								<div class="row">
								
									<div class="input-field col s12">
									
										<textarea id="post-ingredientes" name="post-ingredientes" class="materialize-textarea" required></textarea>
										
										<label for="post-ingredientes">La lista de Ingredientes</label>
									
									</div>
								
								</div>
								
								<div class="row">
								
									<div class="input-field col s12">
									
										<textarea id="post-preparacion" name="post-preparacion" class="materialize-textarea" required></textarea>
										
										<label for="post-preparacion">y cuál es la preparación</label>
									
									</div>
								
								</div>
								
								<div class="row">
								
									<div class="file-field input-field col s12">
									
										<div class="btn">
										
								        <span><i class="material-icons">image</i></span>
								        
								        <input type="file" id="post-imagen" name="post-imagen"  />
								        
								      </div>
								      
								      <div class="file-path-wrapper">
								      
								        <input class="file-path validate" type="text">
								        
								      </div>
									
									</div>
								
								</div>
								
								<div class="row">
								
									<div class="input-field col s3">
									
									    <select name="categoria-tipo">
									    
									      <option value="" disabled selected>Elige que tipo de plato es tu receta</option>
									      
									      <option value="Ensaladas" class="left">Ensaladas</option>
									      
									      <option value="Postres" class="left">Postres</option>
									      
									      <option value="Sopas" class="left">Sopas</option>
									      
									    </select>
									    
									    <label><i class="material-icons">local_dining</i>Tipo de Plato</label>
									  </div>
									  
										<div class="input-field col s3">
									
									    <select name="categoria-ocasion">
									    
									      <option value="" disabled selected>Elige la ocasión para cocinar tu receta</option>
									      
									      <option value="Formal" class="left">Formal</option>
									      
									      <option value="Informal" class="left">Informal</option>
									      
									      <option value="Toda Ocasión" class="left">Toda Ocasión</option>
									      
									    </select>
									    
									    <label><i class="material-icons">people</i>Ocasión</label>
									    
									  </div>
									  
									  <div class="input-field col s3">
									
									    <select name="categoria-region">
									    
									      <option value="" disabled selected>Elige la Región que representa tu plato</option>
									      
									      <option value="Países" class="left">Países</option>
									      
									      <option value="Continentes" class="left">Continentes</option>
									      
									      <option value="Sub Regiones" class="left">Sub Regiones</option>
									      
									    </select>
									    
									    <label><i class="material-icons">landscape</i>Región</label>
									    
									  </div>
									  
									  <div class="input-field col s3">
									
										<input type="text" id="categoria-ubicacion" name="categoria-ubicacion" class="validate" required />
										
										<label for="categoria-ubicacion" class="active"><i class="material-icons">landscape</i> A que zona representa tu plato?</label>
									
									</div>
								
								</div>
								
																
								<div class="row">
								
									<div class="input-field col s12">
									
										<?php wp_nonce_field( 'post-imagen', 'my_image_upload_nonce' ); ?>
									
										<button class="btn waves-effect waves-light" type="submit" name="action">Publicar
										
									    <i class="material-icons right">send</i>
									    
									 	</button>
									
									</div>
								
								</div>
								
								<?php wp_nonce_field( 'valida_data', 'data_nonce' ); ?>
								
								<input type="hidden" name="action" value="agrega_post" />
							
							</form>
						
						</div>
									
				</div>			
			
			</div>
			
			
				<div class="col s6 contenedor-post ">
				
					<div class="row">
					
					<?php

						/* Start the Loop */
						while ( have_posts() ) :
						
							the_post();
							
							$post = get_post();
							
					?>
					
						<div class="col s12">
						
							<div class="card  ">
							
								<div class="row">
							
									<div class="col s12">
									
										<div class="card horizontal contenedor-datos-autor">
										
											<div class="card-image"><?php echo get_avatar($post->author);?></div>
											
											<div class="card-stacked">
												
												<div class="card-content">
												
												<p><?php echo get_the_author();?></p>
												
												<p><?php echo $post->date;?></p>
												
												</div>
											
											</div>
																			
										</div>
																												
									</div>
								
								</div>
								
								<div class="row">
								
									<div class="card-image responsive-img col s4">
										
										<?php the_post_thumbnail(); ?>
										
									</div> <!-- Cierra Card image -->
									
									<span class="card-title black-text">
											
										<?php the_title(); ?>
												
									</span>  <!-- Cierra Card title -->
									
									<div class="card-content">
							
										<?php the_excerpt(); ?>
									
									</div> <!-- Cierra Card Content -->
									
								</div>
								
								
								<div class="card-action">
								
									<div class="row">
														
										
								
								<?php
											
										$categorias = get_the_terms($post->ID, 'category');
										
										foreach($categorias as $cat) {
										
											
													if($cat->parent !== 0 ) {
														
														$parent = get_term($cat->parent);
													
														switch($parent->name) {
														
															case 'Platos': 
																
																$icono = 'local_dining';
																
																break;
															
															case 'Ocasiones': 
															
																$icono = 'people';
																
																break;
															
															case 'Regiones' || 'Subregiones' || 'Países': 
															
																$icono = 'landscape';
																
																break;
															
														}
														
														?>
														<div class="col s4 ">
														
															<p class="teal white-text contenedor-display-categoria">
															
																<i class="material-icons"><?php echo $icono; ?></i>
																
																<?php
																
																echo $cat->name;  
																
																} // Cierra if
																
																?>
															</p>
															
														</div>
									
													<?php		} // cierra Foreach ?>	
													
													
															
												</div>	
										
											</div> <!-- Cierra Card action -->
											
											<div class="card-action">
											
												<a href="<?php echo $post->guid;?>" >Ver</a>
											
											</div>
										
										</div> <!-- Cierra Card contenedor-post-->
									
									</div> <!-- Cierra col s4 -->	
									
				<?php
				

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				//get_template_part( 'template-parts/content', get_post_type() );
				

					endwhile;
		
					the_posts_navigation();
		
				else :
		
					?>
				
				<div class="row">
				
					<div class="col s7">
					
					<div class="row">
					
					<div class="col s12">
					
					<?php
		
					get_template_part( 'template-parts/content', 'none' );
					
					?>
					
					</div>
					
					<?php
		
				endif;
				?>
				
				</div> <!-- Cierra row -->
		
			</div> <!-- Cierra col s7 -->
			
				<?php get_sidebar(); ?>
			
		</div> <!-- Cierra row -->
		
	</main><!-- #main -->
	
</div><!-- #primary -->

<?php

get_footer();