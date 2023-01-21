<?php
/**
 * The Main template file
 *
 * That's the very basic file for any WP theme.
 *
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package KZBPress
 * @since KZBPress 0.0.1
 */

get_header();
?>

<main class="kzb-content">
    <div class="kzb-entry">
        <?php
        if (have_posts()) {
            while(have_posts()) {
                the_post();
                get_template_part('template-parts/content', get_post_format());
            }
        } else {
            get_template_part('template-parts/content', 'none');
        }
        ?>
    </div>

    <div class="kzb-pagination">
        <?php if (function_exists('kzb_pagination')) : ?>
            <?php kzb_pagination(); ?>
        <?php elseif(is_paged()) : ?>
            <nav class="kzb-nav">
				<div class="kzb-nav__previous">
                    <?php next_posts_link(__('&larr; Older posts', 'hlebarovpress')); ?>
                </div>
				<div class="kzb-nav__next">
                    <?php previous_posts_link(__('Newer posts &rarr;', 'hlebarovpress')); ?>
                </div>
            </nav>
        <?php endif; ?>
    </div>
</main>


<?php get_footer(); ?>