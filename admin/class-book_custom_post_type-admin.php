<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://chanoua.wordpress.com
 * @since      1.0.0
 *
 * @package    Book_custom_post_type
 * @subpackage Book_custom_post_type/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Book_custom_post_type
 * @subpackage Book_custom_post_type/admin
 * @author     Orion <achanou04@gresume.com>
 */
class Book_custom_post_type_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Book_custom_post_type_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Book_custom_post_type_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/book_custom_post_type-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Book_custom_post_type_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Book_custom_post_type_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/book_custom_post_type-admin.js', array( 'jquery' ), $this->version, false );

	}

		/**
			* Creates a new custom post type
			*
			* @since 1.0.0
			* @access public
			* @uses register_post_type()
		*/
		// Register Custom Post Type
		public function new_cpt_livre() {
			$type = 'livre';
			$labels = array(
			'name'                  => _x( 'Livres', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Livre', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Livre', 'text_domain' ),
			'name_admin_bar'        => __( 'Livres', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Items', 'text_domain' ),
			'add_new_item'          => __( 'Add New Item', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Item', 'text_domain' ),
			'update_item'           => __( 'Update Item', 'text_domain' ),
			'view_item'             => __( 'View Item', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
			'search_items'          => __( 'Search Item', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Livre', 'text_domain' ),
			'description'           => __( 'Ajouter un nouveau livre', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnails' ),
			'taxonomies'            => array( 'category', 'thumbnails' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'menu_icon'             => 'dashicons-book',
			'rewrite' => [ 'slug' => 'livre' ],
			'show_in_rest' => true,
			
		);
		register_post_type( $type, $args );
	}
	public function init_metabox(){
	  add_meta_box('info_livre', 'Détails du livre', function ( $post ){
		wp_nonce_field( info_livre_save, info_livre_meta_box_nonce);
	  $nom             = get_post_meta($post->ID,'_nom',true);
	  $auteur          = get_post_meta($post->ID,'_auteur',true);
	  $nombre_de_pages = get_post_meta($post->ID,'_nombre_de_pages',true);
	  $categorie       = get_post_meta($post->ID,'_categorie',true);
	  $resume          = get_post_meta($post->ID,'_resume',true);
	  echo'<lable for="nom">Nom du livre</label>';
	  echo'<br>';
	  echo'<input id="nom" style="width: 500px;" type="text" name="nom" value="'.esc_attr( $nom ).'" />';
	  echo'<br>';
	  echo'<lable for="auteur">Auteur du livre</label>';
	  echo'<br>';
	  echo'<input id="auteur"  style="width: 500px;" type="text" name="auteur" value="'.esc_attr( $auteur ).' " />';
	  echo'<br>';
	  echo'<lable for="nombre_de_page">Nombre de page</label>';
	  echo'<br>';
	  echo'<input id="nombre_de_pages" style="width: 500px;" type="text" name="nombre_de_pages" value="'.esc_attr( $nombre_de_pages ).'" />';
	  echo'<br>';
	  echo'<lable for="categorie">Categorie</label>';
	  echo'<br>';
	  echo'<input id="categorie" style="width: 500px;" type="text" name="categorie" value="'.esc_attr( $categorie ).'"/>';
	  echo'<br>';
	  echo'<lable for="resume">Resume</label>';
	  echo'<br>';
	  echo'<textarea id="resume" style="width: 280px;" name="resume"> '.esc_attr( $resume ).' </textarea>';
	}
	,'livre');
	}
	
	public function save_metabox($post_id){
	   if(isset($_POST['nom'])){
		update_post_meta($post_id, '_nom', sanitize_text_field($_POST['nom']));
	   }
		else{
			add_post_meta( $post_id, '_nom', $nom );
		}
	  if(isset($_POST['auteur'])){
		update_post_meta($post_id, '_auteur', sanitize_text_field($_POST['auteur']));
	  }
		else{
			add_post_meta( $post_id, '_auteur', $auteur );
		}
	  
	 if(isset($_POST['nombre_de_pages'])){
		update_post_meta($post_id, '_nombre_de_pages', sanitize_text_field($_POST['nombre_de_pages']));
	 }
		else{
			add_post_meta( $post_id, '_nombre_de_pages', $nombre_de_pages);
		}
	  
	  if(isset($_POST['categorie'])){
		update_post_meta($post_id, '_categorie', sanitize_text_field($_POST['categorie']));
	  }
		else{
			add_post_meta( $post_id, '_categorie', $categorie );
		}
	  
	  if(isset($_POST['resume'])){
		update_post_meta($post_id, '_resume', esc_textarea($_POST['resume']));
	  }
		else{
			add_post_meta( $post_id, '_resume', $resume );
		}
	  
	}
}
