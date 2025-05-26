<?php
//  (oud)
get_header();
global $post;
$cats = get_the_terms($post->ID, 'category');
$projects = get_projects();
$project_position = array_search($post, $projects['query']->posts);

$previous_project_position = ( $project_position > 0 ) ? $project_position - 1 : -1;
$next_project_position = ( $project_position < count($projects['query']->posts) - 1 ) ? $project_position + 1 : false;
?>
<main>
  <?php
  the_post();
  $thumb = get_the_post_thumbnail_url();
  if (!empty($thumb)) :
    ?>
    <section class="video-container half-height">
      <img src="<?php the_post_thumbnail_url('header'); ?>" loading="lazy"/>
      <div class="video-content">
        <h2><?php the_field('header_titel'); ?></h2>
      </div>
      <!-- <div class="scroll-downs">
        <div class="mousey">
          <div class="scroller"></div>
        </div>
      </div> -->
    </section>
  <?php endif; ?>
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
        <div class="col-12">
          <h1><?php the_title(); ?></h1>
          <ul class="categories">
            <?php foreach ($cats as $index => $cat) : ?>
              <li>
                <?php echo "{$cat->name}"; ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <ul class="category-colors">
            <?php foreach ($cats as $cat) : ?>
              <li class="<?php echo $cat->slug; ?>"><a href="<?php echo site_url($cat->slug); ?>"></a></li>
            <?php endforeach; ?>
          </ul>
          <div class="row">
            <div class="col-xl-8 offset-xl-2 col-12">
              <?php the_content(); ?>
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
          get_template_part('part-content-block');
        endwhile;
      endif;
      ?>
    </div>
  </section>
  <section class="project-navigation">
    <div class="container">
      <div class="centered row">
        <div class="previous block col-12 offset-sm-1 col-sm-3">
          <?php if ($previous_project_position >= 0): $id = $projects['query']->posts[$previous_project_position]->ID; ?>
            <a href="<?php echo get_the_permalink($id); ?>"><i class="fal fa-arrow-left"></i> <?php echo get_the_title($id); ?></a>
          <?php endif; ?>
        </div>

        <div class="back-to block col-12 col-sm-4">
          <a href="/projecten" class='btn'> Naar projectoverzicht</a>
        </div>
        <?php if ($next_project_position): $id = $projects['query']->posts[$next_project_position]->ID; ?>
          <div class="next block col-12 col-sm-3">
            <a href="<?php echo get_the_permalink($id); ?>"> <?php echo get_the_title($id); ?> <i class="fal fa-arrow-right"></i></a>
          </div>
        <?php endif; ?>
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
        while (have_rows('pagina_blok', $page_id)) {
          the_row();
          $afb = get_sub_field('achtergrond_afbeelding');
          $color = get_sub_field('kleur_knop__cirkel');
          $button = get_sub_field('knop_tekst__link');
          ?>
          <div class="col-xl-4">
            <a href="<?php echo $button['url'] ?>" class="page-block" title="<?php the_sub_field('titel_pagina'); ?>">
              <div class="overlay"></div>
              <img src="<?= $afb['sizes']['large']; ?>" alt="<?php the_sub_field('titel_pagina'); ?>" loading="lazy"/>
              <div class="block-content">
                <h3><?php the_sub_field('titel_pagina'); ?></h3>
                <span class="point point-<?= $color; ?>">•</span>
                <p><?php the_sub_field('omschrijving_kort'); ?></p>
                <div class="btn btn-<?= $color; ?>"><?php echo $button['title'] ?></div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>