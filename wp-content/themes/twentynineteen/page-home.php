<?php /* Template Name: Home */ ?>

<?php
get_header();
?>
<?php 

	$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'asc'
	) );//var_dump($categories);
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<?php if ( has_nav_menu( 'test' ) ) : ?>
					<div id="prd-cate-list">
						<div class="main-cate">s
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'test',
										//'menu_class'     => 'nav navbar-nav navbar-right',
										'menu_class'     => 'main-menu',
										//'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'container'     => false,
										 'link_before' => '<span class="mc_title">',
										 'link_after' => '</span>',
										'walker' => new Walker_Nav_Vertical()
									)
								);

							?>
						</div>	
					</div>
				<?php endif; ?>
			</div>	
				<?php
		foreach( $categories as $category ): ?>
				<?php
				$args = array(
					'type' => "post",
					'posts_per_page' => 1,
					'category__in' => $category->term_id,
					'category__not_in' => 5
				);
				$lastBlog = new WP_Query( $args );
				if ($lastBlog->have_posts() ) :
				?>
					
				<?php
					while( $lastBlog->have_posts() ) : $lastBlog->the_post(); ?>
					
						<div class="col-md-3">
						<?php get_template_part( 'template-parts/content/content', 'featured' );?> 
						</div>
					
					<hr>
					<?php endwhile;
				?>
					
				<?php endif;?>

				<?php
				// Reset Post Data at the end of the loop
				wp_reset_postdata();
				?>
		<?php endforeach; ?>



			</div>


		</div>


	</div>


<?php 

	if (have_posts() ) :
		while( have_posts() ) : the_post(); 
			get_template_part( 'template-parts/content', get_post_type() );?>
			<h2><?php the_title(); ?><h2>
			<p><?php the_content(); ?></p>
			
			<hr>
		<?php endwhile;
	endif;
?>


<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>