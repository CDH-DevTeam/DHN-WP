<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DHN
 */

get_header(); ?>

	<div id="primary" class="container">

		<?php if ( is_active_sidebar( 'above-content' ) ) { ?>
			<div class="row">
				<div class="twelve columns">
					<?php dynamic_sidebar( 'above-content' ); ?>
				</div>
			</div>
		<?php } ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if (get_post_type() == 'post') {
							echo '<span class="larger">News archive</span><br/>';
						}
						else if (get_post_type() == 'projects') {
							echo '<span class="larger">Projects</span><br/>';
						}
						else if (get_post_type() == 'departments') {
							echo '<span class="larger">Departments</span><br/>';
						}
						else {
							echo '<span class="larger">Archive</span><br/>';
						}

						single_tag_title('<span class="icon tag-icon"></span>');
					?>
				</h1>
			</header>

			<?php
			if ( have_posts() ) : ?>


				<div class="row">
					<div class="twelve columns tile-grid">

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				?>

				</div>
			</div>
			
			<div class="row">
				<div class="twelve columns">

					<?php

					the_posts_navigation();

					?>
				</div>
			</div>

		<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>


		<?php if ( is_active_sidebar( 'after-content' ) ) { ?>
			<div class="row">
				<div class="twelve columns">
					<?php dynamic_sidebar( 'after-content' ); ?>
				</div>
			</div>
		<?php } ?>
	</div>

<?php
get_sidebar();
get_footer();
