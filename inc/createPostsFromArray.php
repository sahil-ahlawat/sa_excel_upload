<?php

/**
 * sa_create_post_from_array : Creating posts from data
 *
 * @param  mixed $data
 * @return void
 */
function sa_create_post_from_array($data){
    global $sa_response;
    if(!$data){
        $sa_response = "No data in excel";
        return false;
    }
    $count = 0;
    foreach($data as $placement){
        $count++;
        $name=$placement['name'];
        $id = wp_insert_post(array(
            'post_title'=>$name, 
            'post_type'=>'placements',
            'post_status'   => 'publish'
        ));
       if($placement['image-url']){
       $imageid=sa_imageUpload($placement['image-url']);
        set_post_thumbnail( $id, $imageid );
       }
       
       $company=$placement['company'];
       $session=$placement['session'];
       $category=$placement['category'];
       update_post_meta( $id, 'company', $company );
       update_post_meta( $id, 'session', $session );
       update_post_meta( $id, 'category', $category );
    }
    $sa_response = "<h3 style='color:green;'>$count Placements uploaded!</h3>";
}