<section class="simple-slider">
    <div class="background should-animate remove__animate animate__widthInRight"></div>
    <div class="container">
        <div class="col-12 col-lg-10 offset-lg-1">
            <?php if( $titel = get_sub_field('content') ): ?>
            <h2 class="ml13" data-delay="750"><?= $titel; ?></h2>
            <?php endif; ?>
            <div class="custom-slider-nav">
                <button class="prev should-animate remove__animate animate__smallFadeInRight"  data-delay="750">
                    <i class="fal fa-arrow-left"></i>
                </button>

                <ul>
                    <li class="should-animate remove__animate animate__smallFadeInRight is-placeholder" data-delay="900"></li>
                </ul>
                <button class="next should-animate remove__animate animate__smallFadeInRight" data-delay="1300">
                    <i class="fal fa-arrow-right"></i>
                </button>
            </div>
            <?php if( have_rows('slides')): ?>
                <div class="slider-target owl-carousel owl-theme should-animate remove__animate animate__widthInRight" data-delay="750">
                <?php while( have_rows('slides')): the_row(); ?>
                <div class="slide">
                    <div class="image">
                        <?php if( $image = get_sub_field('afbeelding')): ?>
                            <img src="<?= get_webp($image['url']); ?>" alt="" loading="lazy">
                        <?php endif; ?>
                    </div>

                    <div class="content" data-inner-animation>
                        <?php the_sub_field('content'); ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>