<?php	
	
/**
 * 
 * @param type $post_id
 * @param type $field
 */
function dev_helper_field($post_id, $field){
	$stored_meta = get_post_meta( $post_id );
   if(!empty($stored_meta[$field])){
      echo esc_attr( $stored_meta[$field][0] );
    }
}
	
//prints a wp nonce type hidden field 
wp_nonce_field( basename(__FILE__), 'dev_livros_nonce');	?>
    
<div class="form-control">
     <div> 
	  <label for="titulo" class="label label-primary">Título:</label>
	  <div>
        <input class="form-control" type="text" value="<?php dev_helper_field($post->ID,'titulo') ?>" name="titulo" id="titulo" />
	  </div>
	 </div>
     <div>
	   <label for="autor" class="label label-primary">Autor:</label>
	   <div>
	     <input class="form-control" type="text" value="<?php dev_helper_field($post->ID,'autor') ?>" name="autor" id="autor"  />
	   </div>
	 </div> 
     <div>
	   <label for="lancamento" class="label label-primary">Lançamento:</label>
	   <div>
	     <input class="form-control" type="text" value="<?php dev_helper_field($post->ID,'lancamento') ?>" name="lancamento" id="lancamento" />
	   </div>
	 </div>
     <div>
		 <label for="edicao" class="label label-primary">Edição:</label>
	   <div>
	      <input class="form-control" type="text" value="<?php  dev_helper_field($post->ID,'edicao') ?>" name="edicao" id="edicao" />
	   </div>
	 </div>
	<div>
		 <label for="isbn" class="label label-primary">ISBN:</label>
	   <div>
	      <input class="form-control" type="text" value="<?php  dev_helper_field($post->ID,'isbn') ?>" name="isbn" id="isbn" />
	   </div>
	 </div>
	
	<div><label for="tinymce" class="label label-primary">RESENHA:</label>
		<div class="meta-editor"></div>
		<?php

		$content = get_post_meta( $post->ID, 'resenha', true );
		$editor = 'resenha';
		$settings = array(
			'textarea_rows' => 8,
			'media_buttons' => false,
		);

		wp_editor( $content, $editor, $settings); ?>
	</div>
	
</div>	