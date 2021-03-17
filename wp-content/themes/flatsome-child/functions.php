<?php
// Add custom Theme Functions here
/*add new widget*/
function add_new_widget() {
			register_sidebar( array(
		'name'          => __( 'my added menu', 'flatsome' ),
		'id'            => 'my added menu',
		'before_widget' => '<div id="%1$s" class="col pb-0 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span><div class="is-divider small"></div>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'tin tuc', 'flatsome' ),
		'id'            => 'tin tuc',
		'before_widget' => '<div id="%1$s" class="col pb-0 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span><div class="is-divider small"></div>',
  
	) );
	register_sidebar( array(
		'name'          => __( 'home-page-only-vertical', 'flatsome' ),
		'id'            => 'home-page-only',
		'before_widget' => '<div id="%1$s" class="col pb-0 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span><div class="is-divider small"></div>',
 		
	) );
	
	
}
add_action( 'widgets_init',  'add_new_widget');
//navigation menus
register_nav_menus(array(
	'home-page-only'=>__( 'vertical-home-page-only' ),
	));

//add FB icon
function fb_icon() { ?>
<style>
.fb-livechat, .fb-widget{display: none}.ctrlq.fb-button, .ctrlq.fb-close{position: fixed; right: 24px; cursor: pointer}.ctrlq.fb-button{z-index: 999; background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyOCAxMjgiIGhlaWdodD0iMTI4cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iMTI4cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxyZWN0IGZpbGw9IiMwMDg0RkYiIGhlaWdodD0iMTI4IiB3aWR0aD0iMTI4Ii8+PC9nPjxwYXRoIGQ9Ik02NCwxNy41MzFjLTI1LjQwNSwwLTQ2LDE5LjI1OS00Niw0My4wMTVjMCwxMy41MTUsNi42NjUsMjUuNTc0LDE3LjA4OSwzMy40NnYxNi40NjIgIGwxNS42OTgtOC43MDdjNC4xODYsMS4xNzEsOC42MjEsMS44LDEzLjIxMywxLjhjMjUuNDA1LDAsNDYtMTkuMjU4LDQ2LTQzLjAxNUMxMTAsMzYuNzksODkuNDA1LDE3LjUzMSw2NCwxNy41MzF6IE02OC44NDUsNzUuMjE0ICBMNTYuOTQ3LDYyLjg1NUwzNC4wMzUsNzUuNTI0bDI1LjEyLTI2LjY1N2wxMS44OTgsMTIuMzU5bDIyLjkxLTEyLjY3TDY4Ljg0NSw3NS4yMTR6IiBmaWxsPSIjRkZGRkZGIiBpZD0iQnViYmxlX1NoYXBlIi8+PC9zdmc+) center no-repeat #0084ff; width: 60px; height: 60px; text-align: center; bottom: 30px; border: 0; outline: 0; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; -ms-border-radius: 60px; -o-border-radius: 60px; box-shadow: 0 1px 6px rgba(0, 0, 0, .06), 0 2px 32px rgba(0, 0, 0, .16); -webkit-transition: box-shadow .2s ease; background-size: 80%; transition: all .2s ease-in-out}.ctrlq.fb-button:focus, .ctrlq.fb-button:hover{transform: scale(1.1); box-shadow: 0 2px 8px rgba(0, 0, 0, .09), 0 4px 40px rgba(0, 0, 0, .24)}.fb-widget{background: #fff; z-index: 1000; position: fixed; width: 360px; height: 435px; overflow: hidden; opacity: 0; bottom: 0; right: 24px; border-radius: 6px; -o-border-radius: 6px; -webkit-border-radius: 6px; box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -webkit-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -moz-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -o-box-shadow: 0 5px 40px rgba(0, 0, 0, .16)}.fb-credit{text-align: center; margin-top: 8px}.fb-credit a{transition: none; color: #bec2c9; font-family: Helvetica, Arial, sans-serif; font-size: 12px; text-decoration: none; border: 0; font-weight: 400}.ctrlq.fb-overlay{z-index: 0; position: fixed; height: 100vh; width: 100vw; -webkit-transition: opacity .4s, visibility .4s; transition: opacity .4s, visibility .4s; top: 0; left: 0; background: rgba(0, 0, 0, .05); display: none}.ctrlq.fb-close{z-index: 4; padding: 0 6px; background: #365899; font-weight: 700; font-size: 11px; color: #fff; margin: 8px; border-radius: 3px}.ctrlq.fb-close::after{content: "X"; font-family: sans-serif}.bubble{width: 20px; height: 20px; background: #c00; color: #fff; position: absolute; z-index: 999999999; text-align: center; vertical-align: middle; top: -2px; left: -5px; border-radius: 50%;}.bubble-msg{width: 120px; left: -140px; top: 5px; position: relative; background: rgba(59, 89, 152, .8); color: #fff; padding: 5px 8px; border-radius: 8px; text-align: center; font-size: 13px;}</style>
<div class="fb-livechat"> <div class="ctrlq fb-overlay"></div><div class="fb-widget"> <div class="ctrlq fb-close"></div><div class="fb-page" data-href="https://www.facebook.com/zintech.vn" data-tabs="messages" data-width="360" data-height="400" data-small-header="true" data-hide-cover="true" data-show-facepile="false"> </div>
<div class="fb-credit"> <a href="https://zintech.vn" target="_blank">Powered by ZinTech</a> </div><div id="fb-root"></div></div><a href="https://m.me/zintech.vn" title="Gửi tin nhắn cho chúng tôi qua Facebook" class="ctrlq fb-button"> <div class="bubble">1</div><div class="bubble-msg">Bạn cần hỗ trợ tư vấn</div></a></div>
<script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9"></script>
<script>
jQuery(document).ready(function($){function detectmob(){if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i) ){return true;}else{return false;}}var t={delay: 125, overlay: $(".fb-overlay"), widget: $(".fb-widget"), button: $(".fb-button")}; setTimeout(function(){$("div.fb-livechat").fadeIn()}, 8 * t.delay); if(!detectmob()){$(".ctrlq").on("click", function(e){e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({bottom: 0, opacity: 0}, 2 * t.delay, function(){$(this).hide("slow"), t.button.show()})) : t.button.fadeOut("medium", function(){t.widget.stop().show().animate({bottom: "30px", opacity: 1}, 2 * t.delay), t.overlay.fadeIn(t.delay)})})}});
</script>

<!-- Zalo chat box -->
<div class="zalo_container" style="width:200px">
	<div class="zalo-chat-widget" data-oaid="3606524394422923389" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="360" data-height="400" style="right: 1300px!important; bottom:14px!important;">
	</div>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>
</div>
<!--End of  Zalo chat box -->

<!--Call Us button -->
<div class="social-button">
    <div class="social-button-content">
       <a href="tel:02839310042" class="call-icon" rel="nofollow">
          <i class="fas fa-phone-volume" aria-hidden="true"></i>
          <div class="animated alo-circle"></div>
          <div class="animated alo-circle-fill"></div>
           <span>Hotline:  0966 885 959 </span>
        </a>
	</div>
</div>
<!--End of  Call Us button -->


	
<?php }
 add_filter('after_body_open_tag', 'fb_icon');
 
 /*Font Awesome*/
 add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {
wp_enqueue_style( 'load-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css' );
}

/**/	
function gia_ban_xin_lien_he() { ?>
	<div class="price-wrapper1">
	<div class="price-title">Giá bán xin liên hệ </div>
	<ul class="unstyled">
		<li><a href="tel:02839310042"><button class="btn btn-info disabled"><i class="fa fa-phone"></i> 028 3931 0042  </button></a></li>
		<li><a href="mailto:quantriwebjk@gmail.com" class="btn btn-success"><i class="fa fa-envelope"></i> info@zintech.vn </a></li>
		</ul>
</div>

<?php }

add_action ('woocommerce_single_product_summary','gia_ban_xin_lien_he',35);

/**
 * @snippet       Display Discount Percentage @ Loop Pages - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=21997
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_action( 'woocommerce_shop_loop_item_title', 'bbloomer_show_sale_percentage_loop', 25 );
add_action( 'woocommerce_before_single_product_summary', 'bbloomer_show_sale_percentage_loop', 25 );
  
function bbloomer_show_sale_percentage_loop() {
   global $product;
   if ( ! $product->is_on_sale() ) return;
   if ( $product->is_type( 'simple' ) ) {
      $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
   } elseif ( $product->is_type( 'variable' ) ) {
      $max_percentage = 0;
      foreach ( $product->get_children() as $child_id ) {
         $variation = wc_get_product( $child_id );
         $price = $variation->get_regular_price();
         $sale = $variation->get_sale_price();
         if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
         if ( $percentage > $max_percentage ) {
            $max_percentage = $percentage;
         }
      }
   }
   if ( $max_percentage > 0 ) echo "<div class='sale-perc'>-" . round($max_percentage) . "%</div>"; 
}

/*js code added*/
function wpb_adding_scripts() {
	
wp_register_script('my_amazing_script', get_stylesheet_directory_uri() . '/js/amazing_script4.js',
array('jquery'),'1.1', true);

wp_enqueue_script('my_amazing_script');

}

//Hide Price when Price is Zero
add_filter( 'woocommerce_get_price_html','maybe_hide_price',10,2);
function maybe_hide_price($price_html, $product){
     if($product->get_price()>0){
          return $price_html;
     }
     return '';
 }

/*
function my_scripts_enqueue() {

wp_register_script( 'popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/3.3.1/umd/popper.min.js', array('jquery'), NULL, true );
wp_register_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), NULL, true );
wp_register_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, NULL, 'all' );

wp_enqueue_script( 'popper-js' );
wp_enqueue_script( 'bootstrap-js' );

wp_enqueue_style( 'bootstrap-css' );
}
add_action( 'wp_enqueue_scripts', 'my_scripts_enqueue' );*/
                    
//admin css
add_action('admin_head', 'my_custom_admin_css');

function my_custom_admin_css() {
  echo '<style>
input[value="Add new category"]{
    position: relative;
    bottom: 821px;
    left: 203px;
}
    } 
  </style>';
}
                    
//call for price (ko cần vì đã có add to cart mặc định của Woo rồi - đã add thêm vào ở line 189)
add_action('woocommerce_after_shop_loop_item','call_for_price',15);     
function call_for_price(){
    global $product;
 // echo do_shortcode('[sc name="lien-he-price-button"]');
}

add_filter( 'woocommerce_is_purchasable', 'wpa_109409_is_purchasable', 10, 2 );
function wpa_109409_is_purchasable( $purchasable, $product ){
    if( $product->get_price() >= 0 )
        $purchasable = true;
    return $purchasable;
}

 add_action( 'wp_head', 'wp_filter_for_one_action' );
function wp_filter_for_one_action() {
  global $wp_filter;
  echo '<!-- ', var_export( $wp_filter[ 'woocommerce_after_shop_loop_item' ], true ), ' -->';
}

//add to cart button hook to product page
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_add_to_cart', 20 );
//remove item counter next to add to cart button on product page
add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );
function custom_remove_all_quantity_fields( $return, $product ) {return true;}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Liên Hệ', 'woocommerce' );
}
                    
//email css
add_filter( 'woocommerce_email_styles', 'bbloomer_add_css_to_emails', 9999, 2 );
 
function bbloomer_add_css_to_emails( $css, $email ) { 
$css .= '
   h2 { color: red }
   h3 { font-size: 30px }
   h1 a {color:#fff;}
   p a {color:#1348e8;}
   tfoot {display:none!important;}
   thead tr th:nth-child(3) {display:none;border: 0px;}
   tbody tr td:nth-child(3) {display:none;border: 0px;}
  ';
return $css;
}


//increase excerpt_length - home page only
if ( $_SERVER['REQUEST_URI'] == '/' ) {
  function custom_excerpt_length( $length ) {
      return 500;
  }
  add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
}

/*WordPress - Update permalink automatically after posting an update
*/
add_filter( 'wp_insert_post_data', 'custom_slug_change', 50, 2 );
function custom_slug_change( $data, $postarr ) {
    //Check for the  post statuses you want to avoid
    if ( !in_array( $data['post_status'], array( 'draft', 'pending', 'auto-draft' ) ) ) {           
        $data['post_name'] = sanitize_title( $data['post_title'] );
    }
    return $data;
}



/** Walker_Nav_Primary */
require get_stylesheet_directory() . '/walker-giaiphapit.php';

//https://giuseart.com/them-danh-muc-con-vao-title-element-trong-ux-builder-cua-flatsome/
add_action('ux_builder_setup', 'danh_muc_san_pham');
function danh_muc_san_pham(){
  add_ux_builder_shortcode('danh_muc_san_pham', array(
    'name'      => __('Danh mục sản phầm'),
    'category'  => __('Content'),
    'info'      => '{{ text }}',
    'wrap'      => false,
    'options' => array(
      'ttit_cat_ids' => array(
        'type' => 'select',
        'heading' => 'Categories',
        'param_name' => 'ids',
        'config' => array(
          'multiple' => false,
          'placeholder' => 'Select...',
          'termSelect' => array(
            'post_type' => 'product_cat',
            'taxonomies' => 'product_cat'
          )
        )
      ),
        'size' => array(
        'type'    => 'slider',
        'heading' => __( 'Font Size' ),
        'default' => 100,
        'unit'    => '%',
        'min'     => 20,
        'max'     => 300,
        'step'    => 1,
        'responsive' => true,
      ),
      'custom_title' => array(
        'type'    => 'textfield',
        'heading' => 'Custom Title',
        'default' => '',
      ),
        'margin_top' => array(
        'type'        => 'scrubfield',
        'heading'     => __( 'Margin Top' ),
        'default'     => '',
        'placeholder' => __( '0px' ),
        'min'         => - 100,
        'max'         => 300,
        'step'        => 1,
        'responsive' => true,
      ),
      'icon_img' => array(
        'type' => 'image',
        'heading' => __( 'Icon Img' ),
        'thumb_size' => 'bg_size',
      ),
        'quick_link' => array(
        'type'    => 'textfield',
        'heading' => 'Quick Link (Icon)',
        'default' => '',
      ),
      'bg_color' => array(
        'type' => 'colorpicker',
        'heading' => __('Bg Color'),
        'alpha' => true,
        'format' => 'rgb',
        'position' => 'bottom right',
      ),    
      'link_text' => array(
        'type'    => 'textfield',
        'heading' => 'Link Text',
        'default' => '',
      ),
      'custom_link' => array(
        'type'    => 'textfield',
        'heading' => 'Custom Link',
        'default' => '',
      ),
       
  )));
}

function render_danh_muc_san_pham( $atts, $content = null ){
  extract( shortcode_atts( array(
    '_id' => 'danhMucSanPham-'.rand(),
    'class' => '',
    'visibility' => '',
    'ttit_cat_ids' => '',
    'link' => '',
    'link_text' => '',
    'bg_color' => '',
    'icon_img' => '',
    'size' => '',
    'custom_title' => '',
     'margin_top' => '',
     'custom_link' => '',
    'quick_link' => ''//https://shop1888.com/img/xemthem.png
  ), $atts ) );

  if ( isset( $atts[ 'ttit_cat_ids' ] ) ) {
    $ids = explode( ',', $atts[ 'ttit_cat_ids' ] );
    $ids = array_map( 'trim', $ids );
  } else {
    $ids = array();
  }

  $args = array(
    'taxonomy' => 'product_cat',
    'include'    => $ids,
    'pad_counts' => true,
    'child_of'   => 0,
    'hide_empty' => false,
    'bg_color'=> ''
  );

  //Cách 1
  $product_categories = get_terms( $args );
  $cat_name = array();
  if ( $product_categories ) {
    foreach ( $product_categories as $category ) {

      $cat_name[] = $category->name;
      $cat_link = get_term_link( $category );
  }
}
//  var_dump($cat_name);
  //Cách 2
  $the_query = new WP_Term_Query( $args);
  $loai_sp = array();
  foreach ($the_query->terms as $term)
  {
    $loai_sp[] = $term->name;
  }


  if($icon_img) {
    $icon_img = flatsome_get_image_url($icon_img);
  }
//var_dump($icon_img);
  $css_args = array();//size
  $css_args[] = array( 'attribute' => 'background-color', 'value' => $bg_color);
  $css_args_h2[] = array( 'attribute' => 'margin-top', 'value' => $margin_top);

ob_start();
?>
 <div id="<?php echo $_id; ?>" class="tieude-sp" <?=get_shortcode_inline_css($css_args)?> >
    <h2 class="ten-dmsp" <?php //echo get_shortcode_inline_css( $css_args_h2 )?> > 
        <img src="<?=$icon_img?> ">
          <?= ( ! isset( $atts[ 'ttit_cat_ids' ] ) ) ? $custom_title : wp_kses_post( $cat_name[0] )  ?>            
     </h2>
     <a class="xt-dmsp" href="<?=( ( $cat_link == "" ) ? $custom_link : $cat_link )?>" <?php //echo (get_shortcode_inline_css( $css_args_h2 ) )?> >
        <img src="https://shop1888.com/img/xemthem.png"><?=$link_text?> </a> 
</div>
<?php
 $args = array(
    'size' => array(
      'selector' => '.ten-dmsp',
      'property' => 'font-size',
      'unit' => '%',
    ),
    'margin_top' => array(
      'selector' => '.xt-dmsp',
      'property' => 'margin-top',
      'unit' => 'px',
    )
  );

require_once  get_template_directory() . '/inc/builder/core/server/helpers/elements.php';
echo get_template_directory() . '/inc/builder/core/server/helpers/elements.php';
var_dump(ux_builder_element_style_tag($_id, $args, $atts));
echo ux_builder_element_style_tag($_id, $args, $atts);
?>


<?php

$content = ob_get_contents();
ob_end_clean();
return $content;

}
add_shortcode('danh_muc_san_pham', 'render_danh_muc_san_pham');

//remove the WordPress update at footer
add_action('admin_menu','hide_update_message');
function hide_update_message()
{
  remove_filter( 'update_footer', 'core_update_footer' );
}

// Admin footer modification
  
function remove_footer_admin () 
{
    echo '';
}
 
add_filter('admin_footer_text', 'remove_footer_admin');