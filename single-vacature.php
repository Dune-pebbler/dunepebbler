<?php
// (oud);
get_header();
global $post;
?>
<main>
  <?php
  the_post();
  $thumb = get_the_post_thumbnail_url();
  $get_author_id = get_the_author_meta('ID');
  $get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));
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
        <div class="col-xl-10 offset-xl-1 col-12">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
          }
          ?>
        </div>
        <div class="<?php
        if ($post->post_type == 'post' && !empty(get_field('afbeeldingen'))): echo "col-md-6 offset-md-1";
        else: echo "col-10 offset-1 col-md-8 offset-md-2";
        endif;
        ?>">
               <?php if (!empty(get_field('pre-titel'))): ?>
            <h4><?php the_field('pre-titel') ?></h4>
          <?php endif; ?>
          <h1><?php the_title(); ?></h1>

          <?php the_content(); ?>
        </div>
        <?php if ($post->post_type == 'post'): ?>
          <?php if (have_rows('afbeeldingen')): ?>
            <div class='col-md-3 offset-md-1'>
              <?php
              while (have_rows('afbeeldingen')): the_row();
                $afbeelding = get_sub_field('afbeelding')
                ?>
                <figure class='img'>
                  <img src='<?php echo $afbeelding['url']; ?>' alt="<?php echo $afbeelding['alt']; ?>" loading="lazy" style='max-width: 100%;'/>
                </figure>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
    <?php get_template_part('part-quote') ?>
  </section>
  <section class="content-blocks">
    <div class="container">
      <?php
      if (have_rows('content_blokken')):
        while (have_rows('content_blokken')) : the_row();
          get_template_part("part-content-block");
        endwhile;
      endif;
      ?>
    </div>
  </section>
  <?php if ($post->post_type == 'vacature'): ?>
    <section class="vacature-form">
      <div class="container">
        <div class="row">
          <div class="col-xl-10 offset-xl-1">
            <?php echo do_shortcode('[contact-form-7 id="639" title="Sollicitatie formulier"]'); ?>
          </div>
        </div>
      </div>
      <button class="btn btn-primary" id="send-apply-form" disabled>
        <span>Verstuur sollicitatie! <span class="contact-send-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></span>
      </button>
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