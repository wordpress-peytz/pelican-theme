const validationMessage = (): void => {
  'use strict';

  const searchInputs = document.querySelectorAll( '.wp-block-search__input' );

  if ( searchInputs ) {
    searchInputs.forEach( ( input ) => {
      input.addEventListener( 'invalid', () => {
        ( input as HTMLInputElement ).setCustomValidity(
          'Udfyld venligst dette felt.'
        );
      } );

      // Reset custom validation message when input is valid
      input.addEventListener( 'input', () => {
        ( input as HTMLInputElement ).setCustomValidity( '' );
      } );
    } );
  }
};

export default validationMessage;
