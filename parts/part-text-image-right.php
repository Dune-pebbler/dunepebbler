<?php 
$content = get_sub_field('content');
$image = get_sub_field('afbeelding');
$is_with_padding = get_sub_field('is-with-padding');
$kind_of_background =  get_sub_field('kind_of_background');
$text_background_color = get_sub_field('tekst_background_color');
$text_alignment = get_sub_field('text-alignment');
?>

<section class="text-with-image image-right <?= $is_with_padding ? 'with-padding': ''; ?> <?= $kind_of_background; ?> <?= $text_background_color; ?>">
    <div class="background <?= get_sub_field('tekst_background_color'); ?> should-animate remove__animate <?= strpos($kind_of_background, 'three-fourth') !== false ? "animate__widthInRight75" : "animate__widthInRight"; ?>"></div>

    <div class="container">
        <div class="row">
            <?php if( $image ): ?> 
                <div class="col-12 col-lg-6 offset-xl-1 col-xl-5">
                    <div class="image should-animate remove__animate animate__widthInRight">
                        <img src="<?= get_webp($image['url']) ?>" class="fix-width" data-container=".col-xl-5" alt="<?= $image['alt']; ?>" loading="lazy">
                    </div>
                </div>
            <?php endif; ?>
            <?php if( !$image ): ?>
                <?php if( $kind_of_background == 'three-fourth-to-right' && $text_alignment == 'mid'): ?>
                    <div class="col-12 col-lg-5 offset-lg-2 col-xl-5">
                <?php else: ?>
                    <div class="col-12 col-lg-5 offset-lg-1 col-xl-4">
                <?php endif; ?>
            <?php else: ?>
                <div class="col-12 col-lg-5 offset-lg-1 col-xl-4">
            <?php endif; ?>
                <div class="text-container"
                    data-inner-animation="should-animate remove__animate animate__smallFadeInUp" 
                    data-inner-animation-on="> *">
                    <?= $content; ?>
                </div>
            </div>
        </div>
    </div>
</section>