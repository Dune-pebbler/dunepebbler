<?php
/**
 * template name: Contact
 */
get_header();
?>
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
            <div class="offset-md-1 col-md-5 col-12">
              <?php the_content(); ?>
            </div>
            <div class="offset-md-1 col-md-5 col-12">
              <p>
                De Maessloot 6<br>
                2231 PX Rijnsburg<br>
                (gemeente Katwijk)<br>
                <?= __('Nederland', 'dunepebbler'); ?><br>
                <a href="tel:+31714071961" class="class" title="<?= __('Bel ons!', 'dunepebbler'); ?>">+31 71 - 40 719 61</a>
              </p>
              <?php get_template_part('part-social-icons'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php get_template_part('part-quote') ?>
  </section>
  <section class="content-blocks">
    <div class="container">
      <?php
      if (have_rows('content_blokken')):
        while (have_rows('content_blokken')) : the_row();
          $img = get_sub_field('afbeelding');

          if (!empty($img)) {
            ?>
            <div class="row content-block">
              <div class="col-xl-10 offset-xl-1">
                <h3><?php the_sub_field('titel'); ?></h3>
                <hr>
              </div>
              <div class="col-xl-5 offset-xl-1">
                <?php the_sub_field('content'); ?>
              </div>
              <div class="col-xl-5">
                <img src="<?= $img['sizes']['medium_large']; ?>" alt="<?php the_title(); ?>" style='max-width: 100%;' loading="lazy">
              </div>
            </div>
            <?php
          } else {
            ?>
            <div class="row content-block">
              <div class="col-xl-10 offset-xl-1">
                <h3><?php the_sub_field('titel'); ?></h3>
                <hr>
                <?php the_sub_field('content'); ?>
              </div>
            </div>
            <?php
          }
        endwhile;
      endif;
      ?>
    </div>
  </section>
  <section class="contact">
    <div class="container">
      <div class="row">
        <div class="col-xl-10 offset-xl-1">
          <?php echo do_shortcode('[contact-form-7 id="432" title="Contact Formulier 2019"]'); ?>
        </div>
      </div>
    </div>
    <button class="btn btn-primary" id="send-contact-form">
      <span><?= __('Verstuur bericht!', 'dunepebbler'); ?> <span class="contact-send-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></span>
      <span class="thankyou-message"><?= __('Bedankt voor je sollicitatie! We nemen binnenkort contact me je op.', 'dunepebbler'); ?><span class="contact-send-arrow"><i class="fa fa-check" aria-hidden="true"></i></span></span>
    </button>
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
        <?php
        $page_id = is_row_pagina_blok_empty(get_field('pagina_blok')) ? "option" : $post->ID;
        while (have_rows('pagina_blok', $page_id)): the_row();
          get_template_part('part-pagina-block');
        endwhile;
        ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>