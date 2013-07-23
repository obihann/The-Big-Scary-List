<?php get_header(); ?>

<div id="primary">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'page' ); ?>
	<?php endwhile; // end of the loop. ?>
</div><!-- #primary -->

<?php get_footer(); ?>