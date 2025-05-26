<?php
/**
 * Template Name: Referenties
 */
?><?php get_header(); ?>
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
            <div class="col-xl-8 offset-xl-2">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php get_template_part('part-quote') ?>
  </section>
  <section class="references">
    <div class="container">
      <div class="row">
        <?php
        while (have_rows('referenties', 'option')) {
          the_row();
          $img_ref = get_sub_field('logo');
          //print_pre($img_ref);
          ?>
          <div class="reference-col col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <a href="<?php the_sub_field('website'); ?>" class="reference" target="_blank">
              <img src="<?= $img_ref['url']; ?>" class="ref-img" alt="<?php the_sub_field('naam'); ?> logo" loading="lazy"/>
            </a>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </section>
  <section class="content-blocks">
    <div class="container">
      <?php
      if (have_rows('content_blokken')):
        while (have_rows('content_blokken')) : the_row();
          $img = get_sub_field('afbeelding');
          ?>

          <div class="row content-block">
            <?php if (!empty($img)): ?>
              <div class="col-xl-10 offset-xl-1">
                <h3><?php the_sub_field('titel'); ?></h3>
                <hr>
              </div>
              <?php if (get_sub_field('locatie_afbeelding') == 'rechts'): ?>
                <div class="col-xl-5 offset-xl-2">
                  <div class="flex-fix">
                    <?php the_sub_field('content'); ?>
                  </div>
                </div>
                <div class="col-xl-5">
                  <img src="<?= $img['sizes']['default-image-1-3']; ?>" alt="<?php the_title(); ?>" style="max-width: 100%;" loading="lazy">
                </div>
              <?php else: ?>
                <div class="col-xl-3 offset-xl-2">
                  <img src="<?= $img['sizes']['default-image-1-3']; ?>" alt="<?php the_title(); ?>" style="max-width: 100%;" loading="lazy">
                </div>
                <div class="col-xl-5 ">
                  <div class="flex-fix">
                    <?php the_sub_field('content'); ?>
                  </div>

                </div>
              <?php endif; ?>
            <?php else: ?>
              <div class="col-xl-8 offset-xl-2">
                <h3><?php the_sub_field('titel'); ?></h3>
                <hr>
                <?php the_sub_field('content'); ?>
              </div>
            <?php endif; ?>

            <?php
            $amount = count(get_sub_field('afbeeldingen_onder_blok'));
            if (have_rows('afbeeldingen_onder_blok')):
              ?>
              <div class="col-xl-8 offset-xl-2">
                <div class="overview-images row" style="margin-top: 25px;">
                  <?php
                  while (have_rows('afbeeldingen_onder_blok')): the_row();
                    $afbeelding = get_sub_field("afbeelding")
                    ?>
                    <div class="col-12 col col-md-4">
                      <img src="<?php echo $afbeelding['url']; ?>" style="max-width: 100%;" alt="<?php the_sub_field("alt") ?>" loading="lazy"/>
                    </div>
                  <?php endwhile; ?>
                </div>
              </div>

            <?php endif; ?>
          </div>
          <?php
        endwhile;
      endif;
      ?>
    </div>
  </section>
  <?php if (get_the_ID() == 456): ?>
    <section class="projects">
      <div class="container">
        <h3> <?php the_title(); ?> <?= __('gerelateerde projecten', 'dunepebbler'); ?> </h3>
        <div class="row project-grid ignore">
          <!-- <div class="grid-sizer col-lg-4"></div> -->
          <?php
          $query = new WP_Query(array(
              'post_type' => 'portfolio',
              'posts_per_page' => 3,
              'meta_query' => array(
                  array(
                      'key' => 'vastgoed_project',
                      'value' => '1',
                  )
              )
          ));
          $i = 0;
          while ($query->have_posts()): $query->the_post();
            $cats = get_the_terms($post->ID, 'category');
            $i++;
            if ($query->current_post == 0) {
              $projectClass = $query->post_count < 2 ? 'col-lg-4 offset-lg-4 small' : 'col-lg-4 small';
              $projectClass = $query->post_count < 3 ? 'col-lg-4 offset-lg-2 small' : $projectClass;
            } else {
              $projectClass = 'col-lg-4 small';
            }
            ?>
            <div class="<?= $projectClass; ?>">
              <div class="project" style="background-image: url('<?php the_post_thumbnail_url('large'); ?>');">
                <div class='project-flex-holder'>
                  <div class="project-overlay"></div>
                  <h5><?php the_title(); ?></h5>
                  <ul class="categories">
                    <?php foreach ($cats as $cat) { ?>
                      <li>
                        <?php echo $cat->name; ?>
                      </li>
                    <?php } ?>
                  </ul>
                  <ul class="category-colors">
                    <?php foreach ($cats as $cat) { ?>
                      <li class="<?php echo $cat->slug; ?>"></li>
                    <?php } ?>
                  </ul>
                  <a href="<?php the_permalink(); ?>" class="btn btn-project" title="<?php the_title(); ?>"><?= __('Bekijk het project', 'dunepebbler'); ?></a>
                </div>
              </div>

              <!-- we use this for our filtering -->
              <div class="filter-category filter" style='display: none;'>
                <?php
                foreach ($cats as $cat) {
                  echo "{$cat->name},";
                }
                ?>
              </div>
              <div class="filter-archive" style='display: none;'>
                <?php echo get_the_date("Y"); ?>
              </div>
              <div class="filter-post-title-content" style='display: none;'>
                <?php
                the_title();
                the_content();
                ?>
              </div>
            </div>
            <?php
          endwhile;
          wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <?php
  if (have_rows('sponsors')): $count = 0;
    $total = count(get_field('sponsors'));
    ?>
    <section class="vastgoed-sponsors">
      <div class="container">
        <h2>Onze klanten</h2>
        <div class="-owl-slider- owl-carousel owl-theme">
          <div class="item">
            <?php
            while (have_rows('sponsors')): the_row();
              $afbeelding = get_sub_field('afbeelding');
              $count++;
              ?>

              <img src="<?php echo $afbeelding['url']; ?>" alt="<?php the_sub_field('titel'); ?>" style='max-width: 100%;' loading="lazy">
              <?php
              if ($count == $total) {
                echo '</div>';
              } elseif ($count % 2 == 0) {
                echo '</div><div class="item">';
              }
            endwhile;
            ?>
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