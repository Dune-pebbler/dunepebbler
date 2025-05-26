<?php
/*
 * Template name: News Page (2022)
 * Template Post Type: post, page, news, portfolio, story_collection
 */


/**
 * @version .01 
 * @author Tim van Duijvenvoorde <tim@dunepebbler.nl>
 * @description News items template based on the blog template
 */
get_header();
?>
<main class="theme-<?= get_field('theme_color'); ?>-color">
    <?php if ($post_thumbnail_id = get_post_thumbnail_id()): ?>
        <section class="banner-white">
            <!-- we keep this empty. -->
        </section>
    <?php else: ?>
        <section class="no-banner-new"></section>
    <?php endif; ?>

    <section class="intro-content-new">
        <div class="container">
            <div class="row">
                <?php if ($post_thumbnail_id = get_post_thumbnail_id()): ?>
                    <div class="col-12 col-lg-10 offset-lg-1 remove-relative">
                        <div class="image fix-translate should-animate remove__animate animate__widthInRight"
                            data-translate-container=".intro-content-new">
                            <img loading="lazy"
                                src="<?= get_webp(wp_get_attachment_image_src($post_thumbnail_id, 'full')[0]); ?>"
                                class="fix-width" data-container=".col-12"
                                alt="<?php the_title(); ?> uitgelichte afbeelding">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (($position = get_field('introductie_uitlijning')) == 'left'): ?>
                    <div class="col-12 col-lg-6 offset-lg-1">
                    <?php else: ?>
                        <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                        <?php endif; ?>
                        <div class="content">
                            <?php if ($pretitel = get_field('pre-titel')): ?>
                                <h4 class='pre-headline ml13' data-delay="100"><?= $pretitel; ?></h4>
                            <?php endif; ?>
                            <?php if (is_blog()): ?>
                                <h4 class='pre-headline ml13' data-delay="100"><?php the_post_type_name(); ?> | Door
                                    <?php the_author(); ?> | <?= date_i18n("d F Y", get_the_date("U")); ?>
                                </h4>

                            <?php endif; ?>
                            <h1 class="ml13"><?php the_title(); ?></h1>

                            <div class="inner-content"
                                data-inner-animation="should-animate remove__animate animate__smallFadeInUp"
                                data-inner-animation-on="> *">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?php
    $args = [
        'posts_per_page' => 10,
        'post_type' => ['nieuws-bericht'], // Only fetch 'nieuws-bericht' posts
        'meta_query' => [
            'relation' => 'OR',
            [
                'key' => 'is_spotlight',
                'value' => '1',
                'compare' => '!='
            ],
            [
                'key' => 'is_spotlight',
                'compare' => 'NOT EXISTS'
            ]
        ],
        'tax_query' => [],
    ];

    $spotlight_args = [
        'posts_per_page' => 1,
        'post_type' => ['nieuws-bericht'], // Only fetch 'nieuws-bericht' posts for spotlight
        'meta_query' => [
            [
                'key' => 'is_spotlight',
                'value' => '1',
            ]
        ],
    ];

    $expertises = get_terms([
        'hide_empty' => false,
        'taxonomy' => 'type_blog'
    ]);

    if (isset($_GET['expertise'])) {
        $args['tax_query'][][] = [
            'taxonomy' => 'type_blog',
            'field' => 'name',
            'terms' => (array) explode(",", $_GET['expertise'], )
        ];
    }

    if (isset($_GET['search'])) {
        $args['meta_query'][] = [
            'value' => $_GET['search'],
            'compare' => 'LIKE',
        ];
    }

    $query = new WP_Query($args);
    $spotlight_query = new WP_Query($spotlight_args);
    ?>
    <?php if ($spotlight_query->have_posts()):
        $spotlight_query->the_post(); ?>
        <section class="spotlight-container">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1">
                        <h2 class='ml13'><?php _e('In de spotlight', THEME_TD); ?></h2>

                        <div class="spotlight-item should-animate remove__animate animate__smallFadeInRight">
                            <div class="row">
                                <div class="col-12 col-lg-6 order-lg-1">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="image">
                                            <img src="<?= get_webp(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>"
                                                alt="<?php the_title(); ?>" />
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="content">
                                        <p class='customer ml13'><?= date_i18n("d F Y", get_the_date("U")); ?></p>
                                        <h3 class='ml13'><?php the_title(); ?></h3>

                                        <?= wpautop(get_the_excerpt()); ?>

                                        <div class="buttons">
                                            <a href="<?php the_permalink(); ?>" class="btn">Lees verder</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="project-overview">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <form class="filters">
                        <div class="header">
                            <h3 class='ml13'><?php _e('Blijf op de hoogte', THEME_TD); ?></h3>

                            <input type="text" name="search" value="<?= wp_kses_data(@$_GET['search']); ?>"
                                placeholder="Zoek berichten">
                        </div>
                        <?php /*<div class="category">
                       <ul>
                           <li class='should-animate remove__animate animate__smallFadeInRight'><button data-reset
                                   class="<?= !isset($_GET['search']) && !isset($_GET['expertise']) ? "is-active" : ""; ?>">Alle</button>
                   </li>
                   <?php foreach ($expertises as $index => $expertise):
                               $current_expertises = isset($_GET['expertise']) ? $_GET['expertise'] : ''; ?>
                   <li class='should-animate remove__animate animate__smallFadeInRight'
                       data-delay="<?= $index * 100; ?>">
                       <button data-name="<?= $expertise->name; ?>"
                           class="<?= in_array($expertise->name, explode(",", $current_expertises)) ? "is-active" : ""; ?>">
                           <?= $expertise->name; ?>
                       </button>
                   </li>
                   <?php endforeach; ?>
                   </ul>
           </div>*/ ?>
                    </form>

                    <?php if ($query->have_posts()): ?>
                        <div class="project-container autoload-items" data-action="on_get_news">
                            <div class="row">
                                <?php while ($query->have_posts()):
                                    $query->the_post(); ?>
                                    <?php get_template_part('part-item', 'nieuws'); ?>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>

                            <div class="buttons">
                                <button class="btn set-autoload"><?php _e('Meer laden', THEME_TD); ?></button>
                                <div class="loader">
                                    <i class="fad fa-spinner-third fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>