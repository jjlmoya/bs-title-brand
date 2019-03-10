<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package BS
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

$block = 'block-bs-title-brand';

// Hook server side rendering into render callback
register_block_type('bonseo/' . $block,
	array(
		'attributes' => array(
			'title' => array(
				'type' => 'string',
			),
			'claim' => array(
				'type' => 'string',
			),
			'content' => array(
				'type' => 'string',
			),
			'image' => array(
				'type' => 'string',
			),
			'brand' => array(
				'type' => 'string',
			),
			'className' => array(
				'type' => 'string',
			)

		),
		'render_callback' => 'render_bs_title_brand',
	)
);

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function bs_title_brand_editor_assets()
{ // phpcs:ignore
	// Scripts.
	wp_enqueue_script(
		'bs_title_brand-block-js', // Handle.
		plugins_url('/dist/blocks.build.js', dirname(__FILE__)), // Block.build.js: We register the block here. Built with Webpack.
		array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'), // Dependencies, defined above.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: File modification time.
		true // Enqueue the script in the footer.
	);
}

function render_bs_title_brand($attributes)
{
	$title = isset($attributes['title']) ? $attributes['title'] : '';
	$content = isset($attributes['content']) ? $attributes['content'] : '';
	$brand = isset($attributes['brand']) ? $attributes['brand'] : '';
	$claim = isset($attributes['claim']) ? $attributes['claim'] : '';
	$image = isset($attributes['image']) ? $attributes['image'] : '';
	$class = isset($attributes['className']) ? ' ' . $attributes['className'] : '';
	return '<section class="og-title-brand
                a-bg a-bg--gradient--light a-bg--animated
                l-flex l-flex--direction-column
                bs_viewport a-mi a-mi--left ' . $brand . ' ' . $class . '">
		<div class="og-title-brand__heading l-column--1-1">
			<h1 class="a-text a-text--bold a-text--secondary l-flex l-flex--direction-column a-text--center l-flex--align-center a-pad-20">
				<span class="og-title__claim l-column--1-2 l-column--mobile--1-1 a-text--m">' . $claim . '</span>
				<span class="og-title__title l-column--1-2 l-column--mobile--1-1 a-text--xl ">' . $title . '</span>
			</h1>
		</div>
		
		<div class="og-title-brand__content l-flex l-flex--direction-row l-flex--mobile--wrap">
			<div class="og-title-brand__content__description
						l-column--1-2 l-column--mobile--1-1 l-flex-item--align-center
						a-text--secondary a-pad-20">
				' . $content . '
			</div>
			<picture class="l-column--1-2 a-text--center l-column--mobile--1-1 a-pad-0 lazy">
				<img class="a-image l-column--1-2 "
				 src="' . $image . '">
			</picture>    
			</div>
		</section>';
}

add_action('enqueue_block_editor_assets', 'bs_title_brand_editor_assets');
