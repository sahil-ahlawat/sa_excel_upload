<?php
/**
 * sa_read_from_csv : Reading csv file
 *
 * @return void
 */
function sa_read_from_csv(){
	
	global $wpdb;
	$post_data = array(
		'post_type' => 'placements'
	);
	$file = $_REQUEST["csv_url"];
	$data = array();
	$errors = array();
	if (!is_readable($file)) {
		chmod($file, 0744);
	}

	if (is_readable($file) && $_file = fopen($file, "r")) {
		$post = array();
		$header = fgetcsv($_file);
		while ($row = fgetcsv($_file)) {
			foreach($header as $i => $key) {
                $nslug = sa_slugify($key);
				$post[$nslug] = $row[$i];
			}

			$data[] = $post;
		}

		fclose($_file);
	}
	else {
		$errors[] = "File '$file' could not be opened. Check the file's permissions to make sure it's readable by your server.";
	}

	if (!empty($errors)) {
		print_r($errors);
	}
	// create posts from array
	sa_create_post_from_array($data);
}

if(isset($_POST['action']) && $_POST['action'] == "sa_create_post"){
	sa_read_from_csv();
}