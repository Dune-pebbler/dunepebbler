<ul class="social-media">
  <?php if( $linked_in = get_field('linkedin', 'option') ): ?>
    <li><a href="<?php echo $linked_in; ?>" target="_blank" title="DunePebbler Linkedin"><i class="fab fa-linkedin"></i></a></li>
  <?php endif; ?>
  <?php if( $facebook = get_field('facebook', 'option') ): ?>
    <li><a href="<?php echo $facebook; ?>" target="_blank" title="DunePebbler Facebook"><i class="fab fa-facebook-f"></i></a></li>
  <?php endif; ?>
  <?php if( $twitter = get_field('twitter', 'option') ): ?>
    <li><a href="<?php echo $twitter; ?>" target="_blank" title="DunePebbler Twitter"><i class="fab fa-twitter"></i></a></li>
  <?php endif; ?>
  <?php if( $instagram = get_field('instagram', 'option') ): ?>
    <li><a href="<?php echo $instagram; ?>" target="_blank" title="DunePebbler Instagram"><i class="fab fa-instagram"></i></a></li>
  <?php endif; ?>
  <?php if( $youtube = get_field('youtube', 'option') ): ?>
    <li><a href="<?php echo $youtube; ?>" target="_blank" title="DunePebbler Youtube"><i class="fab fa-youtube"></i></a></li> 
  <?php endif; ?>
</ul>