<?php
/*
Plugin Name: SA Excel upload
Plugin URI: 
Description: Uploading excel file into db.
Version: 1.0.0
Author: Sahil Ahlawat
Author URI: https://freelancingdiary.com

*/

// initiating everything
add_action("init", function () {
	include_once plugin_dir_path( __FILE__ )."/slugify.php";
    foreach ( glob( plugin_dir_path( __FILE__ ) . "inc/*.php" ) as $file ) {
		include_once $file;
	}
	
});
