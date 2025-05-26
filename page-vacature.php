<?php
/**
 * Template Name: Vacatures
 */
?><?php get_header(); ?>
<main>
  <section class="vacatures">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
          }
          ?>
        </div>
        <div class="col-12">
          <h2><?php the_title(); ?></h2>
        </div>
        <div class="col-lg-12">
          <div class="row vacature-grid">
            <div class="grid-sizer col-lg-12"></div>
            <div class="loader">
              <i class="fad fa-circle-notch fa-spin"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>