<?php
/**
 * Template Name: Projecten
 */
?><?php get_header(); ?>
<main>
  <?php
  the_post();
  $thumb = get_the_post_thumbnail_url();
  if (!empty($thumb)) {
    ?>
    <section class="video-container">
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
          <!-- <a href="<?php echo site_url(); ?>" data-toggle=".filters" class="uitgebreid-zoeken">Uitgebreid zoeken</a> -->

          <div class="row">
            <div class="col-10 offset-1 col-md-8 offset-md-2">
              <?php the_content(); ?>
            </div>
          </div>

          <div class="filters row">
            <div class="offset-lg-2 col-lg-2 col-md-4 filter-group">
              <select name="filter-category">
                <option value="">Filter op</option>
                <option data-html="<span class='circle circle-green'></span>" value='strategie'><?= __('Strategie', 'dunepebbler'); ?></option>
                <option data-html="<span class='circle circle-magenta'></span>" value='marketing'><?= __('Marketing', 'dunepebbler'); ?></option>
                <option data-html="<span class='circle circle-purple'></span>" value='design'><?= __('Design', 'dunepebbler'); ?></option>
                <option data-html="<span class='circle circle-yellow'></span>" value='websites'><?= __('Websites', 'dunepebbler'); ?></option>
              </select>
            </div>
            <div class="col-lg-2 col-md-4 filter-group">
              <select name="filter-archive">
                <option value=""><?= __('Archief', 'dunepebbler'); ?></option>
                <?php for ($i = date("Y"); $i > 2018; $i--): ?>
                  <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="col-lg-2 col-md-3 filter-group">
              <input type='text' name='filter-post-title-content' placeholder='Zoek projecten' />
            </div>
            <div class="col-md-1"><button class="btn filter-btn" onClick="window.location.reload();"><?= __('Reset', 'dunepebbler'); ?></button></div>
          </div>
        </div>
      </div>
    </div>
    <?php get_template_part('part-quote') ?>
  </section>
  <section class="projects">
    <div class="container">
      <div class="row project-grid">
        <div class="grid-sizer col-lg-6 col-xl-3 small"></div>
        <div class="loader">
          <i class="fad fa-circle-notch fa-spin"></i>
        </div>
      </div>
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