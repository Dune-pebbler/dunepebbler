<?php
$query = new WP_Query([
    'post_type' => 'vacature',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);
?>

<section class="small-vacatures">
    <div class="container"> 
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="titel should-animate remove__animate animate__smallFadeInUp" >
                    <?= str_replace(['{vacature-amount}'], ["<span class=''>$query->found_posts</span>"], get_sub_field('content')); ?>
                </div>
                <div class="row">
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="col-12 col-lg-6 should-animate remove__animate animate__smallFadeInRight" data-delay="<?= ($query->current_post + 1) * 200; ?>">
                        <a href="<?php the_permalink(); ?>" class="vacature-item theme-<?= get_field('thema_kleur'); ?>">
                            <h3 class='ml13'><?php the_title(); ?></h3>
                        
                            <div class="after-titel">
                                <p class='ml13'><?php the_field('tijd_per_week'); ?></p>
                                <p  class='ml13'><?php the_field('opleidingsniveau'); ?></p>
                            </div>

                            <div class="description">
                                <?php the_field('intro'); ?>
                            </div>

                            <div class="plus-sign">+</div>
                        </a>
                    </div>
                    <?php endwhile; wp_reset_postdata();?>
                </div>
            </div>
        </div>
    </div>
</section>