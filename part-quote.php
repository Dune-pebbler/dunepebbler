<?php if (!empty(get_field('quote'))): ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <blockquote>
          <?php the_field('quote'); ?>

          <?php if( $cite = get_field('cite') ): ?>
            <cite><?php echo $cite; ?></cite>
          <?php endif; ?>
        </blockquote>
      </div>
    </div>
  </div> 
<?php endif; ?>