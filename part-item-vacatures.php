<?php // (oud); ?>
<div class="grid-item <?php echo $vacClass; ?>" id="vacature-item-<?php the_ID() ; ?>">
  <a href="<?php the_permalink(); ?>" class="vacature-item">
    <div class="vacature-content">
      <?php if ($afbeelding = get_field('uitgelichte_afbeelding')): ?>
        <img src="<?php echo $afbeelding['sizes']['story-home']; ?>" loading="lazy"/>
      <?php elseif(has_post_thumbnail()): ?>
        <img src="<?php the_post_thumbnail_url('story-home'); ?>" loading="lazy"/>
      <?php endif; ?>    
      <div class="overlay">
        <div class="center-content">
          <h5><?php the_title(); ?></h5>
<!--          <p><?php// echo get_the_date("j F Y"); ?></p>-->
          <span href="<?php the_permalink(); ?>" class="btn btn-vacature" title="<?php the_title(); ?>"><?= __('Bekijk vacature', 'dunepebbler'); ?></span>
        </div>
      </div>
    </div>
  </a>
</div>