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
          <h1><?= __('Sorry, deze pagina is niet gevonden', 'dunepebbler'); ?></h1>
          <p><?= __('De pagina waar u naar op zoek bent kon niet gevonden worden. Misschien is de pagina verplaatst of de naam is veranderd. We raden u aan om via home opnieuw te starten. Voel u vrij om contact op te nemen als dit probleem blijft bestaan of als u echt niet kan vinden wat u zoekt!', 'dunepebbler'); ?></p>
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
          $img = get_sub_field('afbeelding'); ?>
          
          <div class="row content-block">
            <?php if (!empty($img)): ?>
              <div class="col-xl-10 offset-xl-1">
                <h3><?php the_sub_field('titel'); ?></h3>
                <hr>
              </div>
              <?php if (get_sub_field('locatie_afbeelding') == 'rechts'): ?>
                <div class="col-xl-5 offset-xl-1">
                  <?php the_sub_field('content'); ?>
                </div>
                <div class="col-xl-3">
                  <img src="<?= $img['sizes']['default-image-1-3']; ?>" alt="<?php the_title(); ?>" style="max-width: 100%;" loading="lazy">
                </div>
              <?php else: ?>
                <div class="col-xl-3 offset-xl-2">
                  <img src="<?= $img['sizes']['default-image-1-3']; ?>" alt="<?php the_title(); ?>" style="max-width: 100%;" loading="lazy">
                </div>
                <div class="col-xl-5 ">
                  <?php the_sub_field('content'); ?>
                </div>
              <?php endif; ?>
            <?php else: ?>
              <div class="col-xl-10 offset-xl-1">
                <h3><?php the_sub_field('titel'); ?></h3>
                <hr>
                <?php the_sub_field('content'); ?>
              </div>
            <?php endif;?>
            
            <?php $amount = count(get_sub_field('afbeeldingen_onder_blok')); if ( have_rows('afbeeldingen_onder_blok') ): ?>
              <div class="col-xl-10 offset-xl-1">
                <div class="overview-images row" style="margin-top: 25px;">
                <?php while ( have_rows('afbeeldingen_onder_blok') ): the_row(); $afbeelding = get_sub_field("afbeelding") ?>
                  <div class="col-12 col col-md-3">
                    <img src="<?php echo $afbeelding['url']; ?>" style="max-width: 100%;" alt="<?php the_sub_field("alt") ?>" loading="lazy"/>
                  </div>
                <?php endwhile; ?>
                </div>
              </div>
            
            <?php endif; ?>
          </div>
      <?php endwhile; endif; ?>
    </div>
  </section>
  <?php if(have_rows('sponsors')): $count = 0; $total = count(get_field('sponsors')); ?>
      <section class="vastgoed-sponsors">
          <div class="container">
            <h2>Onze klanten</h2>
            <div class="-owl-slider- owl-carousel owl-theme">
              <div class="item">
              <?php while(have_rows('sponsors')): the_row(); $afbeelding = get_sub_field('afbeelding'); $count++;?>
              
                <img src="<?php echo $afbeelding['url']; ?>" alt="<?php the_sub_field('titel'); ?>" style='max-width: 100%;' loading="lazy">
                <?php
                if ($count == $total) {
                  echo '</div>';
                } elseif ($count % 2 == 0) {
                  echo '</div><div class="item">';
                }
                endwhile; ?>
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
        while (have_rows('pagina_blok', $page_id)): the_row(); get_template_part('part-pagina-block'); endwhile; ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>