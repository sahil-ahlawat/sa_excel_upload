<?php

/**
 * sa_Ui : Setting up wp admin UI
 *
 * @return void
 */
function sa_Ui(){
    global $sa_response;

	sa_handle_post();


?>

  <h1>Excel Import</h1>
  <a href="<?php echo plugin_dir_url(dirname(__file__)) . 'public/placements.csv'; ?>">Download Sample Excel Sheet</a>
  <h2>Upload a File</h2>
  <!-- Form to handle the upload - The enctype value here is very important -->
  <form  method="post" enctype="multipart/form-data">
    <input type='file' id='sa_upload_pdf' name='sa_upload_pdf'></input>
    <?php
	submit_button('Upload') ?>
  </form>
<p>
    Use this shortcode to show Placement listing : 
    <code>[placements session="2014" category="Computer Science"]</code>
</p>

  <?php
if($sa_response){
    echo $sa_response;
    $sa_response = "";
}
}