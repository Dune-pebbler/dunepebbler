<?php get_header(); ?>
<main class="theme-dunepebbler-color">
  
<section class="intro-content-new">
    <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6 offset-lg-1">
            <div class="content">
                <?php if( $pretitel = get_field('pre-titel') ): ?>
                    <h4 class='pre-headline ml13' data-delay="100"><?= $pretitel; ?></h4>
                <?php endif; ?>
                <h1 class="ml13"><?= __('Zoeken naar:', 'search'); ?> <?php the_search_query(); ?></h1>

                <div class="inner-content" 
                    data-inner-animation="should-animate remove__animate animate__smallFadeInUp" 
                    data-inner-animation-on="> *">
                    <?php if( !have_posts() ): ?>
                      <p><?= __('We hebben geen resultaten kunnen vinden.', 'dunepebbler'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if( have_posts() ): ?>
<section class="small-vacatures">
    <div class="container"> 
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                  <?php while( have_posts() ): the_post(); ?>
                    <div class="col-12 col-lg-6 should-animate remove__animate animate__smallFadeInRight animate__animated" data-delay="200">
                      <a href="<?php the_permalink(); ?>" class="vacature-item theme-dunepebbler">
                          <h3 class="ml13" ><?php the_title(); ?></h3>
                      
                          <div class="after-titel">
                              <p class="ml13"><?php the_post_type_name(); ?></p>
                              <p class='ml13'><?= __('Gepubliceerd op:', 'dunepebbler'); ?>  <?= date_i18n('d F Y', get_the_date("U")); ?></p>
                          </div>

                          <div class="description">
                              <?= wpautop(get_the_excerpt()); ?>
                          </div>

                          <div class="plus-sign">+</div>
                      </a>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                  </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
</main>
<?php get_footer(); ?>