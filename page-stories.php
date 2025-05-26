<?php
/**
 * Template Name: Stories
 */
?><?php get_header(); ?>
<main>
  <?php
  the_post();
  $thumb = get_the_post_thumbnail_url();
  $permalink = get_the_permalink();
  $latest_news_query = new WP_Query(array('posts_per_page' => 5, 'post_type' => 'post', 'orderby' => 'post_date', 'order' => 'DESC'));
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
          <?php if (!empty(get_field('pre-titel'))) { ?>
          <h4><?php the_field('pre-titel') ?></h4>
          <?php } ?>
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
    <?php get_template_part('part-quote') ?>
  </section>
  <section class="stories">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <?php
          $query = new WP_Query();
          $query->query(array('post_type' => 'story_collection', 'posts_per_page' => 5, 'paged' => isset($_GET['pagination']) ? wp_kses_data($_GET['pagination']) : 1));
          $i = 0;
          while ($query->have_posts()): $query->the_post();
            ?>
            <div class="story">
              <a href="<?php the_permalink(); ?>" class="story-link" title="<?php the_title(); ?>">
                <h5><?php the_title(); ?></h5>
                <div class="story-image-wrapper">
                  <div class="story-overlay"></div>
                  <img src="<?php the_post_thumbnail_url('story'); ?>" alt="<?php the_title(); ?>" loading="lazy"/>
                </div>
                <div class="date-author"><?php echo get_the_date(); ?> <span class="blue">•</span> <?= __('Geschreven door:', 'dunepebbler'); ?> <?php the_field('auteur'); ?></div>
              </a>
              <div class="story-content"><?php the_field('intro'); ?></div>

              <div class="story-call-to-action">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?= __('Lees verder', 'dunepebbler'); ?></a>
              </div>
              <div class="story-footer"><p><?= __('Leestijd ca.', 'dunepebbler'); ?> <?php the_field('leestijd'); ?> <?= __('minuten', 'dunepebbler'); ?></p></div>
            </div>
            <?php
          endwhile;
          wp_reset_postdata();
          ?>

          <div class="pagination">
            <?php
            $big = 999999999; // need an unlikely integer

            echo paginate_links(array(
                'base' => add_query_arg(
                        array('pagination' => '%#%'), $permalink),
                'format' => '?pagination=%#%',
                'current' => max(1, @$_GET['pagination']),
                'total' => $query->max_num_pages
            ));
            wp_reset_postdata();
            ?> 
          </div>
        </div>
        <div class="col-xl-3 offset-xl-1 col-lg-4 sidebar">
          <div class="sidebar-block latest-news">
            <h2><?= __('Recente nieuwsberichten', 'dunepebbler'); ?></h2>
            <?php if ($latest_news_query->have_posts()): ?>
              <?php while ($latest_news_query->have_posts()): $latest_news_query->the_post(); ?>
                <a class="news-item" href="<?php the_permalink(); ?>">
                  <div class="row">
                    <div class="col-4">
                      <figure>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="" loading="lazy">
                      </figure>
                    </div>

                    <div class="col-8">
                      <div class="text">
                        <div class="flex-fix">
                          <h4><?php the_title(); ?></h4> 
                          <small><?= get_the_date('d F Y'); ?></small>
                        </div>

                      </div>
                    </div>
                  </div>
                </a>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>

          <div class="sidebar-block newsletter">
            <p><?= __('Schrijf in op onze nieuwsbrief', 'dunepebbler'); ?> </p>
            <!-- change to cf7 -->
            <?= do_shortcode('[contact-form-7 id="1092" title="Nieuwsbrief form"]'); ?>
          </div>
          <div class="sidebar-block socialize">
            <h2><?= __('Liever socializen?', 'dunepebbler'); ?></h2>
            <?php get_template_part('part-social-icons'); ?>
          </div>
          <div class="sidebar-block instafeed">
            <h2><?= __('Laatste Instagram', 'dunepebbler'); ?></h2>
            <div id="instafeed"></div>
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