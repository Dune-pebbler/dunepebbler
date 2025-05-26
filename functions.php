<?php
# defines
define('THEME_TD', 'dunepebbler');

# globals

# actions
add_action('upload_mimes', 'add_file_types_to_uploads');
add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
add_action('wp_ajax_nopriv_on_get_projects', 'get_projects');
add_action('wp_ajax_on_get_projects', 'get_projects');
add_action('wp_ajax_nopriv_on_get_news', 'get_nieuws');
add_action('wp_ajax_on_get_news', 'get_nieuws');
add_action('wp_ajax_nopriv_get_vacatures', 'get_vacatures');
add_action('wp_ajax_get_vacatures', 'get_vacatures');
add_action('admin_enqueue_scripts', 'theme_admin_scripts');
add_action('manage_post_posts_custom_column', 'theme_populate_columns');
add_action('manage_story_collection_posts_custom_column', 'theme_populate_columns');


# filters
add_filter('wp_page_menu_args', 'home_page_menu_args');
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
add_filter('the_content', 'remove_thumbnail_dimensions', 10);
add_filter('the_content', 'add_image_responsive_class');
add_filter('use_block_editor_for_post', '__return_false');
add_filter('manage_edit-post_columns', 'theme_extra_column', 20);
add_filter('manage_edit-story_collection_columns', 'theme_extra_column', 20);
add_filter('wpseo_breadcrumb_links', 'theme_filter_wpseo_links_posts', 10, 1);
add_filter('wpseo_breadcrumb_links', 'theme_filter_wpseo_links_projects', 10, 1);
add_filter('wpseo_breadcrumb_links', 'theme_filter_wpseo_links_stories', 10, 1);
add_filter('body_class', function ($classes) {
  global $post;

  return array_merge($classes, [sanitize_title(get_the_title()), "page-slug-{$post->post_name}"]);
});
# theme supports
add_theme_support('menus');
add_theme_support('post-thumbnails', array('post', 'page', 'portfolio', 'story_collection', 'vacature', 'nieuws-bericht')); // array for post-thumbnail support on certain post-types.

# image sizes
add_image_size('default-thumbnail', 128, 128, true); // true: hard crop or empty if soft crop
add_image_size('header', 1920, 1080, true); // true: hard crop or empty if soft crop
add_image_size('story-home', 795, 936, true); // true: hard crop or empty if soft crop
add_image_size('portret', 700, 1000, true); // true: hard crop or empty if soft crop
add_image_size('story', 1070, 420, true); // true: hard crop or empty if soft crop
add_image_size('large', 1920, 620, true); // true: hard crop or empty if soft crop
add_image_size('default-image-1-3', 530, 353, true);
set_post_thumbnail_size(128, 128, true);

# functions
function theme_extra_column($columns_array)
{
  $n_columns_array = [];

  foreach ($columns_array as $key => $column) {
    $n_columns_array[$key] = $column;
    if ($key == 'title')
      $n_columns_array['is-spotlight'] = 'In de spotlight?';
  }

  // remember that you can add this column at any place you want with array_slice() function
  return $n_columns_array;
}

function theme_populate_columns($column_name)
{
  if ($column_name !== 'is-spotlight') {
    return;
  }

  echo get_field('is_spotlight') ? "Ja" : "Nee";
}




function theme_admin_scripts()
{
  wp_enqueue_style('theme-admin-css', get_template_directory_uri() . '/stylesheets/admin.min.css');
  wp_enqueue_script('theme-admin-js', get_template_directory_uri() . '/js/admin.js');
}

function home_page_menu_args($args)
{
  $args['show_home'] = true;
  return $args;
}

function remove_thumbnail_dimensions($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

function remove_width_attribute($html)
{
  $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
  return $html;
}

function add_image_responsive_class($content)
{
  global $post;
  $pattern = "/<img(.*?)class=\"(.*?)\"(.*?)>/i";
  $replacement = '<img$1class="$2 img-responsive"$3>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types)
{

  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes);

  return $file_types;
}

function ds_admin_theme_style()
{
  if (!current_user_can('manage_options')) {
    echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none; }</style>';
  }
}

function print_pre($print)
{
  echo '<pre>';
  print_r($print);
  echo '</pre>';
}

function is_row_pagina_blok_empty($row)
{
  $is_empty = true;

  foreach ($row as $values) {
    foreach ($values as $key => $value) {
      // ignore this one
      if ($key == "kleur_knop__cirkel")
        continue;
      // ignore if it is empty
      if (empty($value))
        continue;

      // we have a value
      $is_empty = false;

      // break the foreaches
      break 2;
    }
  }

  return $is_empty;
}

function get_projects()
{
  $results = [];
  $args = [
    'post_type' => 'portfolio',
    'posts_per_page' => 10,
    'post_status' => 'publish',
    'paged' => $_REQUEST['index']
  ];

  if (isset($_REQUEST['filters']['categories'])) {

    $args['tax_query'][] = [
      'taxonomy' => 'expertises',
      'field' => 'name',
      'terms' => $_REQUEST['filters']['categories']
    ];
  }

  if (isset($_REQUEST['filters']['search'])) {
    $args['meta_query'][] = [
      'value' => wp_kses_data($_REQUEST['filters']['search']),
      'compare' => 'LIKE',
    ];
  }

  $query = new WP_Query($args);
  $results['query'] = $query;

  // start the buffer
  ob_start();

  // query the results
  while ($query->have_posts()):
    $query->the_post();
    get_template_part('part-item', 'project');
  endwhile;
  wp_reset_postdata();


  if (defined('DOING_AJAX') && DOING_AJAX) {
    echo json_encode([
      'args ' => $args,
      'html' => ob_get_clean()
    ]);
    exit;
  }

  // clean the buffer
  ob_clean();

  return $results;
}

function get_nieuws()
{
  $results = [];
  $args = [
    'post_type' => ['news', 'story_collection'],
    'posts_per_page' => 10,
    'post_status' => 'publish',
    'paged' => $_REQUEST['index']
  ];

  if (isset($_REQUEST['filters']['categories'])) {

    $args['tax_query'][] = [
      'taxonomy' => 'expertises',
      'field' => 'name',
      'terms' => $_REQUEST['filters']['categories']
    ];
  }

  if (isset($_REQUEST['filters']['search'])) {
    $args['meta_query'][] = [
      'value' => wp_kses_data($_REQUEST['filters']['search']),
      'compare' => 'LIKE',
    ];
  }

  $query = new WP_Query($args);
  $results['query'] = $query;

  // start the buffer
  ob_start();

  // query the results
  while ($query->have_posts()):
    $query->the_post();
    get_template_part('part-item', 'nieuws');
  endwhile;
  wp_reset_postdata();


  if (defined('DOING_AJAX') && DOING_AJAX) {
    echo json_encode([
      'args ' => $args,
      'html' => ob_get_clean()
    ]);
    exit;
  }

  // clean the buffer
  ob_clean();

  return $results;
}

function get_vacatures()
{
  $type = "vacature";
  $query = new WP_Query(array(
    'post_type' => 'vacature',
    'posts_per_page' => -1,
    'post_status' => 'publish'
  ));
  $i = 0;

  // start the buffer
  ob_start();

  // query the results
  while ($query->have_posts()):
    $query->the_post();
    $i++;
    $vacClass = ($i % 2 == 0) ? 'col-xl-6 col-lg-6 col-md-12 small' : 'col-xl-6 col-lg-6 col-md-12 small';

    include(get_template_directory() . '/part-item-vacatures.php');

  endwhile;
  wp_reset_postdata();

  echo json_encode(array(
    'html' => ob_get_clean()
  ));
  exit;
}

function theme_filter_wpseo_links_posts($links)
{
  $correct_links = array();
  $news_page_id = 20; // @jelle voer hier je id in..
  // check if we are on news
  if (get_post_type() == 'post' && is_single()) {
    // reshape the array
    foreach ($links as $index => $link) {
      $new_index = $index == 0 ? $index : $index + 1;
      $correct_links[$new_index] = $link;
    }
    // push the news page
    $correct_links[1] = array(
      'url' => get_the_permalink($news_page_id),
      'text' => get_the_title($news_page_id),
      'id' => $news_page_id
    );
  } else {
    // we do nothin!
    $correct_links = $links;
  }
  // sort the array correctly
  ksort($correct_links);
  // make filter magic happen here... 
  return $correct_links;
}

function theme_filter_wpseo_links_projects($links)
{
  $correct_links = array();
  $news_page_id = 10; // @jelle voer hier je id in..
  // check if we are on news
  if (get_post_type() == 'portfolio' && is_single()) {
    // reshape the array
    foreach ($links as $index => $link) {
      $new_index = $index == 0 ? $index : $index + 1;
      $correct_links[$new_index] = $link;
    }
    // push the news page
    $correct_links[1] = array(
      'url' => get_the_permalink($news_page_id),
      'text' => get_the_title($news_page_id),
      'id' => $news_page_id
    );
  } else {
    // we do nothin!
    $correct_links = $links;
  }
  // sort the array correctly
  ksort($correct_links);
  // make filter magic happen here... 
  return $correct_links;
}

function theme_filter_wpseo_links_stories($links)
{
  $correct_links = array();
  $news_page_id = 12; // @jelle voer hier je id in..
  // check if we are on news
  if (get_post_type() == 'story_collection' && is_single()) {
    // reshape the array
    foreach ($links as $index => $link) {
      $new_index = $index == 0 ? $index : $index + 1;
      $correct_links[$new_index] = $link;
    }
    // push the news page
    $correct_links[1] = array(
      'url' => get_the_permalink($news_page_id),
      'text' => get_the_title($news_page_id),
      'id' => $news_page_id
    );
  } else {
    // we do nothin!
    $correct_links = $links;
  }
  // sort the array correctly
  ksort($correct_links);
  // make filter magic happen here... 
  return $correct_links;
}

function language_selector_flags()
{
  $languages = icl_get_languages('skip_missing=0');
  if (!empty($languages)) {
    foreach ($languages as $l) {
      if ($l['language_code'] == ICL_LANGUAGE_CODE) {
        echo '<li class="lang lang-active">';
      } else {
        echo '<li class="lang">';
      }
      echo '<a href="' . $l['url'] . '" class="icon text-center">';
      echo '<img src="' . get_bloginfo('template_url') . '/assets/lang/' . $l['language_code'] . '.png" class="img-vertical-responsive" loading="lazy"/>';
      echo '</a>';
      echo '</li>';
    }
  }
}

function get_div_tag_by_alignment($alignment, $kind_of_background, $has_image = false)
{

  return '<div class="col-12 col-lg-6 col-xl-6">';
}

function get_image_div_tag_by_alignment($alignment, $kind_of_background, $has_image = false)
{

  return '<div class="col-12 col-lg-5 offset-lg-1 offset-xl-2  col-xl-4">';
}

function extract_titel($html)
{
  $document = new DOMDocument();
  $document->loadHTML("<html><body>{$html}</body></html>");

  foreach ($document->getElementsByTagName('h2') as $element) {
    return $element->nodeValue;
  }

  foreach ($document->getElementsByTagName('h3') as $element) {
    return $element->nodeValue;
  }

}

function get_current_user_os()
{
  $agent = $_SERVER['HTTP_USER_AGENT'];

  if (preg_match('/Linux/', $agent))
    $os = 'Linux';
  elseif (preg_match('/Win/', $agent))
    $os = 'Windows';
  elseif (preg_match('/Mac/', $agent))
    $os = 'Mac';
  else
    $os = 'UnKnown';

  return $os;
}

function the_post_type_name()
{
  $mapper = [
    'post' => __('Nieuws', 'dunepebbler'),
    'story_collection' => __('Stories', 'dunepebbler'),
    'portfolio' => __('Project', 'dunepebbler'),
    'page' => __('Pagina', 'dunepebbler'),
  ];

  echo isset($mapper[get_post_type()]) ? $mapper[get_post_type()] : ucfirst(get_post_type());
}

function is_blog()
{
  $blog_types = [
    'post',
    'story_collection'
  ];
  return in_array(get_post_type(), $blog_types);
}

function is_type($name)
{
  return get_post_type() === $name;
}

if (!function_exists('get_webp')) {
  function get_webp($url)
  {
    if (!is_string($url))
      return $url;
    $webp_url = str_replace(site_url(), getcwd(), $url);
    $webp_url = str_replace([".jpg", ".png"], [".webp", ".webp"], $webp_url);
    // $file_exists = file_get_contents( $webp_url );

    if (!file_exists($webp_url)) {
      return $url;
    }

    return str_replace([".jpg", ".png"], [".webp", ".webp"], $url);
  }
}

function my_acf_google_map_api($api)
{
  $api['key'] = '';
  return $api;
}

# gibberish.... 
register_nav_menus(array(
  'home' => __('Home', 'dunepebbler'),
  'wat' => __('Wat we doen Menu', 'dunepebbler'),
  'wie' => __('Wie we zijn Menu', 'dunepebbler'),
  'rest' => __('Overig Menu', 'dunepebbler'),
  'footer' => __('Footer Menu', 'dunepebbler'),
  'footer-rechts' => __('Footer Menu rechts', 'dunepebbler'),
));

if (function_exists('acf_add_options_sub_page')) {
  acf_add_options_page();
  acf_add_options_sub_page('Social media');
  acf_add_options_sub_page('Footer');
  acf_add_options_sub_page('Standaard waardes');
  acf_add_options_sub_page('Referenties');
  acf_add_options_sub_page('Popup');
}

// add editor the privilege to edit theme
// get the the role object
$role_object = get_role('editor');
// add $cap capability to this role object
$role_object->add_cap('edit_theme_options');