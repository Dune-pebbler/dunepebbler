<?php
/**
* Template Name:IP
*/
?>
<?php get_header(); ?>

<main class="theme-dunepebbler-color">
<?php if( $post_thumbnail_id = get_post_thumbnail_id() ): ?>
<section class="banner-white">
    <!-- we keep this empty. -->
</section>
<?php else: ?>
  <section class="no-banner-new"></section>
<?php endif; ?>

<section class="intro-content-new">
    <div class="container">
        <div class="row">
            <?php if( $post_thumbnail_id = get_post_thumbnail_id() ): ?>
                <div class="col-12 col-lg-10 offset-lg-1 remove-relative">
                    <div class="image fix-translate should-animate remove__animate animate__widthInRight" data-translate-container=".intro-content-new">
                        
                        <img loading="lazy" src="<?= get_webp(wp_get_attachment_image_src($post_thumbnail_id, 'full')[0]); ?>" class="fix-width" data-container=".col-12"  alt="<?php the_title(); ?> uitgelichte afbeelding">
                    </div>
                </div>
            <?php endif; ?>

            <?php if( ($position = get_field('introductie_uitlijning')) == 'left' ): ?>
                <div class="col-12 col-lg-6 offset-lg-1">
            <?php else: ?>
                <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <?php endif; ?>
                <div class="content">
                    <?php if( $pretitel = get_field('pre-titel') ): ?>
                        <h4 class='pre-headline ml13' data-delay="100"><?= $pretitel; ?></h4>
                    <?php endif; ?>
                    <h1 class="ml13"><?php the_title(); ?></h1>

                    <div class="inner-content" 
                        data-inner-animation="should-animate remove__animate animate__smallFadeInUp" 
                        data-inner-animation-on="> *">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><section class="text-with-image textfields-only with-padding full-width theme-color">
  <div class="background theme-color should-animate remove__animate animate__widthInRight"></div>

  <div class="container">
    <div class="row">
      <div class="col-12 offset-lg-3 col-lg-6">
        <div class="text-container"
            style="width: 100%;"
            data-inner-animation="should-animate remove__animate animate__smallFadeInUp" 
            data-inner-animation-on="> *">
            
            
            <h2><?=  __('Jouw IP-adres:', 'dunepebbler'); ?> <strong><?php echo $_SERVER['REMOTE_ADDR'] ?></strong></h2>
            <p>
              <br/>
            
              Browser: <strong class="browserversion"></strong>
            
              <br/>
            
              OS: <strong> <?= get_current_user_os(); ?></strong>
            
              <br/>
            
              ISP: <strong><?= gethostbyaddr($_SERVER['REMOTE_ADDR']); ?></strong>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  
<?php get_footer();?>