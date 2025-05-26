<?php $img = get_sub_field('afbeelding'); ?>
<?php $button = get_sub_field('button'); ?>
<?php $video = get_sub_field('video'); ?>

<div class="row content-block">
  <!-- if !empty -->
  <?php if (!empty($img) || !empty($video)): ?>
    <?php if (!empty(get_sub_field('titel'))): ?>
      <div class="col-xl-8 offset-xl-2">
        <hr>
        <h3><?php the_sub_field('titel'); ?></h3>

      </div>
    <?php endif; ?>
    <?php if (get_sub_field('locatie_afbeelding') == 'rechts'): ?>
      <div class="col-xl-4 offset-xl-2">
        <div class="flex-fix"><?php the_sub_field('content'); ?></div>
      </div>
      <div class="col-xl-4">
        <?php if (!empty($video)) { ?>
          <?= $video; ?>
        <?php } else { ?>
          <img src="<?= $img['sizes']['default-image-1-3']; ?>" alt="<?php the_title(); ?>" style="max-width: 100%; width: 100%;" loading="lazy">
        <?php } ?>
      </div>
      <!-- boven -->
    <?php elseif (get_sub_field('locatie_afbeelding') == 'boven'): ?>
      <div class="col-xl-8 offset-xl-2">
        <?php if (!empty($video)) { ?>
          <?= $video; ?>
        <?php } else { ?>
          <img src="<?= $img['sizes']['default-image-1-3']; ?>" alt="<?php the_title(); ?>" style="max-width: 100%; width: 100%;" loading="lazy">
        <?php } ?>
      </div>
      <div class="col-xl-8 offset-xl-2">
        <?php the_sub_field('content'); ?>
      </div>
      <!-- onder -->
    <?php elseif (get_sub_field('locatie_afbeelding') == 'onder'): ?>
      <div class="col-xl-8 offset-xl-2">
        <?php the_sub_field('content'); ?>
      </div>
      <div class="col-xl-8 offset-xl-2">
        <?php if (!empty($video)) { ?>
          <?= $video; ?>
        <?php } else { ?>
          <img src="<?= $img['sizes']['default-image-1-3']; ?>" alt="<?php the_title(); ?>" style="max-width: 100%; width: 100%;" loading="lazy">
        <?php } ?>
      </div>

      <!-- links -->
    <?php else: ?>
      <div class="col-xl-4 offset-xl-2">
        <?php if (!empty($video)) { ?>
          <?= $video; ?>
        <?php } else { ?>
          <img src="<?= $img['sizes']['default-image-1-3']; ?>" alt="<?php the_title(); ?>" style="max-width: 100%; width: 100%;" loading="lazy">
        <?php } ?>
      </div>
      <div class="col-xl-4 ">
        <div class="flex-fix"><?php the_sub_field('content'); ?></div>
      </div>
    <?php endif; ?>
    <!-- else empty -->
  <?php else: ?>

    <div class="col-xl-8 offset-xl-2">
      <hr>
      <h3><?php the_sub_field('titel'); ?></h3>

      <?php the_sub_field('content'); ?>
    </div>

    <!-- end empty --> 
  <?php endif; ?>

  <?php
  $image_repeater = get_sub_field('afbeeldingen_onder_blok');
  $amount = !$image_repeater ? 0 : count($image_repeater);
  if (have_rows('afbeeldingen_onder_blok')):
    ?>
    <div class="col-xl-8 offset-xl-2">
      <div class="overview-images row">
        <?php
        while (have_rows('afbeeldingen_onder_blok')): the_row();
          $afbeelding = get_sub_field("afbeelding");
          ?>
          <div class="<?php echo $amount > 2 ? "col-12 col col-md-4" : "col-12 col col-md-6"; ?>">
            <img src="<?php echo $afbeelding['url']; ?>" style="max-width: 100%;" alt="<?php the_sub_field("alt") ?>" loading="lazy"/>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if (!empty($button)) { ?>
    <div class="col-xl-8 offset-xl-2">
      <div class="button-wrapper">
        <a href="<?= $button['url']; ?>" class="btn" target="<?= $button['target']; ?>" title="<?= $button['title']; ?>"><?= $button['title']; ?></a>
      </div>
    </div>
  <?php } ?>

</div>