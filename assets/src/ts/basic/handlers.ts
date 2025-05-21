// Internal dependencies.
import { handlerEscapeKeyUp } from './handle-escape-key-up';

const handlers = () => {
  document.addEventListener( 'keyup', keyUp );
};

export const keyUp = ( e: KeyboardEvent ) => {
  if ( e.key === 'Escape' ) {
    console.log( {
      msg: `${ e.key } was pressed.`,
      key: e.key,
    } );

    // handle the event
    handlerEscapeKeyUp();
  }
};

export default handlers;
