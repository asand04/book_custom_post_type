<?php
/*
Plugin Name: Simple Front End Posting
Plugin URI: http://
Description: Really simple way of posting from the front end in WordPress
Author: As-and Chanou	
Version: 1.0
Author URI: http://
*/
 
function simple_fep($content = null) {
	global $post;
 
	// We're outputing a lot of html and the easiest way 
	// to do it is with output buffering from php.
	ob_start();
 
?>
<style>
#fep-new-post label{display:inline-block;width:15%;}
#fep-new-post input{width:60%;}
#fep-new-post input[type="submit"]{margin-left:15%;width:30%;padding:7px;}
#fep-new-post textarea{	display:inline-block;width:80%;vertical-align:top;}
</style>


<div id="simple-fep-postbox" class="<?php if(is_user_logged_in()) echo 'fermer'; else echo 'déconnecter'?>">
		<?php do_action( 'simple-fep-notice' ); ?>
		<div class="simple-fep-inputarea">
		<?php if(is_user_logged_in()) { ?>
		
			<form id="fep-new-post" name="new_post" method="post" enctype="multipart/form-data">
			<div id="result">
			
			</div>
				<p><label>Nom de l'ouvrage*</label><input type="text" id ="nom" name="nom" /></p>
				<p><label>Auteur*</label><input type="text" id ="auteur" name="auteur" /></p>
				<p><label>Nombre de pages *</label><input type="text" id ="nombre_de_pages" name="nombre_de_pages" /></p>
				<p><label>Catégorie *</label><input type="text" id ="categorie" name="categorie" /></p>
				<p><label>Résumé*</label><textarea class="fep-content" name="resume" id="resume" tabindex="1" rows="4" cols="60"></textarea></p>
				<input type="file" name="thumbnail" id="thumbnail">	
				<input id="submit" type="submit" tabindex="3"  />					

			</form>
		<?php } else { ?>		
				<h4>Connectez-vous pour poster!!!</h4>
		<?php } ?>
		</div>
</div>

 <!-- #simple-fep-postbox -->
<?php
	// Output the content.
	$output = ob_get_contents();
	ob_end_clean();
 
	// Return only if we're inside a page. This won't list anything on a post or archive page. 
	if (is_page()) return  $output;
}
 
// Add the shortcode to WordPress. 
add_shortcode('simple-fep', 'simple_fep');
add_action( 'wp_ajax_fep_add_post', 'fep_add_post' );
add_action( 'wp_ajax_nopriv_fep_add_post', 'fep_add_post' );

function fep_add_post(){
	
		$meta=[];
		$meta['nom']= $nom;
		$meta['auteur']= $auteur;
		$meta['nombre_de_pages']= $nombre_de_pages;
		$meta['categorie']= $categorie;
		$meta['resume']= $resume;


	$post_id =  array(
		'post_title'	=> wp_strip_all_tags($nom),
		'post_type'     => 'livre',
		'post_author'   => get_current_user_id(),
		'meta_input'	=> $meta,
		'post_status'   => 'pending'
		);
	$new_post = wp_insert_post($post_id);	

	$upload = wp_upload_bits( $_FILES['image']['name'], null, file_get_contents( $_FILES['image']['tmp_name'] ) );

    $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );

    $wp_upload_dir = wp_upload_dir();

    $attachment = array(
        'guid' => $wp_upload_dir['baseurl'] . _wp_relative_upload_path( $upload['file'] ),
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
        'post_content' => '',
        'post_status' => 'inherit'
	);
	
	$attach_id = wp_insert_attachment( $attachment, $upload['file'], $post_id );

    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    update_post_meta( $post_id, '_thumbnail_id', $attach_id );

	if ($new_post == 0){
		echo json_encode( array('loggedin' => false, 'message' => __('Echec dinsertion')));
	}	else{
		echo json_encode( array('loggedin' => true, 'message' => __('Insertion effectuer')));
	}
die();		
}
