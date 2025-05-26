<?php 
$email = (!empty( get_field('email') ) ) ? get_field('email') : "ivo@dunepebbler.nl" ;
$title = (!empty( get_field('linker_titel') ) ) ? get_field('linker_titel') : "Zullen we eens kennismaken?" ;
?>

<div class="col-xl-5 offset-xl-2">
  <div class="acquaintance-container">
    <h3><?php echo $title; ?></h3>
    <ul class="acquaintance">
      <li><a href="tel:+31714071961" title="<?= __('Bel ons!', 'dunepebbler'); ?>"><i class="fa fa-phone"></i> 071-40 719 61</a></li>
      <li><a href="mailto:<?php echo $email; ?>" title="<?= __('Mail Ons!', 'dunepebbler'); ?>"><i class="fas fa-envelope"></i> <?php echo $email; ?></a></li>
    </ul>
  </div>
</div>
<div class="col-xl-3">
  <div class="socialize">
    <h3><?= __('Liever socializen?', 'dunepebbler'); ?></h3>
    <?php get_template_part('part-social-icons'); ?>
  </div>
</div>