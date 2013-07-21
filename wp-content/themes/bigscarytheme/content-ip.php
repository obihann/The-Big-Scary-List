	<article id="post-<?php the_ID(); ?>" class="project">
		<header class="entry-header">
			<h3>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<h4>
				Work Started <?php echo get_post_meta(get_the_ID(), "start date", true); ?><br /> 
				The current progress is 
				<span class="inProgressPercent"><?php echo get_post_meta(get_the_ID(), "progress", true); ?></span>
			</h4>
		</header><!-- .entry-header -->
		<?php the_excerpt(); ?>
	</article><!-- #post-<?php the_ID(); ?> -->
