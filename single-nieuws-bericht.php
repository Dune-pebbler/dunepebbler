<?php
/*
 * Template name: Standard pagina (2022)
 * Template Post Type: post, page, vacature, portfolio, story_collection
 */


/**
 * @version .01 
 * @author Raphael Meijer <raphael@dunepebbler.nl> 
 * @description 
 * @messageFromAuthor: We will continue to work on this templating.
 * It will always be a work of progres. It shouldn't be to advanced nor should it be to simple.
 */
get_header();
?>
<main class="theme-<?= get_field('theme_color'); ?>-color">
  <?php if ($post_thumbnail_id = get_post_thumbnail_id()): ?>
    <section class="banner-white">
      <!-- we keep this empty. -->
    </section>
  <?php else: ?>
    <section class="no-banner-new"></section>
  <?php endif; ?>

  <section class="intro-content-new">
    <div class="container">
      <div class="row">
        <?php if ($post_thumbnail_id = get_post_thumbnail_id()): ?>
          <div class="col-12 col-lg-10 offset-lg-1 remove-relative">
            <div class="image fix-translate should-animate remove__animate animate__widthInRight"
              data-translate-container=".intro-content-new">
              <img loading="lazy" src="<?= get_webp(wp_get_attachment_image_src($post_thumbnail_id, 'full')[0]); ?>"
                class="fix-width" data-container=".col-12" alt="<?php the_title(); ?> uitgelichte afbeelding">
            </div>
          </div>
        <?php endif; ?>

        <?php if (($position = get_field('introductie_uitlijning')) == 'left'): ?>
          <div class="col-12 col-lg-6 offset-lg-1">
          <?php else: ?>
            <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <?php endif; ?>
            <div class="content">
              <?php if ($pretitel = get_field('pre-titel')): ?>
                <h4 class='pre-headline ml13' data-delay="100"><?= $pretitel; ?></h4>
              <?php endif; ?>
              <?php if (is_blog()): ?>
                <h4 class='pre-headline ml13' data-delay="100"><?php the_post_type_name(); ?> | Door
                  <?php the_author(); ?> | <?= date_i18n("d F Y", get_the_date("U")); ?>
                </h4>

              <?php endif; ?>
              <h1 class="ml13"><?php the_title(); ?></h1>

              <div class="inner-content" data-inner-animation="should-animate remove__animate animate__smallFadeInUp"
                data-inner-animation-on="> *">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <?php
  if (have_rows('sections')):
    while (have_rows('sections')):
      the_row();
      $type = get_sub_field('type_section');

      get_template_part('parts/part', $type);

    endwhile;
  endif;

  ?>
</main>
<?php get_footer(); ?>