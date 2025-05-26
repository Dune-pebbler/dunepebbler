<section class="our-location">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="text-container">
                    <?php the_sub_field('content'); ?>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="marker"
                            data-long="4.446976609889023" 
                            data-lat="52.21008076690285" 
                            data-icon="<?= get_template_directory_uri(); ?>/img/dp-icoon.png"
                            data-target="#dunpebbler-map">
                        </div>

                        <div id="dunpebbler-map" class="map should-animate remove__animate animate__smallFadeInRight" 
                            data-long="4.446976609889023" 
                            data-lat="52.21008076690285" 
                            data-map-zoom="15">
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="marker"
                            data-long="4.446976609889023" 
                            data-lat="52.21008076690285" 
                            data-icon="<?= get_template_directory_uri(); ?>/img/dp-icoon.png"
                            data-target="#parking-lot-map"></div>

                        <div class="marker"
                            data-long="4.447983895705562"
                            data-lat="52.209636248528994" 
                            data-icon="<?= get_template_directory_uri(); ?>/img/parking-lot.png"
                            data-target="#parking-lot-map">
                        </div>

                        <div id="parking-lot-map" class="map should-animate remove__animate animate__smallFadeInRight"
                            data-long="4.4472944" 
                            data-lat="52.2097531" 
                            data-map-type="satellite" 
                            data-map-zoom="18">
                        </div>
                    </div>
                </div>

                <div class="contact-options">
                    <h3 class='ml13'>Het kantoor</h3>

                    <ul>
                        <li class='should-animate remove__animate animate__smallFadeInRight'>
                            <p>De Maessloot 6 <br/> 2231 PX Rijnsburg</p>
                        </li>

                        <li class='should-animate remove__animate animate__smallFadeInRight' data-delay="400">
                            <p>+31 (0)71 - 40 719 61 <br/> info@dunepebbler.nl</p>
                        </li>

                        <li class='should-animate remove__animate animate__smallFadeInRight' data-delay="700">
                            <p>KvK 70184631 <br/> BTW NL8581.79.945B01</p>
                        </li>

                        <li class='should-animate remove__animate animate__smallFadeInRight' data-delay="900">
                            <p>Maandag t/m Vrijdag <br /> 09.00 t/m 17.00</p>
                        </li>
                     
                        <li class='should-animate remove__animate animate__smallFadeInRight' data-delay="1000">
                        <a href="https://www.google.nl/maps/dir//Dune+Pebbler,+De+Maessloot+6,+2231+PX+Rijnsburg/@52.2100808,4.4447859,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x47c5c751788c5c3b:0x9dda05dac8d23fb!2m2!1d4.4469752!2d52.2100778" target="_blank" class="btn">
                Plan mijn route</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>