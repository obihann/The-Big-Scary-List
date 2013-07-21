	<article id="post-<?php the_ID(); ?>" class="project">
		<header class="entry-header">
			<h3>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
		</header><!-- .entry-header -->
		<?php the_excerpt(); ?>
	</article><!-- #post-<?php the_ID(); ?> -->
