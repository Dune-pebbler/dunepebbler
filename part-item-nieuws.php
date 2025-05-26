<?php
$expertises = get_the_terms(get_the_ID(), 'expertises');
$category = get_the_terms(get_the_ID(), 'category');
$expertises_names = wp_list_pluck($expertises, 'name');
$category_names = wp_list_pluck($category, 'name');
$category_names_strings = implode(" | ", $category_names);
?>
<div class="col-12 col-lg-6 should-animate remove__animate animate__smallFadeInUp">
    <a href="<?php the_permalink(); ?>" class="project">
        <?php if (has_post_thumbnail()): ?>
            <div class="image">
                <img src="<?= get_webp(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>"
                    alt="<?php the_title(); ?>" />
            </div>
        <?php endif; ?>

        <div class="content">
            <p class='customer'><?= date_i18n("d F Y", get_the_date("U")); ?></p>
            <h3><?php the_title(); ?></h3>

        </div>
    </a>
</div>