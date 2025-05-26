<?php
$args = [
    'post_type' => 'portfolio',
    'posts_per_page' => 3,
    'post__not_in' => [get_the_ID()]
];

// vastgoed pagina
if( get_the_ID() == 456 ){
    $args['meta_query'] = [
        [
            'key' => 'vastgoed_project',
            'value' => '1',
        ]
    ];
} else {
    
    $args['tax_query'] = [
        [
            'taxonomy' => 'category',
            'field' => 'name',
            'terms' => get_post_type() != 'portfolio' ? get_the_title() : wp_list_pluck(get_the_terms(get_the_ID(), 'category'), "name"),
        ]
    ];
}

$query = new WP_Query($args);
?>


<?php if( ICL_LANGUAGE_CODE != 'en' ): ?>
<section class="projects">
    <div class="container">
        <?php if( is_type('portfolio') || is_blog() ): ?>
            <h3 class='ml13' data-delay="0"> <?= __('Gerelateerde projecten', 'dunepebbler'); ?> </h3>
        <?php else: ?>
            <h3 class='ml13' data-delay="0"> <?php the_title(); ?> <?= __('gerelateerde projecten', 'dunepebbler'); ?> </h3>
        <?php endif; ?>
        <div class="row project-grid ignore">
            <?php
            while ($query->have_posts()): $query->the_post();
            $categories = get_the_terms(get_the_ID(), 'category');

            $project_class = 'col-lg-4 small';
            $project_class .= $query->post_count <= 1 ? 'offset-lg-4' : '';
            $project_class .= $query->post_count <= 2 && $query->post_count > 1 ? 'offset-lg-2' : '';
          
            ?>
            <div class="<?= $project_class; ?> should-animate remove__animate animate__smallFadeInRight" data-delay="<?= 300 * $query->current_post; ?>">
                <div class="project" style="background-image: url('<?= get_webp(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
                <div class='project-flex-holder'>
                    <div class="project-overlay"></div>
                    <h5><?php the_title(); ?></h5>
                    
                    <ul class="categories">
                        <?php foreach ($categories as $category) : ?>
                            <li>
                                <?= $category->name; ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                    <ul class="category-colors">
                        <?php foreach ($categories as $category): ?>
                            <li class="<?php echo $category->slug; ?>"></li>
                        <?php endforeach; ?>
                    </ul>

                    <a href="<?php the_permalink(); ?>" class="btn btn-project" title="<?php the_title(); ?>"><?= __('Bekijk het project', 'dunepebbler'); ?></a>
                </div>
                </div>

                <!-- we use this for our filtering -->
                <div class="filter-category filter" style='display: none;'>
                    <?php foreach ($categories as $category) : ?>
                        <?= "{$category->name},"; ?>
                    <?php endforeach; ?>
                </div>
               
                <div class="filter-archive" style='display: none;'>
                    <?= get_the_date("Y"); ?>
                </div>
                <div class="filter-post-title-content" style='display: none;'>
                    <?php
                    the_title();
                    the_content();
                    ?>
                </div>
            </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php endif; ?>