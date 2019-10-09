<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shurre
 */

?>
<!doctype html>

<html <?php  language_attributes(); ?> >

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">	

	<header id="masthead" class="site-header teal">
	
		<div class="container">

			<div class="row contenedor-navbar">
			
				<div class="col s12">
			
					<nav id="site-navigation" class="main-navigation teal contenedor-navbar">
					
							<div class="nav-wrapper">		
									<?php
									wp_nav_menu( array(
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu',
										'items_wrap'	  => '<ul id="%1$s" class="left menu-items hide-on-small-only hide-on-med-only">%3$s</ul>'
										
									) );
									?>
								<ul class="right menu-items show-on-small">
								
									<li><span>Hola <?php echo wp_get_current_user()->user_login;?></span></li>
							
									<li><a href="<?php
										
										if(!wp_get_current_user()->user_login) {
										
											echo wp_login_url();
																						
										} else {
									
									 echo wp_logout_url(); }?> " >Login</a></li>
									
									<li><a href=" <?php echo wp_registration_url(); ?> " >Registrarse</a></li>
								
								</ul>
							</div>
							
					</nav><!-- #site-navigation -->
				
				</div>
				
			</div>		
			
		</div>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
