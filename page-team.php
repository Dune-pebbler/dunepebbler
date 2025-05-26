<?php
/**
 * Template Name: Ons team
 */
?><?php get_header(); ?>
<main class="theme-dunepebbler-color">
  <?php if( $post_thumbnail_id = get_post_thumbnail_id() ): ?>
    <section class="banner-white">
        <!-- we keep this empty. -->
    </section>
  <?php else: ?>
    <section class="no-banner-new"></section>
  <?php endif; ?>

<section class="intro-content-new">
    <div class="container">
        <div class="row">
            <?php if( $post_thumbnail_id = get_post_thumbnail_id() ): ?>
                <div class="col-12 col-lg-10 offset-lg-1 remove-relative">
                    <div class="image fix-translate should-animate remove__animate animate__widthInRight" data-translate-container=".intro-content-new">
                        <img loading="lazy" src="<?= get_webp(wp_get_attachment_image_src($post_thumbnail_id, 'full')[0]); ?>" class="fix-width" data-container=".col-12"  alt="<?php the_title(); ?> uitgelichte afbeelding">
                    </div>
                </div>
            <?php endif; ?>

            <?php if( ($position = get_field('introductie_uitlijning')) == 'left' ): ?>
                <div class="col-12 col-lg-6 offset-lg-1">
            <?php else: ?>
                <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <?php endif; ?>
                <div class="content">
                    <?php if( $pretitel = get_field('pre-titel') ): ?>
                        <h4 class='pre-headline ml13' data-delay="100"><?= $pretitel; ?></h4>
                    <?php endif; ?>
                    <?php if( is_blog() ): ?>
                        <h4 class='pre-headline ml13' data-delay="100"><?php the_post_type_name(); ?> | <?php _e('Door', THEME_TD); ?> <?php the_author(); ?> | <?= date_i18n("d F Y", get_the_date("U")); ?></h4>

                    <?php endif; ?>
                    <h1 class="ml13"><?php the_title(); ?></h1>

                    <div class="inner-content" 
                        data-inner-animation="should-animate remove__animate animate__smallFadeInUp" 
                        data-inner-animation-on="> *">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (have_rows('teamplayers')): ?>
  <section class="team">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
          <div class="row grid">
            <?php
            while (have_rows('teamplayers')): the_row();
              $photo = get_sub_field('portret_foto');
              ?>
              <div class="col-lg-6 grid-item">
                <div class="team-member">
                  <img src="<?= $photo['sizes']['portret']; ?>" alt="<?php the_sub_field('naam'); ?>" loading="lazy"/>
                  <div class="member-name-block background-<?php the_sub_field('categorie'); ?>">
                    <h3><?php the_sub_field('naam'); ?></h3>
                    <p class="function-title"><?php the_sub_field('functietitel'); ?></p>
                    <a class="less-more" title="Lees meer"><?= __('More +', 'dunepebbler'); ?></a>
                  </div>
                  <div class="member-content">
                    <div class="member-content-block background-<?php the_sub_field('categorie'); ?>">
                      <!-- <h4><?php the_sub_field('pre-titel'); ?></h4>
                      <h3><?php the_sub_field('titel'); ?></h3> -->
                      <hr>
                      <p><?php the_sub_field('stukje_over'); ?></p>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
            <div class="grid-sizer"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
<section class="social">
  <div class="container">
    <div class="row">
      <?php get_template_part('part-social'); ?>
    </div>
  </div>
</section>
<section class="page-blocks">
  <div class="container-fluid">
    <div class="row row-no-padding">
      <?php $page_id = is_row_pagina_blok_empty(get_field('pagina_blok')) ? "option" : $post->ID;
      while (have_rows('pagina_blok', $page_id)): the_row();
        get_template_part('part-pagina-block');
      endwhile;
      ?>
    </div>
  </div>
</section>
</main>
<?php get_footer(); ?>