<div class="pagination">

	<?php
	the_posts_pagination(
		[
			'prev_text' => '<span class="pagination__icon pagination__icon--prev icon-chevron-left"></span><span class="pagination__text pagination__text--prev">' . __( 'Previous', THEMEDOMAIN ) . '</span>',
			'next_text' => '<span class="pagination__text pagination__text--next">' . __( 'Next', THEMEDOMAIN ) . '</span><span class="pagination__icon pagination__icon--next icon-chevron-right"></span>',
		]
	);
	?>

</div>
