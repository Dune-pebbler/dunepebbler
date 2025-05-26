<?php
/**
 * Template Name: Svg test
 */
?><?php get_header(); ?>
<main class="svg-page">
    <section class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4><?php the_field('pre-titel') ?></h4>
                    <h1><?php the_title(); ?></h1>
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_template_part('part-quote') ?>
    </section>
    <section class="svg-blocks svg-blocks-black">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="row">
                        <?php while (have_rows('svgtest_black')): the_row(); ?>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="svg-block">
                                    <img src="<?php the_sub_field('svg_test_img'); ?>" class="svg" />
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="svg-blocks svg-blocks-white">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="row">
                        <?php while (have_rows('svgtest_white')): the_row(); ?>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="svg-block">
                                    <img src="<?php the_sub_field('svg_test_img'); ?>" class="svg" />
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="social">
        <div class="container">
            <div class="row">
                <?php get_template_part('part-social'); ?>
            </div>
        </div>
    </section>
    <section class="page-blocks">
        <div class="container-fluid">
            <div class="row row-no-padding">
                <?php
                $page_id = is_row_pagina_blok_empty(get_field('pagina_blok')) ? "option" : $post->ID;
                while (have_rows('pagina_blok', $page_id)): the_row();
                    get_template_part('part-pagina-block');
                endwhile;
                ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>