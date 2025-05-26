<?php
$args = [
    'posts_per_page' => 10,
    'post_type' => 'portfolio',
    'meta_query' => [],
    'tax_query' => [],
];
$expertises = get_terms([
    'hide_empty' => false,
    'taxonomy' => 'expertises'
]);

if( isset($_GET['expertise']) ) {
    $args['tax_query'][][] = [
        'taxonomy' => 'expertises',
        'field'    => 'name',
        'terms'    => (array) explode(",", $_GET['expertise'],)
    ];
}

if( isset($_GET['search'])){
    $args['meta_query'][] = [
        'value' => $_GET['search'],
        'compare' => 'LIKE',
    ];
}

$query = new WP_Query($args);
?>

<section class="project-overview">
     <div class="expertises is-mobile">
        <button class="sidebar-btn" onclick="jQuery(this).parent().toggleClass('is-active');"><i class="fal fa-chevron-right"></i></button>
        <h2>Filters</h2>
        <ul>
            <li class='should-animate remove__animate animate__smallFadeInRight'><button data-reset class="<?= !isset($_GET['search']) && !isset($_GET['expertise']) ? "is-active": ""; ?>">Alle</button></li>
            <?php foreach($expertises as $expertise ): $current_expertises = isset($_GET['expertise']) ? $_GET['expertise'] : ''; ?>
            <li  class='should-animate remove__animate animate__smallFadeInRight' data-delay="<?= $index * 100; ?>">
                <button data-name="<?= $expertise->name; ?>" class="<?= in_array($expertise->name, explode(",", $current_expertises)) ? "is-active":""; ?>">
                    <?= $expertise->name; ?>
                </button></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                <form class="filters">
                    <div class="header">
                        <h3 class='ml13'><?php _e('Onze projecten', THEME_TD); ?></h3>
                        
                        <input type="text" name="search" value="<?= wp_kses_data(@$_GET['search']); ?>" placeholder="Zoek projecten">
                    </div>
                    <div class="expertises">
                        <ul>
                            <li class='should-animate remove__animate animate__smallFadeInRight'><button data-reset class="<?= !isset($_GET['search']) && !isset($_GET['expertise']) ? "is-active": ""; ?>">Alle</button></li>
                            <?php foreach($expertises as $expertise ): $current_expertises = isset($_GET['expertise']) ? $_GET['expertise'] : ''; ?>
                            <li  class='should-animate remove__animate animate__smallFadeInRight' data-delay="<?= $index * 100; ?>">
                                <button data-name="<?= $expertise->name; ?>" class="<?= in_array($expertise->name, explode(",", $current_expertises)) ? "is-active":""; ?>">
                                    <?= $expertise->name; ?>
                                </button></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                   
                </form>
                
                <?php if( $query->have_posts() ): ?>
                <div class="project-container autoload-items" data-action="on_get_projects">
                    <div class="row">
                        <?php while( $query->have_posts() ): $query->the_post(); ?>
                            <?php get_template_part('part-item', 'project'); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
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