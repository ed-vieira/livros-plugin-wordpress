<?php

namespace Plugin;
require_once 'livros-meta-box.php';
use Metaboxes\MetaBox as Metabox;


class App{
    
    

    
    public function __construct() {

    }
    
    
    
    
    public function run(){
        

        //add bootstrap to admin dashboard    
        add_action( 'admin_enqueue_scripts', [$this, 'dev84_admin_styles']);
        add_action('wp_enqueue_scripts', [$this, 'dev84_admin_styles']);
        
        $metabox = new MetaBox();
        $metabox->init();
        
        add_action( 'init', [$this, 'dev_book_init'] );
        add_action( 'init', [$this,'dev_book_register_taxonomy'] );
        add_action( 'pre_get_posts', [$this, 'order_posts_by_title'] );
        
        add_filter( 'template_include', [$this, 'dev_load_templates'] );
             
    }
    
    
    
   public function dev_load_templates($original_template) {

	   $type='livro';
	
	 //  $taxonomy='biblioteca'; 
	   
       if ( get_query_var( 'post_type' ) !== $type ) {
               return $original_template;
       }

       if ( is_archive() || is_search() ) {
               if ( file_exists( get_stylesheet_directory(). "/archive-$type.php" ) ) {
	  
                     return get_stylesheet_directory() . "/archive-$type.php";
	 
               } else {

                       return plugin_dir_path( __FILE__ ) . "templates/archive-$type.php";
               }

       } elseif(is_singular($type)) {

               if (  file_exists( get_stylesheet_directory(). "/single-$type.php" ) ) {

                       return get_stylesheet_directory() . "/single-$type.php";

               } else {

                       return plugin_dir_path( __FILE__ ) . "templates/single-$type.php";

               }

       }else{
		   
         	return get_page_template();			
       }


   
       return $original_template;

}  
    
    




    /**
     * 
     * @param type $query
     */
   public function order_posts_by_title($query) 
  {
	if ( $query->is_taxonomy() && $query->is_main_query() ) {
		$query->set( 'orderby', 'titulo' );
		$query->set( 'order', 'ASC' );
	}
  }
    
    
 
  
  
  
  
 /**
  * 
  */ 
 public function dev_book_register_taxonomy() {

	$post_type='livro';
	$taxonomy='biblioteca';
	$plural = __( ucfirst($taxonomy).'s' );
	$singular = __(ucfirst($taxonomy));


	$labels = array(
	'name'                       => $plural,
        'singular_name'              => $singular,
        'search_items'               => 'Search ' . $plural,
        'popular_items'              => 'Popular ' . $plural,
        'all_items'                  => 'All ' . $plural,
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit ' . $singular,
        'update_item'                => 'Update ' . $singular,
        'add_new_item'               => 'Add New ' . $singular,
        'new_item_name'              => 'New ' . $singular . ' Name',
        'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
        'add_or_remove_items'        => 'Add or remove ' . $plural,
        'choose_from_most_used'      => 'Choose from the most used ' . $plural,
        'not_found'                  => 'No ' . $plural . ' found.',
        'menu_name'                  => $plural,
	);

	$args = array(
	'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => strtolower( $singular ) ),
	);

	register_taxonomy( strtolower( $singular ), $post_type, $args );

}
  
  
  
  
  public function dev_book_init() {

	$type='livro';
	
	$singular = __( ucfirst($type) );
	$plural = __( ucfirst($type).'s' );
        //Used for the rewrite slug below.
        $plural_slug = str_replace( ' ', '_', $plural );

        //Setup all the labels to accurately reflect this post type.
	$labels = array(
		'name' 				=> $plural,
		'singular_name' 		=> $singular,
		'add_new' 				=> 'Add New',
		'add_new_item' 			=> 'Add New ' . $singular,
		'edit'		        	=> 'Edit',
		'edit_item'	        	=> 'Edit ' . $singular,
		'new_item'	        	=> 'New ' . $singular,
		'view' 					=> 'View ' . $singular,
		'view_item' 			=> 'View ' . $singular,
		'search_term'   		=> 'Search ' . $plural,
		'parent' 				=> 'Parent ' . $singular,
		'not_found' 			=> 'No ' . $plural .' found',
		'not_found_in_trash' 	=> 'No ' . $plural .' in Trash'
	);

        //Define all the arguments for this post type.
	$args = array(
	'labels' 	      => $labels,
	'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_in_nav_menus'   => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-admin-site',
        'can_export'          => true,
        'delete_with_user'    => false,
        'hierarchical'        => false,
        'has_archive'         => true,
        'query_var'           => true,
        'capability_type'     => 'page',
        'map_meta_cap'        => true,
        // 'capabilities' => array(),
        'rewrite'             => array( 
        	'slug' => strtolower( $plural_slug ),
        	'with_front' => true,
        	'pages' => true,
        	'feeds' => false,

        ),
        'supports'            => array( 
        	'title'
        )
	);

        //Create the post type using the above two varaiables.
	register_post_type( $type, $args);
	
	add_theme_support('post-thumbnails');
        add_post_type_support( 'livro', 'thumbnail' );
        add_image_size( 'litle-thumbnail', 120, 60 );
		
}
  
  









function dev84_admin_styles() {
    $PLUGIN_URL= plugin_dir_url(__FILE__);
    wp_enqueue_style('bootstrap_css',$PLUGIN_URL.'/assets/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css', false);
    wp_enqueue_script('bootstrap_js',$PLUGIN_URL.'/assets/bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js', false );
}






  
  
  
}






