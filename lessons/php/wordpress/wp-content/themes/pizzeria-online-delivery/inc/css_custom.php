<?php
$pizzeria_online_delivery_custom_css = "";
$pizzeria_online_delivery_primary_color = get_theme_mod('pizzeria_online_delivery_primary_color');

/*------------------ Primary Global Color -----------*/

if ($pizzeria_online_delivery_primary_color) {
  $pizzeria_online_delivery_custom_css .= ':root {';
  $pizzeria_online_delivery_custom_css .= '--primary-color: ' . esc_attr($pizzeria_online_delivery_primary_color) . ' !important;';
  $pizzeria_online_delivery_custom_css .= '} ';
}

/*-------------------- Scroll Top Alignment-------------------*/

$pizzeria_online_delivery_scroll_top_alignment = get_theme_mod( 'pizzeria_online_delivery_scroll_top_alignment','right-align');

if($pizzeria_online_delivery_scroll_top_alignment == 'right-align'){
$pizzeria_online_delivery_custom_css .='#button{';
	$pizzeria_online_delivery_custom_css .='right: 3%;';
$pizzeria_online_delivery_custom_css .='}';
}else if($pizzeria_online_delivery_scroll_top_alignment == 'center-align'){
$pizzeria_online_delivery_custom_css .='#button{';
	$pizzeria_online_delivery_custom_css .='right:0; left:0; margin: 0 auto;';
$pizzeria_online_delivery_custom_css .='}';
}else if($pizzeria_online_delivery_scroll_top_alignment == 'left-align'){
$pizzeria_online_delivery_custom_css .='#button{';
	$pizzeria_online_delivery_custom_css .='left: 3%;';
$pizzeria_online_delivery_custom_css .='}';
}

/*-------------------- Archive Page Pagination Alignment-------------------*/

$pizzeria_online_delivery_archive_pagination_alignment = get_theme_mod( 'pizzeria_online_delivery_archive_pagination_alignment','left-align');

if($pizzeria_online_delivery_archive_pagination_alignment == 'right-align'){
$pizzeria_online_delivery_custom_css .='.pagination{';
	$pizzeria_online_delivery_custom_css .='justify-content: end;';
$pizzeria_online_delivery_custom_css .='}';
}else if($pizzeria_online_delivery_archive_pagination_alignment == 'center-align'){
$pizzeria_online_delivery_custom_css .='.pagination{';
	$pizzeria_online_delivery_custom_css .='justify-content: center;';
$pizzeria_online_delivery_custom_css .='}';
}else if($pizzeria_online_delivery_archive_pagination_alignment == 'left-align'){
$pizzeria_online_delivery_custom_css .='.pagination{';
	$pizzeria_online_delivery_custom_css .='justify-content: start;';
$pizzeria_online_delivery_custom_css .='}';
}

/*-------------------- Scroll Top Responsive-------------------*/

$pizzeria_online_delivery_resp_scroll_top = get_theme_mod( 'pizzeria_online_delivery_resp_scroll_top',true);
if($pizzeria_online_delivery_resp_scroll_top == true && get_theme_mod( 'pizzeria_online_delivery_scroll_to_top',true) != true){
	$pizzeria_online_delivery_custom_css .='#button.show{';
		$pizzeria_online_delivery_custom_css .='visibility:hidden !important;';
	$pizzeria_online_delivery_custom_css .='} ';
}
if($pizzeria_online_delivery_resp_scroll_top == true){
	$pizzeria_online_delivery_custom_css .='@media screen and (max-width:575px) {';
	$pizzeria_online_delivery_custom_css .='#button.show{';
		$pizzeria_online_delivery_custom_css .='visibility:visible !important;';
	$pizzeria_online_delivery_custom_css .='} }';
}else if($pizzeria_online_delivery_resp_scroll_top == false){
	$pizzeria_online_delivery_custom_css .='@media screen and (max-width:575px){';
	$pizzeria_online_delivery_custom_css .='#button.show{';
		$pizzeria_online_delivery_custom_css .='visibility:hidden !important;';
	$pizzeria_online_delivery_custom_css .='} }';
}

/*-------------------- Preloader Responsive-------------------*/

$pizzeria_online_delivery_resp_loader = get_theme_mod('pizzeria_online_delivery_resp_loader',false);
if($pizzeria_online_delivery_resp_loader == true && get_theme_mod('pizzeria_online_delivery_header_preloader',false) == false){
	$pizzeria_online_delivery_custom_css .='@media screen and (min-width:575px){
		.preloader{';
		$pizzeria_online_delivery_custom_css .='display:none !important;';
	$pizzeria_online_delivery_custom_css .='} }';
}

if($pizzeria_online_delivery_resp_loader == false){
	$pizzeria_online_delivery_custom_css .='@media screen and (max-width:575px){
		.preloader{';
		$pizzeria_online_delivery_custom_css .='display:none !important;';
	$pizzeria_online_delivery_custom_css .='} }';
}

// Scroll to top button shape 

$pizzeria_online_delivery_scroll_border_radius = get_theme_mod( 'pizzeria_online_delivery_scroll_to_top_radius','curved-box');
if($pizzeria_online_delivery_scroll_border_radius == 'box'){
	$pizzeria_online_delivery_custom_css .='#button{';
		$pizzeria_online_delivery_custom_css .='border-radius: 0px;';
	$pizzeria_online_delivery_custom_css .='}';
}else if($pizzeria_online_delivery_scroll_border_radius == 'curved-box'){
	$pizzeria_online_delivery_custom_css .='#button{';
		$pizzeria_online_delivery_custom_css .='border-radius: 4px;';
	$pizzeria_online_delivery_custom_css .='}';
}
else if($pizzeria_online_delivery_scroll_border_radius == 'circle'){
	$pizzeria_online_delivery_custom_css .='#button{';
		$pizzeria_online_delivery_custom_css .='border-radius: 50%;';
	$pizzeria_online_delivery_custom_css .='}';
}

// Footer Background Image Attachment 

$pizzeria_online_delivery_footer_attachment = get_theme_mod( 'pizzeria_online_delivery_background_attachment','scroll');
if($pizzeria_online_delivery_footer_attachment == 'fixed'){
	$pizzeria_online_delivery_custom_css .='.site-footer{';
		$pizzeria_online_delivery_custom_css .='background-attachment: fixed;';
	$pizzeria_online_delivery_custom_css .='}';
}elseif ($pizzeria_online_delivery_footer_attachment == 'scroll'){
	$pizzeria_online_delivery_custom_css .='.site-footer{';
		$pizzeria_online_delivery_custom_css .='background-attachment: scroll;';
	$pizzeria_online_delivery_custom_css .='}';
}

// Menu Hover Style	

$pizzeria_online_delivery_menus_item = get_theme_mod( 'pizzeria_online_delivery_menus_style','None');
if($pizzeria_online_delivery_menus_item == 'None'){
	$pizzeria_online_delivery_custom_css .='#site-navigation .menu ul li a:hover, .main-navigation .menu li a:hover{';
		$pizzeria_online_delivery_custom_css .='';
	$pizzeria_online_delivery_custom_css .='}';
}else if($pizzeria_online_delivery_menus_item == 'Zoom In'){
	$pizzeria_online_delivery_custom_css .='#site-navigation .menu ul li a:hover, .main-navigation .menu li a:hover{';
		$pizzeria_online_delivery_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important;';
	$pizzeria_online_delivery_custom_css .='}';

	$pizzeria_online_delivery_custom_css .= '.main-navigation ul ul li a:hover {';
	$pizzeria_online_delivery_custom_css .= 'margin-left: 20px;';
	$pizzeria_online_delivery_custom_css .= '}';
}	

// Post Content Alignment

$pizzeria_online_delivery_blog_layout_option = get_theme_mod( 'pizzeria_online_delivery_blog_layout_option','Left');
if($pizzeria_online_delivery_blog_layout_option == 'Left'){
	$pizzeria_online_delivery_custom_css .='.post{';
		$pizzeria_online_delivery_custom_css .='text-align: left;';
	$pizzeria_online_delivery_custom_css .='}';
}elseif ($pizzeria_online_delivery_blog_layout_option == 'Right'){
	$pizzeria_online_delivery_custom_css .='.post{';
		$pizzeria_online_delivery_custom_css .='text-align: right;';
	$pizzeria_online_delivery_custom_css .='}';
}elseif ($pizzeria_online_delivery_blog_layout_option == 'Center'){
	$pizzeria_online_delivery_custom_css .='.post{';
		$pizzeria_online_delivery_custom_css .='text-align: center;';
	$pizzeria_online_delivery_custom_css .='}';
}