
<?php get_header(); ?>

<div class="wrap">
	
		<main  class="container" >

		<div class="row">	
			
			<div class="col">	
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();	
			  $livro = get_post_meta( get_the_ID() );		  
		    ?>

			<h2><?= ucwords($livro['titulo'][0]) ?></h2>
			
			<br>
			
			<?php
			 if(has_post_thumbnail()){
                the_post_thumbnail();
             }
			?>
			</div>
			<div  class="widget-area sidebar" >
	         <?php dynamic_sidebar( 'sidebar-1' ); ?>
           </div><!-- #secondary -->
			
		  </div>
			
			
		
			<div class="row">
				<div class="col-lg-8">
					
		   <article>
				
				<h3>Resenha:</h3>
			  <?= $livro['resenha'][0] ?>
				<br><br>		
		   </article>		
					
					
					
			<table class="table table-striped" >
							    
					<tr>
						<th>TÍTULO</th>  <td><?= ucwords($livro['titulo'][0]) ?> </td>
					</tr>
                    <tr>
					    <th>AUTOR</th>  <td> <?= ucwords($livro['autor'][0])  ?> </td>
					</tr>  
					<tr>
					    <th>LANÇAMENTO</th> <td> <?= $livro['lancamento'][0] ?> </td>
					</tr>
                    <tr>
					    <th>EDIÇÃO</th> <td>  <?= $livro['edicao'][0] ?> </td>
					</tr> 
					<tr>
					    <th>ISBN</th> <td> <?= $livro['isbn'][0] ?> </td>
					</tr>

			</table>
					

					<div>
						<br>
						Posted by:| <?php the_author(); ?>
					</div>	
					
					<?php the_taxonomies(); ?>
					
			  <?php							
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', '' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( '', '' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . " << " . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', '' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( '', '' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . " >> " . '</span></span>',
				) );

			endwhile; // End of the loop.
			
			?>
					
					<a href="<?= get_post_type_archive_link(get_post_type(get_the_ID())) ?>">
						ARQUIVO
					</a>
					
			

			  </div>	
				
			 </div>


		</main><!-- #main -->

</div><!-- .wrap -->




<?php get_footer();	 ?>