<?php

/**
 * 
 * Custom Slider Template
 */
 
 if (function_exists('childtheme_override_mk_slider_template'))  {
	
	function mk_slider_template() {
			childtheme_override_mk_slider_template();
		}
	} else {	
 
	function mk_slider_template(){
	
	global $post,$wp_query;
	
	if( get_theme_mod( 'mk_show_default_slider',true) && is_front_page() ):
	
	$out ='';
	$out .='<div id="mkBgSlider" class="mk-header-slider">'."\n";
	$out .='<div class="slides-container">'."\n";
		
	if(get_theme_mod( 'mk_slide_1_image', get_template_directory_uri() . '/images/slides/slide1.jpg') ):
	$out .='<div class="slideItem" style="background-image:url('.esc_url( get_theme_mod( 'mk_slide_1_image',get_template_directory_uri() . '/images/slides/slide1.jpg' ) ).');"></div>'."\n";
	endif;
	if(get_theme_mod( 'mk_slide_2_image', get_template_directory_uri() . '/images/slides/slide2.jpg') ):
	$out .='<div class="slideItem" style="background-image:url('.esc_url( get_theme_mod( 'mk_slide_2_image',get_template_directory_uri() . '/images/slides/slide2.jpg' ) ).');"></div>'."\n";
	endif;
	if(get_theme_mod( 'mk_slide_3_image', get_template_directory_uri() . '/images/slides/slide3.jpg') ):
	$out .='<div class="slideItem" style="background-image:url('.esc_url( get_theme_mod( 'mk_slide_3_image',get_template_directory_uri() . '/images/slides/slide3.jpg' ) ).');"></div>'."\n";
	endif;
	$out .='</div>'."\n";	
	
	$out .='<span class="mk-slider-mask"></span>'."\n";
	
	$out .='<div class="mkFlexSlider">'."\n";
	$out .='<div class="flexSlider">'."\n";
	$out .='<div class="slides">'."\n";
	
	if(get_theme_mod( 'mk_slide_1_image', get_template_directory_uri() . '/images/slides/slide1.jpg') ):
	$out .='<article>'."\n";
	$out .='<div>'."\n";
	$out .='<h2 class="mainCaption">'.esc_attr(get_theme_mod('mk_slide1_caption', 'We are MK Theme')).'</h2>'."\n";
	$out .='<p class="subCaption">'.esc_attr(get_theme_mod('mk_slide1_subcaption', 'We make beautiful things happen!')).'</p>'."\n";
	$out .='</div> <a href="'.esc_url(get_theme_mod('mk_slide1_url', '#')).'" class="btn btn-lg btn-success">'.esc_attr(get_theme_mod('mk_slide1_btntext', 'Learn more')).'</a>'."\n";
	$out .='</article>'."\n";
	endif;
	
	if(get_theme_mod( 'mk_slide_2_image', get_template_directory_uri() . '/images/slides/slide2.jpg') ):
	$out .='<article>'."\n";
	$out .='<div>'."\n";
	$out .='<h2 class="mainCaption">'.esc_attr(get_theme_mod('mk_slide2_caption', 'Stylish free Wordpress Theme')).'</h2>'."\n";
	$out .='<p class="subCaption">'.esc_attr(get_theme_mod('mk_slide2_subcaption', 'Optimized for mobile devices, clean w3C validated markup')).'</p>'."\n";
	$out .='</div> <a href="'.esc_url(get_theme_mod('mk_slide2_url', '#')).'" class="btn btn-lg btn-success">'.esc_attr(get_theme_mod('mk_slide2_btntext', 'Learn more')).'</a>'."\n";
	$out .='</article>'."\n";
	endif;
	
	if(get_theme_mod( 'mk_slide_3_image', get_template_directory_uri() . '/images/slides/slide3.jpg')):
	$out .='<article>'."\n";
	$out .='<div>'."\n";
	$out .='<h2 class="mainCaption">'.htmlspecialchars_decode(get_theme_mod('mk_slide3_caption', 'Get more with MK <br/>proffessional Version')).'</h2>'."\n";
	$out .='<p class="subCaption">'.esc_attr(get_theme_mod('mk_slide3_subcaption', 'Premium sliders, page composer, unlimited layouts...')).'</p>'."\n";
	$out .='</div> <a href="'.esc_url(get_theme_mod('mk_slide3_url', '#')).'" class="btn btn-lg btn-success">'.esc_attr(get_theme_mod('mk_slide3_btntext', 'Learn more')).'</a>'."\n";
	$out .='</article>'."\n";
	endif;
	
	$out .='</div>'."\n";
	$out .='</div>'."\n";
	$out .='</div>'."\n";
	$out .='</div>'."\n";
	
	echo $out;
	
	endif;
	
	}
	
	}
	
	add_action('mk_page_wrapper_before','mk_slider_template');
	
	
/**
 * Theme post thumbnail.
 ** Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
 
function mk_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php the_post_thumbnail('mk-wide');?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
	<?php the_post_thumbnail('mk-wide');?>
	</a>

	<?php endif; // End is_singular()
}

/**
 * Implements custom header feature in our theme
 *
 */
 
 if (function_exists('childtheme_override_lnt_custom_header_feature'))  {
	
	function mk_custom_header_feature() {
			childtheme_override_lnt_custom_header_feature();
		}
	} else {	
 
function mk_custom_header_feature(){

global $post, $wp_query;

// Check to see if the header image has been removed
$header_image = get_header_image();

$img_width = get_custom_header()->width;
$img_height = get_custom_header()->height;
				
$out ='';

if(get_theme_mod( 'mk_show_custom_header_image',true) == true ) :

	$out .='<header class="mk-single-top text-center header-'.strtolower(get_theme_mod( 'mk_blog_layout','classic')).'">'."\n";
	$out .='<span class="mk-single-top-overlay-mask"></span>'."\n";
				
				
						$header_image_width = get_theme_support( 'custom-header', 'width' );
					
			//$out .='<a href="'.esc_url( home_url( '/' ) ).'">'."\n";
			
					// The header image
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
							$image[1] >= $header_image_width ) :
						// Houston, we have a new header image!
						$thumb = get_post_thumbnail_id();
						$image = wp_get_attachment_url( $thumb,'full' ); 
						$out .='<img class="mk-header-image" src="'.$image.'" alt="'.esc_attr( get_bloginfo( 'name', 'display' )).'" />'."\n";
						
					else :
					
				$out .='<img class="mk-header-image" src="'.get_header_image().'" width="'.get_custom_header()->width.'" height="'.get_custom_header()->height.'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" />'."\n";	
				
				endif;
				
				if(is_home() || is_front_page()){
				$out .='<div class="custom-header-content">'."\n";	
				$out .='<h2>'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</h2>'."\n";	
				$out .='<p>'.esc_attr( get_bloginfo( 'description', 'display' ) ).'</p>'."\n";
				$out .='</div>'."\n";
				}
				elseif (is_single()){
				$out .='<div class="custom-header-content">'."\n";	
				ob_start();
				the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' )."\n";
				mk_posted_on ()."\n";
				mk_entry_footer()."\n";
				$out .= ob_get_clean()."\n";
				$out .='</div>'."\n";		
				}
				elseif (is_archive()){
				$out .='<div class="custom-header-content">'."\n";
				ob_start();				
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				$out .= ob_get_clean()."\n";
				$out .='</div>'."\n";
				}
				elseif (is_page()){
				$out .='<div class="custom-header-content">'."\n";
				ob_start();						
				the_title( '<h1 class="entry-title">', '</h1>' ); 
				$out .= ob_get_clean()."\n";
				$out .='</div>'."\n";
				}
				elseif (is_search()){
				$out .='<div class="custom-header-content">'."\n";	
				$out .='<h1 class="page-title">'."\n";
				ob_start();	
				printf( __( 'Search Results for: %s', 'mk' ), '<span>' . get_search_query() . '</span>' );
				$out .= ob_get_clean()."\n";
				$out .='</h1>'."\n";
				$out .='</div>'."\n";
				}
				elseif (is_404()){
				$out .='<div class="custom-header-content">'."\n";	
				$out .='Page cannot be found';
				$out .='</div>'."\n";
				}
				else{
				$out .='<div class="custom-header-content">'."\n";
				ob_start();						
				the_title( '<h1 class="entry-title">', '</h1>' ); 
				$out .= ob_get_clean()."\n";		
				}
				
			//$out .='</a>'."\n";
		

	$out .='</header>'."\n";
	
	endif; // if show custom header images is true
	
	echo $out;
}

}

//add_action('mk_page_wrapper_before','mk_custom_header_feature');


/**
 * Implements custom favicon html into our header
 *
 */
 
if (function_exists('childtheme_override_mk_custom_favicon'))  {
	
	function mk_custom_favicon() {
			childtheme_override_mk_custom_favicon();
		}
	} else {	
 
function mk_custom_favicon(){

		$str ='';
		
         
		 if(get_theme_mod( 'mk_site_favicon') ):
		 
			$str .='<link rel="shortcut icon" href="'.esc_url( get_theme_mod( 'mk_site_favicon' ) ).'" />'."\n";
			
         endif;
		 
		echo $str ;
		
}
}


add_action('wp_head','mk_custom_favicon',1);

/**
 * hook custom header search inside mk page wrapper
 */
 
 if (function_exists('childtheme_override_lnt_custom_search'))  {
	
	function lnt_custom_search() {
			childtheme_override_lnt_custom_search();
		}
	} else {	
 
 
 function lnt_custom_search(){
 
	?>
	 
	<?php if ( get_theme_mod( 'mk_show_header_search',true) == true ):?>	
	<div id="header-outer">
		<div id="level-nine-search-container"> 
				<div class="row">	
					<div class="col-sm-12 col-md-12">
					<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>/">
						<label for="s" class="screen-reader-text"><?php _e('Search &hellip;','mk');?></label>
						<input type="search" class="search-field" placeholder="<?php _e('Search &hellip;','mk');?>" value="<?php echo trim(get_search_query());?>" id="s" name="s" title="<?php _e('Search &hellip;','mk');?>" />
					</form>		
				</div>			      
			</div>
			 <div id="lnt-close-search-bar"><a href="#">&#215;</a></div>
		</div>
	</div>
<div class="clearfix"></div>	
<?php endif; ;?>
		 
	<?php
 }
 }
 
 add_action('mk_before_wrappers','lnt_custom_search',1);
 
 function mk_add_support_for_ie8(){
 
	 /**
	 * HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
	 */
	 ?>
	<!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri();?>/js/html5shiv.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/respond.min.js"></script>
    <![endif]-->
 <?php
 }
 
 add_action('wp_head','mk_add_support_for_ie8',9);
 
 /**
 * Filter the_excerpt to show content in a more ideal way.
 *
 * The way content is shown depends on the priority of a situation:
 *
 * 1. the_content with "Read More" link if the "More" tag is used
 * 2. Manual excerpt with "Read More" link if excerpt is manually entered
 * 3. the_content in its entirety if less than 36 words (nicer than automatic excerpt)
 * 4. Automatic excerpt with "Read More" link if no better situation
 *
 */
 
function mk_excerpt( $excerpt ) {

	global $post;

	$show_excerpt = false;

	// "Read More" text
	/* translators: %s is post title (hidden, for screen readers) */
	$more_text = sprintf(
		__( 'Read More %s', 'themeslug' ),
		the_title( '<span class="screen-reader-text">&mdash; ', '</span>', false )
	);

	// 1. the_content with "Read More" link if the "More" tag is used, but not password-protected
	// This is first because it is as intentional as manual excerpt but manual excerpt could have other purpose (ie. meta description)
	if ( strpos( $post->post_content, '<!--more-->' ) && ! post_password_required() ) {
		the_content( $more_text );
	}

	// 2. Manual excerpt with "Read More" link if excerpt is manually provided
	elseif ( has_excerpt() ) {
		$show_excerpt = true;
	}

	// 3. the_content in its entirety if less than 200 words, but not password-protected (nicer than automatic excerpt)
	// A nice-looking fallback for when they do not use "more" or manual excerpt, or if only published a media embed
	elseif ( str_word_count( $post->post_content ) < 15 && ! post_password_required() ) {
		the_content();
	}

	// 4. Automatic excerpt if no better situation
	else {
		$show_excerpt = true;
	}

	// Show excerpt with "Read More"
	if ( $excerpt && $show_excerpt ) {

		?>
			<?php
			// Manual or automatic excerpt
			echo $excerpt;
			?>
			<p>
				<?php
				// "Read More" linked
				printf(
					'<a href="%1$s" class="more-link" rel="bookmark">%2$s</a>',
					esc_url( get_permalink() ),
					$more_text
				);
				?>
			</p>
 
		<?php

	}

}
add_filter( 'the_excerpt', 'mk_excerpt' );
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 20;
}

/**
 ** Remove width and height attributes in post thumbnail html
 *
 */

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id,$post_thumbnail) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 4 );

