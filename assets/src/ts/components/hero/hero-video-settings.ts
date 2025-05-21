// External dependencies.
import $ from 'jquery';

const heroVideoSettings = (): void => {
  'use strict';

  const $video = document.getElementById( 'hero-video' ) as HTMLVideoElement;
  const $hero = $( '.hero--with-video' );
  const $playButton = $( '.play-button' );
  const $muteButton = $( '.mute-button' );

  $playButton.on( 'click', () => {
    $hero.toggleClass( 'video-playing' );

    if ( ! $hero.hasClass( 'video-playing' ) ) {
      $video.pause();
    } else if ( $hero.hasClass( 'video-playing' ) ) {
      $video.play();
    }
  } );

  $muteButton.on( 'click', () => {
    $hero.toggleClass( 'video-muted' );

    if ( $hero.hasClass( 'video-muted' ) ) {
      $video.muted = true;
    } else if ( ! $hero.hasClass( 'video-muted' ) ) {
      $video.muted = false;
    }
  } );
};

export default heroVideoSettings;
