<?php

namespace Pelican\Theme\Core;

/**
 * Class to handle single Attachment Pages
 */
class ChangeSingleAttachmentPage {

	public function __construct() {
		add_action( 'template_redirect', [ $this, 'attachment_redirect' ] );
	}

	/**
	 * Redirect attachments to their attachment page.
	 * If no parent is found it will redirect to the full size of the image.
	 */
	public function attachment_redirect(): void {
		if ( ! is_attachment() ) {
			return;
		}

		$parent   = wp_get_post_parent_id( get_the_ID() );
		$redirect = $parent ? get_the_permalink( $parent ) : get_the_guid( get_the_ID() );

		wp_redirect( $redirect );
		exit;
	}

}

new ChangeSingleAttachmentPage();
