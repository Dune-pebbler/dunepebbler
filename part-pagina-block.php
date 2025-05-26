<?php 
$afb = get_sub_field('achtergrond_afbeelding');
$color = get_sub_field('kleur_knop__cirkel');
$pagina_titel = get_sub_field('titel_pagina');
$button = get_sub_field('knop_tekst__link');
?>

<div class="col-xl-4">
  <a href="<?php echo $button['url'] ?>" target="<?php echo $button['target'] ?>" class="page-block" title="<?php echo $pagina_titel; ?>">
    <div class="overlay"></div>
    <img src="<?= $afb['sizes']['large']; ?>" alt="<?php echo $pagina_titel; ?>" loading="lazy"/>
    <div class="block-content">
      <h3><?php echo $pagina_titel; ?></h3>
      <span class="point point-<?= $color; ?>">•</span>
      <p><?php the_sub_field('omschrijving_kort'); ?></p>
      <div class="btn btn-<?= $color; ?>"><?php echo $button['title'] ?></div>
    </div>
  </a>
</div>