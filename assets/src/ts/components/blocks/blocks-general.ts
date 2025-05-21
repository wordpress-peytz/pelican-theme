import { unregisterBlockStyle } from '@wordpress/blocks';

/**
* Register a custom block style for the core button block in WordPress.
*/
const unregisterBlocks = () => {
  unregisterBlockStyle( 'core/quote', 'plain' );
};

export default unregisterBlocks;
