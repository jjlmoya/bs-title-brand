/**
 * BLOCK: bs-arrow-banner
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */


const {__} = wp.i18n;
const {registerBlockType} = wp.blocks;
const {TextControl} = wp.components;
const {MediaUpload, RichText} = wp.editor;
registerBlockType('bonseo/block-bs-title-brand', {
	title: __('Title brand'),
	icon: 'editor-quote',
	category: 'bonseo-blocks',
	keywords: [
		__('bs-title-brand'),
		__('BonSeo'),
		__('BonSeo Block'),
	],
	edit: function ({posts, className, attributes, setAttributes}) {
		function onImageSelect(imageObject) {
			setAttributes({
				image: imageObject.sizes.full.url
			})
		};

		function drawImageButton(open) {
			var html;
			if (attributes.image) {
				html = <img src={attributes.image}/>;
			} else {
				html = "Upload";
			}

			return (<button onClick={open}>
				{html}
			</button>)

		}

		return (
			<div>
				<TextControl
					className={`${className}__title`}
					label={__('Título')}
					value={attributes.title}
					onChange={title => setAttributes({title})}
				/>
				<TextControl
					className={`${className}__claim`}
					label={__('Subtitulo')}
					value={attributes.claim}
					onChange={claim => setAttributes({claim})}
				/>
				<RichText
					multiline="p"
					className={`${className}__content`}
					label={__('Frase más importante de todas')}
					value={attributes.content}
					onChange={content => setAttributes({content})}
					placeholder={__('Enter text...', 'block-bs-content-simple')}
					keepPlaceholderOnFocus={true}
				/>
				<TextControl
					className={`${className}__brand`}
					label={__('Elige el brand, por defecto el de tu tema')}
					value={attributes.brand}
					onChange={brand => setAttributes({brand})}
				/>
				<MediaUpload
					onSelect={onImageSelect}
					type="image"
					value={attributes.image}
					render={({open}) => (
						drawImageButton(open)
					)}
				/>
			</div>
		);
	},
	save: function () {
		return null;
	}
})
;
