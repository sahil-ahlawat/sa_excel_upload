<?php

/**
 * sa_handle_post : Process file and upload to db
 *
 * @return void
 */
function sa_handle_post(){

	// First check if the file appears on the _FILES array

	if (isset($_FILES['sa_upload_pdf'])) {
		$pdf = $_FILES['sa_upload_pdf'];

		// Use the wordpress function to upload
		// sa_upload_pdf corresponds to the position in the $_FILES array
		// 0 means the content is not associated with any other posts

		$uploaded = media_handle_upload('sa_upload_pdf', 0);
        
		// Error checking using WP functions

		if (is_wp_error($uploaded)) {
			echo "<h3 style='color:red' Error uploading file: " . $uploaded->get_error_message()."</h3>";
		}
		else {
			echo "<h3 style='color:green;'>File upload successful!</h3>";
			
			$csv_url = get_attached_file($uploaded);
			echo "<p>";
			echo "To insert the Placements into the database, click the button to the right.";
			echo '<form method="post">';
			echo '<input type="hidden" name="page" value="sa-csv-import">';
			echo '<input type="hidden" name="action" value="sa_create_post">';
			echo '<input type="hidden" name="csv_url" value="'.$csv_url.'">';
			echo '<input type="submit" value="Submit" class="button button-primary">';
			echo '</form>';
			echo "</p>";
		}
	}
}