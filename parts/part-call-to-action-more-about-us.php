<section class="more-about-us">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-1">
                <h3 class="ml13"><?= __('Hiermee kunnen wij jou verder helpen', 'dunepebbler'); ?></h3>
    
                <div class="inner-content">
                <?php if( have_rows('product_rijen')): ?>
                    <?php while( have_rows('product_rijen')): the_row(); ?>
                    <ul>
                    <?php if( have_rows('producten')): ?>
                        <?php while( have_rows('producten') ): the_row(); ?>
                        <li class=" should-animate remove__animate animate__smallFadeInRight" data-delay="0">
                           <?php the_sub_field('product'); ?>
                        </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    </ul>
                    <?php endwhile; ?>
                <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-3 offset-lg-1">
                <?php if( get_post_type() != 'portfolio'): ?>
                <h3 class="ml13"><?= __('Bekijk ook eens onze andere expertises', 'dunepebbler'); ?>:</h3>
                
                <ul class='cta-links'>
                    <?php if( !is_page(apply_filters('wpml_object_id', 42, 'page')) ): ?>
                    <li class=" should-animate remove__animate animate__smallFadeInRight" data-delay="0">
                        <a href="<?= get_permalink(42); ?>">
                            <div class="bol strategy"></div> 
                            <span><?= __('Strategie', 'dunepebbler'); ?></span>   
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if( !is_page(apply_filters('wpml_object_id', 44, 'page')) ): ?>
                    <li class=" should-animate remove__animate animate__smallFadeInRight" data-delay="150">
                        <a href="<?= get_permalink(44); ?>">
                            <div class="bol marketing"></div> 
                            <span><?= __('Marketing', 'dunepebbler'); ?></span>   
                            
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if( !is_page(apply_filters('wpml_object_id', 46, 'page')) ): ?>
                    <li class=" should-animate remove__animate animate__smallFadeInRight" data-delay="300">
                        <a href="<?= get_permalink(46); ?>">
                            <div class="bol design"></div> 
                            <span><?= __('Design', 'dunepebbler'); ?></span>   
                            
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if( !is_page(apply_filters('wpml_object_id', 48, 'page'))): ?>
                    <li class=" should-animate remove__animate animate__smallFadeInRight" data-delay="450">
                        <a href="<?= get_permalink(48); ?>">
                            <div class="bol websites"></div> 
                            <span><?= __('Websites','dunepebbler'); ?></span>   
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if( !is_page(apply_filters('wpml_object_id', 456, 'page')) ): ?>
                    <li class=" should-animate remove__animate animate__smallFadeInRight" data-delay="600">
                        <a href="<?= get_permalink(456); ?>">
                            <div class="bol vastgoed"></div> 
                            <span><?= __('Vastgoed','dunepebbler'); ?></span>   
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php else: ?>
                <h3 class="ml13"><?= __('Terug naar het overzicht', 'dunepebbler'); ?></h3>
                <ul class='cta-links'>
                    <li class=" should-animate remove__animate animate__smallFadeInRight" data-delay="0">
                        <a href="<?= get_permalink(10); ?>">
                            <i class="fas fa-arrow-right"></i>
                            <span><?= the_post_type_name(); ?><?= __('overzicht', 'dunepebbler'); ?></span>   
                        </a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>