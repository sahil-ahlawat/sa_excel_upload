<?php

/**
 * sa_placement_list : Crate a shortcode to show placement listing
 *
 * @param  mixed $atts
 * @return void
 */
function sa_placement_list($atts) {
    $default = array(
        'category' => '',
        'session' => '',
    );
    $a = shortcode_atts($default, $atts);
    $output = "";
    $args = "";
    if($a["category"] != "" && $a['session'] != ""){
        $args = array(
            'relation' => 'AND',
                array(
                    'key' => 'category',
                    'value' => $a['category'],
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'session',
                    'value' => $a['session'],
                    'compare' => 'LIKE'
                )                 
            );
    }
    else if($a["category"] == "" && $a['session'] != ""){
        $args = array(
                array(
                    'key' => 'session',
                    'value' => $a['session'],
                    'compare' => 'LIKE'
                )                 
            );
    }
    else if($a["category"] != "" && $a['session'] == ""){
        $args = array(
                array(
                    'key' => 'category',
                    'value' => $a['category'],
                    'compare' => 'LIKE'
                )                
            );
    }
    $loop = new WP_Query(
        array(
            'post_type' => 'placements',
            'posts_per_page' => -1, 
            'post_status'    => array( 'publish' ), 
            // 'paged' => get_query_var('paged') ? get_query_var('paged') : 1 , 
            // 's' => "$keyword" ,
            //  'tax_query' => $lettaxaquery,
            //  'meta_key' => ($orderbykey)?$orderbykey:$locationkey,
            // 'orderby' => $meta_value_num,
            // 'order' => $orderascdesc,
             'meta_query' => $args
        )); 
       
        // The Loop
if ( $loop->have_posts() ) {
	$output = $output. '<ul class="sa_placement_list">';
	while ( $loop->have_posts() ) {
		$loop->the_post();
		$output = $output. '<li class="sa_placement_item">';
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
        if($featured_img_url){
            $output = $output. "<img alt='".get_the_title()."' src='".$featured_img_url."' />";
        }
        
        $output = $output. "<h2>".get_the_title()."</h2>";
        $output = $output. "<h3>Company</h3>";
        $output = $output. "<p>".get_post_meta(get_the_ID(),'company', true)."</p>";
		$output = $output. '</li>';
	}
	$output = $output. '</ul>';
} else {
	$output = $output."No placements found";
}
/* Restore original Post Data */
wp_reset_postdata();
    return $output;
}
add_shortcode('placements', 'sa_placement_list');