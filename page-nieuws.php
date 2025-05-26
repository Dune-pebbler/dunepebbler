<?php
/**
 * Template Name: Nieuws
 */
?><?php get_header(); ?>
<main>
  <section class="news">
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
          <div class="filters row">
            <div class="offset-lg-3 col-lg-2 col-md-4 filter-group">
              <select name="filter-category">
                <option value="">Filter op</option>
                <option data-html="<span class='circle circle-green'></span>" value='strategie'><?= __('Strategie', 'dunepebbler'); ?></option>
                <option data-html="<span class='circle circle-magenta'></span>" value='marketing'><?= __('Marketing', 'dunepebbler'); ?></option>
                <option data-html="<span class='circle circle-purple'></span>" value='design'><?= __('Design', 'dunepebbler'); ?></option>
                <option data-html="<span class='circle circle-yellow'></span>" value='websites'><?= __('Websites', 'dunepebbler'); ?></option>
                <option data-html="<span class='circle circle-dp'></span>" value='over dune pebbler'><?= __('Over Dune Pebbler', 'dunepebbler'); ?></option>
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
            <div class="col-lg-2 col-md-4 filter-group">
              <input type='text' name='filter-post-title-content' placeholder='<?= __('Zoek nieuwsberichten', 'dunepebbler'); ?>' />
            </div>
          </div>
          <div class="row news-grid">
            <div class="grid-sizer col-lg-3"></div>
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