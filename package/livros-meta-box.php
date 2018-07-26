<?php

namespace Metaboxes;

class MetaBox{
    
    
    public function __construct() {

        
    }
    
    
    
    public function init(){
        add_action( 'add_meta_boxes', [$this, 'dev_add_custom_metabox'] );
        add_action( 'save_post', [$this, 'dev_meta_save'] );
    }
    
    
   
public function dev_add_custom_metabox() {

	$type='livro';
	
	add_meta_box(
		'dev_meta',
		__( ucfirst($type) ),
		[$this,'dev_meta_callback'],
		$type,
		'normal',
		'core'
	);

}






/**
 * 
 * @param type $post
 */
public function dev_meta_callback($post){

$filename= plugin_dir_path(__FILE__).'templates/form_meta_box.php';	
if(file_exists($filename)){
	require_once $filename;
}

}







/**
 * 
 */

public function dev_meta_save($post_id){
	$form_data= ['titulo','autor','lancamento','edicao','isbn']; //
	$nonce_field='dev_livros_nonce'; //
	$text='resenha'; //
	$this->dev_helper_update_post_meta($post_id, $nonce_field, $form_data, $text); 
}





/**
 * 
 * @param type $post_id
 * @param type $nonce_field
 * @param type $form_input
 * @param type $text
 * @return type
 */
public function dev_helper_update_post_meta($post_id, $nonce_field, $form_input, $text=''){
    
	// Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST[$nonce_field]) && wp_verify_nonce($_POST[$nonce_field],basename(__FILE__)))? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
	
	foreach ($form_input as $value){
	  if(isset($_POST[$value])){
    	update_post_meta($post_id, $value, sanitize_text_field($_POST[$value]));
      }
	}
	  if(isset($_POST[$text])){
    	update_post_meta($post_id, $text, wp_kses_post($_POST[$text]));
     }
}
    
    
    
    
    
}