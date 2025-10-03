<?php get_header(); ?>
<main id="primary" class="site-main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; else: ?>
<p><?php _e('No content found','sitec'); ?></p>
<?php endif; ?>
</main>
<?php get_footer(); ?>


