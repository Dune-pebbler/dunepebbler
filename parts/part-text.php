<?php 
$content = get_sub_field('content');
$image = get_sub_field('afbeelding');
$is_with_padding = get_sub_field('is-with-padding');
$kind_of_background =  get_sub_field('kind_of_background');
$text_background_color = get_sub_field('tekst_background_color');
$text_alignment = get_sub_field('text-alignment');
$textfields = get_sub_field('textfields');
?>

<?php  if( have_rows('textfields') ): ?>
<section class="text-with-image textfields-only <?= $is_with_padding ? 'with-padding': ''; ?> <?= $kind_of_background; ?> <?= $text_background_color; ?>">
    <div class="background <?= $text_background_color; ?> should-animate remove__animate <?= strpos($kind_of_background, 'three-fourth') !== false ? "animate__widthInRight75" : "animate__widthInRight"; ?>"></div>

    <div class="container">
        <div class="row">
            <?php while( have_rows('textfields') ): the_row(); ?>
            <?php 
            $class_name = get_row_index() % 2 == 0 ? "col-lg-5" : "col-lg-5 offset-lg-1";
            $class_name = count( $textfields ) == 1 ? 'col-lg-8 offset-lg-2' : $class_name; 
            ?>
            <div class="col-12 <?= $class_name; ?>">
                <div class="text-container"
                    data-inner-animation="should-animate remove__animate animate__smallFadeInUp" 
                    data-inner-animation-on="> *">
                    <?php the_sub_field('content'); ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>