<?php
/**
 * Template Name: Homepage
 */
?>
<?php
get_header();
$title = $post->post_name;
$preTitle = get_field('pre-titel');
?>
<main>
  <section class="new-video-container home">
    <?php $vimeo_desktop = get_field('vimeo_code_desktop'); ?>
    <?php $vimeo_mobile = get_field('vimeo_code_mobiel'); ?>
    <?php if (!empty($vimeo_desktop) || !empty($vimeo_mobile)): ?>
      <!-- <div id="vimeo" class="banner home">
        <div class="loader">
          <i class="fad fa-circle-notch fa-spin"></i>
        </div>
        <iframe data-src="https://player.vimeo.com/video/<?php echo $vimeo_desktop; ?>?autoplay=1&muted=1&controls=0&loop=true" width="1920" height="1080" frameborder="0" allowfullscreen="true" title="Dune Pebbler"></iframe>
      </div> -->
      <div class="video banner home">
        <video preload="metadata" loop autoplay playsinline muted>
            <source src="<?= get_field('video')['url']; ?>" type="video/webm"></source>
            <source src="<?= str_replace(".webm", ".mp4", get_field('video')['url']); ?>" type="video/mp4"></source>
        </video>
      </div>
      <script type="text/javascript">
        jQuery(window).on('load', function () {
          // hide loader
          jQuery('#vimeo .loader').stop().fadeOut();
        });
      </script>
    <?php else: ?>
      <img src="<?php echo get_template_directory_uri(); ?>/img/header-bg.jpg" loading="lazy"/>
    <?php endif; ?>
    <div class="overlay-video"></div>
    <div class="video-content">
      <h2><?php the_field('header_titel'); ?></h2>
      <div class="bullets">
        <div class="bullet bullet-green"></div>
        <div class="bullet bullet-magenta"></div>
        <div class="bullet bullet-purple"></div>
        <div class="bullet bullet-yellow"></div>
      </div>
    </div>
    <div class="scroll-downs">
      <div class="mousey">
        <div class="scroller"></div>
      </div>
    </div>
  </section>
  <section class="intro-content home">
    <div class="container">
      <div class="row">
        <div class="col">
          <?php if (!empty($preTitle)) { ?>
            <h4><?= $preTitle; ?></h4>
          <?php } ?>
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
  <section class="core-values">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
          <a href="/strategie" class="core-value-item strategie-item" title="<?= __('Lees meer', 'dunepebbler'); ?>">
            <div class="strategie-icon-wrap">
              <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/strategie.svg" class="core-icon svg" alt=" <?= __('Strategie', 'dunepebbler'); ?>" />
              <div class="ball"></div>
            </div>
            <h5><?= __('Strategie', 'dunepebbler'); ?></h5>
            <p><?php the_field('strategie_tekst'); ?></p>
            <div class="plus-sign">+</div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
          <a href="/marketing" class="core-value-item marketing-item" title="<?= __('Lees meer', 'dunepebbler'); ?>">
            <div class="marketing-icon-wrap">
              <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/marketing-bg.svg" class="core-icon svg" alt="Marketing" />
              <div class="text-block-wrap">
                <div class="text-1"></div>
                <div class="text-2"></div>
                <div class="text-3"></div>
                <div class="text-4"></div>
              </div>
            </div>
            <h5><?= __('Marketing', 'dunepebbler'); ?></h5>
            <p><?php the_field('marketing_tekst'); ?></p>
            <div class="plus-sign">+</div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
          <a href="/design" class="core-value-item design-item" title="<?= __('Lees meer', 'dunepebbler'); ?>">
            <div class="design-icon-wrap">
              <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/design.svg" class="core-icon svg" alt="Design" />
              <div class="shape"></div>
            </div>
            <h5><?= __('Design', 'dunepebbler'); ?></h5>
            <p><?php the_field('design_tekst'); ?></p>
            <div class="plus-sign">+</div>
          </a>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
          <a href="/websites" class="core-value-item websites-item" title="<?= __('Lees meer', 'dunepebbler'); ?>">
            <div class="websites-icon-wrap">
              <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/websites.svg" class="core-icon svg" alt="Websites" />
              <div class="code"><img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/code.svg" alt="code" /></div>
              <div class="square square1"></div>
              <div class="square square2"></div>
              <div class="square square3"></div>
            </div>
            <h5><?= __('Websites', 'dunepebbler'); ?></h5>
            <p><?php the_field('websites_tekst'); ?></p>
            <div class="plus-sign">+</div>
          </a>
        </div>
      </div>
    </div>
  </section>
  <?php if (ICL_LANGUAGE_CODE == 'nl') { ?>
    <section class="story">
      <?php $achtergrond_afbeelding = get_field('achtergrond_afbeelding'); ?>
      <img loading="lazy" src="<?php echo $achtergrond_afbeelding['url']; ?>" loading="lazy" class="story-placeholder" alt="<?php echo $achtergrond_afbeelding['alt']; ?>" />
      <div class="container">
        <div class="row">
          <div class="col-md-4 order-md-1 col-xl-5 order-xl-1">
            <?php $storyImg = get_field('afbeelding_rechts'); ?>
            <img loading="lazy" src="<?= $storyImg['sizes']['story-home']; ?>" loading="lazy" class="story-person" alt="<?php the_field('titel_story'); ?>" />
          </div>
          <div class="col-md-8 offset-md-0 order-md-0 col-xl-4 offset-xl-2 order-xl-0">
            <div class="story-content">
              <h3><?php the_field('titel_story'); ?></h3>
              <hr class="bol-<?php the_field('kleur_bolletje') ?>">
              <p><?php the_field('omschrijving'); ?></p>
              <?php $storyBtn = get_field('link'); ?>
              <div class="center">
                <a href="<?= $storyBtn['url'] ?>" class="btn btn-<?php the_field('kleur_button') ?>" target="<?= $storyBtn['target']; ?>" title="<?= $storyBtn['title']; ?>"><?= $storyBtn['title']; ?></a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } else { ?>
    <div class="story-spacer"></div>
  <?php } ?>
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