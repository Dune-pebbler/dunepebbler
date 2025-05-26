<?php 
$url = get_sub_field('url');
$is_youtube = strpos($url, 'youtube');
$parse_url = parse_url( $url );

if( $is_youtube && !empty( $parse_url['query'] )){
    $parsed_query;
    
    parse_str( $parse_url['query'], $parsed_query);

    if( isset( $parsed_query['v'] ) ){
        $url = "https://www.youtube.com/embed/{$parsed_query['v']}";
    }
}
?>
<section class="online-video should-animate remove__animate animate__widthInRight" >
    <iframe src="<?= $url; ?>" frameborder="0" class="fix-width" data-container=".online-video" ></iframe>
</section>