<?php
/**
 * The default template for displaying content
 *
 * @package KZBPress
 * @since KZBPress 0.0.1
 */

$post_class = 'kzb-article';
?>

<article
    id="<?php the_ID(); ?>"
    <?php post_class($post_class); ?>
>
    <div class="kzb-article__content">
        <h1>
            <?php the_title(); ?>
        </h1>
        <p>
            <?php the_content(); ?>
        </p>
    </div>
</article>

