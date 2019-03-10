<?php
/**
 * Plugin Name: Banner Arrow [BonSeo Block]
 * Plugin URI: https://www.bonseo.es/wordpress-gutenberg-blocks/arrow-banner
 * Description: Un banner simple en forma de flecha
 * Author: jjlmoya
 * Author URI: https://www.bonseo.es/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * @package BS
 */


if (!defined('ABSPATH')) {
	exit;
}


if (!function_exists('bs_create_block_category')) {
	function bs_create_block_category($categories, $post)
	{
		return array_merge(
			$categories,
			array(
				array(
					'slug' => 'bonseo-blocks',
					'title' => __('BonSeo', 'bonseo-blocks'),
				),
			)
		);
	}

	add_filter('block_categories', 'bs_create_block_category', 10, 2);
}


require_once plugin_dir_path(__FILE__) . 'src/init.php';
