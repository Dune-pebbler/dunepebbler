<?php 
$textfields = get_sub_field('textfields'); 

if( !empty($textfields) ):?>
<section class="project-summary">
    <div class="background should-animate remove__animate animate__widthInRight60"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 offset-lg-1">
                <div class="text-container">
                    <?= $textfields[0]['content']; ?>
                </div>
            </div>
            <div class="col-12 col-lg-2 offset-lg-3">
                <div class="text-container">
                    <?= $textfields[1]['content']; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>