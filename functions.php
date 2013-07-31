<?php 
/***********************************************
* HABILITAR MENUS DE NAVEGACION
***********************************************/
if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'nav-menus' );
// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'pablocazorla' )
) );
/***********************************************
* HABILITAR POST THUMBNAILS
***********************************************/
if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );
/***********************************************
* OBTENIENDO LA URL COMPLETA DE LA THUMBNAIL
***********************************************/
function pc_thumb_url($tamagno){
$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $tamagno);
return $src[0];
}
/***********************************************/
/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );
/**/
// Insertar Breadcrumb   
function dimox_breadcrumbs() {
  //$delimiter = '&raquo;';
   $delimiter = '';
   //$ruta = bloginfo('template_url');
  $name = '<span class="invisible">Home</span>'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="crumbs">';
 
    global $post;
    $home = get_bloginfo('url');
    echo '<div class="crumbhome"><a href="' . $home . '" class="crumbhome_a">' . $name . '</a> ' . $delimiter . '</div>';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
    /*  echo $currentBefore . '';
      single_cat_title();
      echo '' . $currentAfter;*/
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
    /*  echo $currentBefore . get_the_time('d') . $currentAfter;*/
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
     /* echo $currentBefore . get_the_time('F') . $currentAfter;*/
 
    } elseif ( is_year() ) {
   /*   echo $currentBefore . get_the_time('Y') . $currentAfter;*/
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
     /* echo $currentBefore;
      the_title();
      echo $currentAfter;*/
 
    } elseif ( is_page() && !$post->post_parent ) {
   /*   echo $currentBefore;
      the_title();
      echo $currentAfter;*/
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
    /*  echo $currentBefore;
      the_title();
      echo $currentAfter;*/
 
    } elseif ( is_search() ) {
    /*  echo $currentBefore . 'Resultados de la búsqueda de &#39;' . get_search_query() . '&#39;' . $currentAfter;*/
 
    } elseif ( is_tag() ) {
  /*    echo $currentBefore . 'Posts con etiqueta &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;*/
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
   /*   echo $currentBefore . 'Posts escritos por ' . $userdata->display_name . $currentAfter;*/
 
    } elseif ( is_404() ) {
  /*    echo $currentBefore . 'Error 404' . $currentAfter;*/
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}
// fin breadcrumb
/***********************************************
* OBTENIENDO LA URL COMPLETA DE LA THUMBNAIL
***********************************************/
function storelicious_thumb_url(){
$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 200,200 ));
return $src[0];
}
/********************************************
 * If more than one page exists, return TRUE.
*********************************************/
function show_posts_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}
//Obtener la url del idioma
function get_url_idioma(){
	$args='';
    parse_str($args);
    if(function_exists('icl_get_languages')){
        $languages = icl_get_languages($args);
        if(1 < count($languages)){
            foreach($languages as $l){
               $lengua = $l['url'];
            }
			return $lengua;
        }    
    }
}
/***************************************************
 * PAGE_LINK_FN
 ***************************************************/

function page_link_fn($page_name,$real_name){

	global $wpdb;
	$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."' AND post_status = 'publish' AND post_type = 'page'");
	$link = get_page_link($page_id);
	$page_link = '<a alt ="'.$real_name.'" title ="'.$real_name.'" href="'.$link.'">'.$real_name.'</a>';
	echo $page_link;
}

function page_link_href_fn($page_name){

	global $wpdb;
	$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."' AND post_status = 'publish' AND post_type = 'page'");
	$link = get_page_link($page_id);
	echo $link;
}
/***************************************************
 * GET_TAG_LIST_FN
 ***************************************************/
 
function get_tag_list_fn($countTag,$masTemasLink,$masTemasText){
	$tags = get_tags();
	$html = '<ul>';	
	foreach ($tags as $tag){
		if($countTag > 0){
		$tag_link = get_tag_link($tag->term_id);

		$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' alt='{$tag->name} Tag' class='{$tag->slug}'>";
		$html .= "{$tag->name}</a></li>";
		}
		$countTag--;
	}
	$html .= '<li><a href='.$masTemasLink.'>'.$masTemasText.'</a></li>';
	$html .= '</ul>';
	echo $html;
}

// Nuevo avatar misterioso
add_filter('avatar_defaults', 'miavatar');
function miavatar ($avatar_defaults) {
     // Ruta a nuestra imagen (puede estar en el mismo servidor o en otro)
     $avatar = 'http://localhost/wp-content/themes/p/img/grdefault.gif';
     // Nombre de nuestro avatar
     $avatar_defaults[$avatar] = "PC";
     return $avatar_defaults;
}
//Excluir Categorias en Navegación:
function excludeCats ($nomCat){
	$excludID = get_cat_ID($nomCat);	
	$excludString = $excludID;	
	$categoriesExclud = get_categories('child_of='.$excludID); 
	foreach($categoriesExclud as $categoryEx) {	
		$excludString .= ' and '. $categoryEx->term_id;	
	}	
	return $excludString;
}
/*Quitar barra de admin */

add_filter( 'show_admin_bar', '__return_false' );

?>
