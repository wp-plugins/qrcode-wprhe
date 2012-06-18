<?php
/* 

Plugin Name: qrcode_wprhe
Plugin URI: http://www.free-qr-code.net/qr-code-wordpress-plugin.html
Version: 1.0
Author: Rene Hermenau
Author URI: http://www.free-qr-code.net
Description: qrcode wordpress plugin to generate individual and URL relating qr codes within your wordpress articles


How to use it:

 * Use the shortcode [qrcode] within your content to generate the current URL of the site where the shortcode is embeded.
  
 * Use the shortcode [qrcode content="CONTENT" size="80" alt="ALT_TEXT" align="ALIGN" class="CLASS_NAME"] to generate a indivdual qr code with the content of CONTENT, 
   the SIZE in pixels e.g. 80, the ALT_TEXT, the CLASS_NAME you want to use and the optional ALIGN tag, which can be "right" or "left"
 
 * It´s not neccessary to give any parameters! 
 * If you don´t give any parameter like 'alt' or 'size', the standard parameters are:
    alt = ""
    size = 80
    class=""
  
 
* See http://www.free-qr-code.net/qr-code-wordpress-plugin.html for more info
* I am very thankful if you give me credit and a backlink to http://www.free-qr-code.net
 
*/


/* Shortcode  function */
  function qrcode_wprhe_shortcode($atts) {
    extract(shortcode_atts(array(
                'content' => '',
                'alt' => '',
                'size' => '',
                'align' => '',
				'class' => ''
                    ), $atts));

    $current_uri = 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . '';

    if (empty($content) && $content !== 0) {
        $content = urlencode($current_uri);
    } else {
        $content = urlencode(strip_tags(trim($content)));
    }
	
	
	
	if (empty($alt) && $alt !==0) {
	  $alt="";
	} else {
	  $alt = strip_tags(trim($alt));
        }
        
        if (empty($size) && $size !==0) {
	  $size = "80";
	} else {
	  $size = strip_tags(trim($size));
	}
        
         if (empty($align) && $align !==0) {
	  $align = "";
	} else {
	  $align = strip_tags(trim($align));
	}
       
             if (empty($class) && $class !==0) {
	  $class = "";
	} else {
	  $class = strip_tags(trim($class));
	}
	   
    $output = "";
    $image = 'https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chld=H|0&chl=' . $content;
    if ($align == "right") {
        $align = ' align="right"';
    }
    if ($align == "left") {
        $align = ' align="left"';
    }
    if ($class != "") {
        $class = ' class="' . $class . '"';
    }

    $output = '<img src="' . $image . '" alt="' . $alt . '" width="' . $size . '" height="' . $size . '"' . $align . $class . ' />';
	
    return $output;
  }

/* Add the Shortcode */
  add_shortcode('qrcode', 'qrcode_wprhe_shortcode');

?>