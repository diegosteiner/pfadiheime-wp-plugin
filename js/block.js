import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/blockEditor';
import { TextControl } from '@wordpress/components';
import { createElement } from '@wordpress/element';

registerBlockType('my-content-block/my-block', {
  title: 'My Content Block',
  icon: 'smiley',
  category: 'common',
  attributes: {
    text: {
      type: 'string',
      default: 'Test',
    },
  },
  edit: function(props) {
    const { attributes, setAttributes } = props;
    const { text } = attributes;

    function onChange(newText) {
      setAttributes({ text: newText });
    }

    return createElement(
      'div',
      null,
      createElement(
        InspectorControls,
        null,
        createElement(TextControl, {
          label: 'Text',
          value: text,
          onChange: onChange,
        })
      ),
      createElement(
        'div',
        null,
        createElement('p', null, text)
      )
    );
  },
  save: function(props) {
    const { attributes } = props;
    const { text } = attributes;

    return createElement(
      'div',
      null,
      createElement('p', null, text)
    );
  },
});
