<?php
/**
 * Template Name: USP pagina
 */
?>
<?php
get_header();

$title = $post->post_name;
$title = $title == 'website' ? 'websites' : $title;
$bg_title = $title == 'marketing' ? "{$title}-bg" : $title;
$preTitle = get_field('pre-titel');

if (ICL_LANGUAGE_CODE == 'en') {
  if ($title == 'strategy') {
    $title = 'strategie';
    $bg_title = 'strategie';
  }
}
?>

<main>
  <section class="usp-content">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 offset-xl-2">
          <div class="<?php echo $title; ?>-item autoplay">
            <div class="<?php echo $title; ?>-icon-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $bg_title; ?>.svg" class="core-icon svg" alt="<?php the_title(); ?>" />
              <?php if ($title == "strategie" || $title == 'strategy'): ?>
                <div class="ball"></div>
              <?php elseif ($title == 'marketing'): ?>
                <div class="text-block-wrap">
                  <div class="text-1"></div>
                  <div class="text-2"></div>
                  <div class="text-3"></div>
                  <div class="text-4"></div>
                </div>
              <?php elseif ($title == 'design'): ?>
                <div class="shape"></div>
              <?php elseif ($title == 'websites'): ?>
                <div class="code"><img src="<?php echo get_template_directory_uri(); ?>/img/code.svg" alt="code"></div>
                <div class="square square1"></div>
                <div class="square square2"></div>
                <div class="square square3"></div>
              <?php endif; ?>
            </div>
          </div>
          <?php //if (!empty($preTitle)) { ?>
          <h4><?= $preTitle; ?></h4>
          <?php //} ?>
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
    <!-- <div class="scroll-downs">
      <div class="mousey">
        <div class="scroller"></div>
      </div>
    </div> -->
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
  <?php
  if (ICL_LANGUAGE_CODE == 'nl') {
    ?>
    <section class="projects">
      <div class="container">
        <h3> <?php the_title(); ?> <?= __('gerelateerde projecten', 'dunepebbler'); ?> </h3>
        <div class="row project-grid ignore">
          <!-- <div class="grid-sizer col-lg-4"></div> -->
          <?php
          $query = new WP_Query(array(
              'post_type' => 'portfolio',
              'posts_per_page' => 3,
              'tax_query' => array(
                  array(
                      'taxonomy' => 'category',
                      'field' => 'name',
                      'terms' => get_the_title(),
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

        <a href="/projecten" class="btn btn-default btn-center"><?= __('Projecten overzicht', 'dunepebbler'); ?></a>
      </div>
    </section>
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