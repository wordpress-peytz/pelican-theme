<?php
namespace Pelican\Theme;

?>

<h1 class="post-header__title" itemprop="headline"><?php the_title(); ?></h1>

<?php do_action( THEMEDOMAIN . '_article_title' ); ?>
