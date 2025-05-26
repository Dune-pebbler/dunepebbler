<?php
$author = get_sub_field('auteur');
$email = $author['user_email'];
$first_name = $author['user_firstname'];
$avatar_url = get_avatar_url($author['ID'], ['size' => 150]); 
?>

<section class="contactperson">
    <div class="background should-animate remove__animate animate__widthInRight"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1 col-xl-6 offset-xl-3">
                <div class="inner-contactperson">
                    <div class="image should-animate remove__animate animate__fadeInRight" data-delay="1000">
                        <img src="<?= get_webp($avatar_url); ?>" alt="" loading="lazy">
                    </div>

                    <div class="content">
                        <h3 class='ml13' data-delay="1500">
                            <?php if( $titel = get_sub_field('titel') ): ?>
                                <?= $titel; ?>
                            <?php elseif(get_post_type() === 'portfolio'): ?>
                                <?= __('Meer weten over dit project? Neem dan contact op', THEME_TD); ?>
                            <?php else: ?>
                                <?= __('Meer weten over', 'dunepebbler'); ?> <?php the_title(); ?>
                            <?php endif; ?>
                        </h3>

                        <p>
                            <span class="should-animate remove__animate animate__smallFadeInRight" data-delay="1500">
                            <?= __('Bel', 'dunepebbler'); ?> <?= $first_name; ?> 
                            <a href="tel:+3171 - 40 719 61">071 - 40 719 61</a> , 
                            <?= __('stuur een', 'dunepebbler'); ?> 
                            <a href="mailto:<?= $email;?>"><?= __('mail', 'dunepebbler'); ?></a> <?= __('of kom langs.', 'dunepebbler'); ?>     
                            </span>
                            <small class="should-animate remove__animate animate__smallFadeInRight" data-delay="1800">
                            <!-- <?= __('Of laat een verzoek achter en wij nemen contact met jou op.', 'dunepebbler'); ?> -->
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>