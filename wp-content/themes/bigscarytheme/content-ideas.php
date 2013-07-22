	<article id="post-<?php the_ID(); ?>" class="project">
		<div class="overlay">
			<a href="#">Start the project</a>
		</div>
		<header class="entry-header">
			<h3>
				<a class="startProject" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
		</header><!-- .entry-header -->
		<?php the_excerpt(); ?>
	</article><!-- #post-<?php the_ID(); ?> -->
