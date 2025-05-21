import unregisterBlocks from '../components/blocks/blocks-general';

export const initAdmin = () => {
  /**
  * Wrap all initialized code in anonymous function.
  * jQuery is defined as being globally available in the `eslintrc` configuration.
  * The correct order of enqueueing the javascript assets is handled in the `enqueue.php` file of the theme.
  */
  ( () => {
    // run theme scripts
    unregisterBlocks();
  } )();
};

export default initAdmin;
