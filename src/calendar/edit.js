import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	SelectControl,
	Placeholder,
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { id, locale, width, height, months } = attributes;
	const blockProps = useBlockProps();

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Calendar', 'pfadiheime' ) }>
					<TextControl
						label={ __( 'Pfadiheime ID', 'pfadiheime' ) }
						value={ id }
						onChange={ ( value ) => setAttributes( { id: value } ) }
						help={ __(
							'Inserted into the URL template configured under Settings → Pfadiheime.',
							'pfadiheime'
						) }
					/>
					<SelectControl
						label={ __( 'Locale', 'pfadiheime' ) }
						value={ locale }
						options={ [
							{ label: 'de', value: 'de' },
							{ label: 'fr', value: 'fr' },
							{ label: 'it', value: 'it' },
						] }
						onChange={ ( value ) =>
							setAttributes( { locale: value } )
						}
					/>
					<TextControl
						type="number"
						min={ 1 }
						label={ __( 'Months', 'pfadiheime' ) }
						value={ months }
						onChange={ ( value ) =>
							setAttributes( {
								months: parseInt( value, 10 ) || 1,
							} )
						}
						help={ __( 'Number of months to display.', 'pfadiheime' ) }
					/>
					<TextControl
						label={ __( 'Width', 'pfadiheime' ) }
						value={ width }
						onChange={ ( value ) => setAttributes( { width: value } ) }
						help={ __( 'e.g. 100% or 800', 'pfadiheime' ) }
					/>
					<TextControl
						label={ __( 'Height', 'pfadiheime' ) }
						value={ height }
						onChange={ ( value ) =>
							setAttributes( { height: value } )
						}
						help={ __( 'e.g. 600 or 75vh', 'pfadiheime' ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				{ id ? (
					<ServerSideRender
						block="pfadiheime/calendar"
						attributes={ attributes }
					/>
				) : (
					<Placeholder
						icon="calendar"
						label={ __( 'Calendar', 'pfadiheime' ) }
						instructions={ __(
							'Enter a calendar ID in the block settings to display the calendar.',
							'pfadiheime'
						) }
					/>
				) }
			</div>
		</>
	);
}
