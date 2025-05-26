<?php
/**
 * Template Name: Over ons
 */
?>
<?php get_header(); ?>
<main>
  <?php
  the_post();
  $thumb = get_the_post_thumbnail_url();
  if (!empty($thumb)) {
    ?>
    <section class="video-container half-height">
      <img src="<?php the_post_thumbnail_url('header'); ?>" loading="lazy"/>
      <div class="video-content">
        <h2><?php the_field('header_titel'); ?></h2>
      </div>
      <div class="scroll-downs">
        <div class="mousey">
          <div class="scroller"></div>
        </div>
      </div>
    </section>
  <?php } ?>
  <section class="intro-content">
    <div class="container">
      <div class="row">
        <div class="col">
          <h4><?php the_field('pre-titel') ?></h4>
          <h1><?php the_title(); ?></h1>
          <div class="row">
            <div class="col-10 offset-1 col-md-8 offset-md-2">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="core-value-icons">
    <div class="container">
      <div class="row">
        <?php
        while (have_rows('kernwaarden')) : the_row();
          $core_icon = get_sub_field('icoon_kernwaarden');
          $core_title = get_sub_field('titel_kernwaarden');
          ?>
          <div class="col"> 
            <div class="core-icon">
              <img src="<?= $core_icon['url']; ?>" alt="<?= $core_title; ?>" loading="lazy">
            </div>
            <p class="core-title"><?= $core_title; ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
  <section class="content-blocks">
    <?php get_template_part('part-quote') ?>
    <div class="container">
      <?php
      if (have_rows('content_blokken')):
        while (have_rows('content_blokken')) : the_row();
          $img = get_sub_field('afbeelding');
          if (!empty($img)) {
            ?>
            <div class="row content-block">
              <div class="col-xl-10 offset-xl-1">
              <hr>
                <h3><?php the_sub_field('titel'); ?></h3>
                
              </div>
              <div class="col-xl-5 offset-xl-2">
                <?php the_sub_field('content'); ?>
              </div>
              <div class="col-xl-5">
                <img src="<?= $img['sizes']['medium_large']; ?>" alt="<?php the_title(); ?>" loading="lazy">
              </div>
            </div>
            <?php
          } else {
            ?>
            <div class="row content-block">
              <div class="col-xl-12">
                <div class="wide-content">
                <hr>
                  <h3><?php the_sub_field('titel'); ?></h3>
                  
                  <?php the_sub_field('content'); ?>
                </div>
              </div>
            </div>
            <?php
          }
        endwhile;
      endif;
      ?>
    </div>
  </section>
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
        while (have_rows('pagina_blok', $page_id)): the_row(); get_template_part('part-pagina-block'); endwhile; ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>