<?php
  get_header(); 
 ?>

<div class="wrap">


<main class="container" >


	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>
			
			
			
			
			
	   <div class="row">
		   <div class="col">
		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ): the_post();
				?>

			   <div>
				  <a href="<?= the_permalink() ?>">
							   <h3> <?= the_title() ?> </h3>
						  
						   <?php
						   if(has_post_thumbnail()){
							   the_post_thumbnail('litle-thumbnail');
						    }
						   ?>
				 </a>
			  </div>	
			
			     
			
			<?php

			endwhile;
           
			the_posts_pagination( array(
				'prev_text' => "<<" . '<span class="screen-reader-text">' . __( 'Previous page', '' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', '' ) . '</span>' . ">>",
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', '' ) . ' </span>',
			) );

		else :

			//get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

		   </div>
		   

		   <div  class="widget-area sidebar" >
	         <?php dynamic_sidebar( 'sidebar-1' ); ?>
           </div><!-- #secondary -->
		   
		   
		   
	   </div>  

			
</main><!-- #main -->
		  

                
       
</div><!-- .wrap -->

<?php 
 get_footer();
?>














