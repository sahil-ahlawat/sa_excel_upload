<?php

/**
 * sa_Ui : Setting up wp admin UI
 *
 * @return void
 */
function sa_Ui(){

	sa_handle_post();
?>
  <h1>Excel Import</h1>
  <h2>Upload a File</h2>
  <!-- Form to handle the upload - The enctype value here is very important -->
  <form  method="post" enctype="multipart/form-data">
    <input type='file' id='sa_upload_pdf' name='sa_upload_pdf'></input>
    <?php
	submit_button('Upload') ?>
  </form>


  <?php
?>
  <?php
}