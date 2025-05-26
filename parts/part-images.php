<?php
$alignment = get_sub_field('afbeeldingen_uitlijning');
$images = get_sub_field('afbeeldingen');
$is_single = $images && count($images) === 1;
?>

<?php if( have_rows('afbeeldingen') ): ?>
<section class="images">
    <?php if( $alignment == 'full-width' ): ?>
    <div class="max-container"> 
        <?php while( have_rows('afbeeldingen')): the_row(); ?>

            <?php if( $image = get_sub_field('afbeelding') ): ?>
                <div class="image should-animate remove__animate animate__widthInRight">
                    <img src="<?= $image['url']; ?>" class="fix-width" data-container=".image" alt="">
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
        <?php if( $is_single ): ?>
        <div class="black backdrop should-animate remove__animate animate__widthInRight"></div>
        <div class="container"> 
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <?php while( have_rows('afbeeldingen')): the_row(); ?>
        
                        <?php if( $image = get_sub_field('afbeelding') ): ?>
                            <div class="image should-animate remove__animate animate__widthInRight">
                                <img src="<?= $image['url']; ?>" class="fix-width" data-container=".image" alt="">
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="container"> 
            <div class="row">
                <?php while( have_rows('afbeeldingen')): the_row(); ?>
                    <div class="col-12 col-lg-4">
                        <?php if( $image = get_sub_field('afbeelding') ): ?>
                            <div class="image should-animate remove__animate animate__smallFadeInRight">
                                <img src="<?= $image['url']; ?>" class="fix-width" data-container=".image" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php endif; ?>