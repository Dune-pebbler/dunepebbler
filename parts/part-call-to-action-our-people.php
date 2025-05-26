<?php if( have_rows('our_people')): ?>
<section class="our-people">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-9 offset-lg-1">
                <div class="row">
                    <?php while( have_rows('our_people')): the_row(); ?>
                    <?php
                    $author = get_sub_field('person');
                    $email = $author->user_email;
                    $first_name = $author->user_firstname;
                    $last_name = $author->user_lastname;
                    $avatar_url = get_avatar_url($author->ID, ['size' => 383]); 
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="people-item should-animate remove__animate animate__smallFadeInUp" data-delay="<?= get_row_index() * 200; ?>">
                            <div class="image">
                                <img src="<?= $avatar_url; ?>" alt="" loading="lazy">
                            </div>

                            <div class="content">
                                <div class="titel">
                                    <?php if( $functie = get_user_meta($author->ID, 'functie', true)): ?>
                                        <p class='ml13'><?= $functie; ?></p>
                                    <?php endif; ?>
                                    <h3 class='ml13'><?= "{$first_name} {$last_name}"; ?></h3>
                                </div>

                                <div class="contact-option">
                                    <?php if( $phone = get_user_meta($author->ID, 'telefoonnummer', true) ): ?>
                                        <a href="tel: <?= get_user_meta($author->ID, 'telefoonnummer', true); ?>" class='should-animate remove__animate animate__smallFadeInUp'>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <span><?= get_user_meta($author->ID, 'telefoonnummer', true); ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <a href="mailto: <?= $email; ?>" class='should-animate remove__animate animate__smallFadeInUp' data-delay="500">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <span><?= $email; ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>