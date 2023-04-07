<?php
/**
 * sa_imageUpload
 *
 * @param  mixed $imageUrl
 * @return Int Attachment Id
 */
function sa_imageUpload($imageUrl){
    // Die early if no image url
    if(!$imageUrl){
        return false;
    }
    include_once( ABSPATH . 'wp-admin/includes/image.php' );
    $imageurl = $imageUrl;
    $imagetypearr = explode('.', $imageurl);
    
    $imagetype = $imagetypearr[count($imagetypearr)-1];
    
    $uniq_name = date('dmY').''.(int) microtime(true); 
    $filename = $uniq_name.'.'.$imagetype;
    
    $uploaddir = wp_upload_dir();
    $uploadfile = $uploaddir['path'] . '/' . $filename;
    $contents= get_image_with_curl($imageurl);
    $savefile = fopen($uploadfile, 'w');
    fwrite($savefile, $contents);
    fclose($savefile);
    
    $wp_filetype = wp_check_filetype(basename($filename), null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => $filename,
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    $attach_id = wp_insert_attachment( $attachment, $uploadfile );
    $imagenew = get_post( $attach_id );
    $fullsizepath = get_attached_file( $imagenew->ID );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
    wp_update_attachment_metadata( $attach_id, $attach_data ); 
    
    return $attach_id;
}

function get_image_with_curl( $url ) {
    $res = array();
    $options = array( 
        CURLOPT_RETURNTRANSFER => true,     // return web page 
        CURLOPT_HEADER         => false,    // do not return headers 
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
        // CURLOPT_USERAGENT      => "spider", // who am i 
        CURLOPT_SSL_VERIFYHOST    => false,     // verify peer 
        CURLOPT_SSL_VERIFYPEER    => false,     // verify ssl
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
        CURLOPT_TIMEOUT        => 120,      // timeout on response 
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects 
    ); 
    $ch      = curl_init( $url ); 
    curl_setopt_array( $ch, $options ); 
    $content = curl_exec( $ch ); 
    $err     = curl_errno( $ch ); 
    $errmsg  = curl_error( $ch ); 
    $header  = curl_getinfo( $ch ); 
    curl_close( $ch ); 
    if($err){
        echo $errmsg;
       
    }
    
    return $content; 
} 