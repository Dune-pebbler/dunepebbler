<section class="detailed-slider">
    <?php if( $image = get_sub_field('afbeelding') ): ?>
    <div class="background-image should-animate remove__animate animate__fadeInCenter">
        <img src="<?= get_webp($image['url']); ?>"  alt="" loading="lazy">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-xl-4 offset-xl-1">
                <div class="floating-box should-animate remove__animate animate__smallFadeInUp" data-delay="300">
                    <?php if($titel = get_sub_field('titel')): ?>
                        <h3 class="ml13"><?= $titel; ?></h3>
                    <?php endif; ?>
                    <?php if( have_rows('slides')): ?>
                    <ul>
                        <?php while( have_rows('slides') ): the_row(); ?>
                        <li class='<?= get_row_index() == 1 ? 'is-active': ''; ?>'>
                            <button class='ml13' data-delay="<?= get_row_index() * 100; ?>">
                            <?php if( $titel = get_sub_field('titel')): ?>
                                <?= $titel; ?>    
                            <?php else: ?>
                                <?= extract_titel(get_sub_field('content')); ?>
                            <?php endif; ?>
                            </button>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-md-5 offset-md-1 col-xl-4 offset-xl-2">
                <?php if( have_rows('slides')): ?>
                <div class="text-containers">
                    <?php while( have_rows('slides') ): the_row(); ?>
                    <div class="text-container <?= get_row_index() == 1 ? 'is-active': ''; ?>" 
                        data-inner-animation="should-animate remove__animate animate__smallFadeInRight" 
                        data-inner-animation-on="> *">
                        <?php the_sub_field('content'); ?>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
        
        </div>
    </div>
</section>