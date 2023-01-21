<?php
/**
 * The template for 404 page
 * @package KZBpress
 * @since KZBpress 1.0.0
 */

get_header();
?>

<main class="kzb-main">
    <article>
        <div class="kzb-entry">
            <header>
                <h1 class="kzb-entry__title">
                    Опа, тука няма никой!
                </h1>
            </header>
            <div class="kzb-entry__error">
                <p>
                    Страницата липсва, била е премахната, изядена, или някой те е пратил за зален хайвер!
                </p>
            </div>
            <div class="kzb-entry__search">
                <h3>
                    Може да пробваш да потърсиш
                </h3>
                <?php get_template_part('template-parts/search'); ?>
            </div>
            <div class="kzb-entry__home">
                <h3>
                    Може да пробваш да се върнеш на главната страница
                </h3>
                <a href="<?php echo get_site_url(); ?>">
                    Начало
                </a>
            </div>
        </div>
    </article>
</main>
