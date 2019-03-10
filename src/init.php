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

$block = 'block-bs-arrow-banner';

// Hook server side rendering into render callback
register_block_type('bonseo/' . $block,
	array(
		'attributes' => array(
			'title' => array(
				'type' => 'string',
			),
			'content' => array(
				'type' => 'string',
			),
			'cta' => array(
				'type' => 'string',
			),
			'url' => array(
				'type' => 'string',
			),
			'className' => array(
				'type' => 'string',
			)

		),
		'render_callback' => 'render_bs_arrow_banner',
	)
);


/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function bs_arrow_banner_assets()
{
	wp_enqueue_style(
		'bs_arrow_banner-style-css',
		plugins_url('dist/blocks.style.build.css', dirname(__FILE__)),
		array('wp-editor')
	);
}

add_action('enqueue_block_assets', 'bs_arrow_banner_assets');

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function bs_arrow_banner_editor_assets()
{ // phpcs:ignore
	// Scripts.
	wp_enqueue_script(
		'bs_arrow_banner-block-js', // Handle.
		plugins_url('/dist/blocks.build.js', dirname(__FILE__)), // Block.build.js: We register the block here. Built with Webpack.
		array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'), // Dependencies, defined above.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: File modification time.
		true // Enqueue the script in the footer.
	);

	// Styles.
	wp_enqueue_style(
		'bs_arrow_banner-block-editor-css', // Handle.
		plugins_url('dist/blocks.editor.build.css', dirname(__FILE__)), // Block editor CSS.
		array('wp-edit-blocks') // Dependency to include the CSS after it.
	// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);
}

function render_bs_arrow_banner($attributes)
{
	$title = isset($attributes['title']) ? $attributes['title'] : '';
	$content = isset($attributes['content']) ? $attributes['content'] : '';
	$cta = isset($attributes['cta']) ? $attributes['cta'] : '';
	$url = isset($attributes['url']) ? $attributes['url'] : '';
	$class = isset($attributes['className']) ? ' ' . $attributes['className'] : '';


	return '
		<section class="og-banner-arrow' . $class . '">
			<div class="og-banner-arrow__simple a-pad">
				<h2 class="a-text a-text--xl a-text--secondary a-text--center">
					' . $title . '
				</h2>
				<p class="a-text a-text--center a-text--secondary">
					' . $content . '
				</p>
			</div>
			<div class="og-banner-arrow__edge  l-flex l-flex--justify-center a-pad">
				<a href="' . $url . '" class="a-button a-button--rounded a-button a-button--s a-button--secondary a-mar--y--bottom-40">
					' . $cta . '
				</a>
			</div>
		</section>';
}

add_action('enqueue_block_editor_assets', 'bs_arrow_banner_editor_assets');
