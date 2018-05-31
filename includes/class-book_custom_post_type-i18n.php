<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://chanoua.wordpress.com
 * @since      1.0.0
 *
 * @package    Book_custom_post_type
 * @subpackage Book_custom_post_type/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Book_custom_post_type
 * @subpackage Book_custom_post_type/includes
 * @author     Orion <achanou04@gmail.com>
 */
class Book_custom_post_type_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'book_custom_post_type',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
