/**
 * BLOCK: bs-arrow-banner
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

import './style.scss';
import './editor.scss';

const {__} = wp.i18n;
const {registerBlockType} = wp.blocks;
const {TextControl} = wp.components;
registerBlockType('bonseo/block-bs-arrow-banner', {
	title: __('Banner Arrow'),
	icon: 'editor-quote',
	category: 'bonseo-blocks',
	keywords: [
		__('bs-banner-arrow'),
		__('BonSeo'),
		__('BonSeo Block'),
	],
	edit: function ({posts, className, attributes, setAttributes}) {
		return (
			<div>
				<TextControl
					className={`${className}__title`}
					label={__('Título del banner')}
					value={attributes.title}
					onChange={title => setAttributes({title})}
				/>
				<TextControl
					className={`${className}__content`}
					label={__('Frase del banner')}
					value={attributes.content}
					onChange={content => setAttributes({content})}
				/>
				<TextControl
					className={`${className}__cta`}
					label={__('CTA')}
					value={attributes.cta}
					onChange={cta => setAttributes({cta})}
				/>
				<TextControl
					className={`${className}__url`}
					label={__('Url o Email(mailto:)')}
					value={attributes.url}
					onChange={url => setAttributes({url})}
				/>
			</div>
		);
	},
	save: function () {
		return null;
	}
})
;
