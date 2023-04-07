<?php
/**
 * sa_plugin_setup_menu : Setup Admin menu
 *
 * @return void
 */
function sa_plugin_setup_menu(){

	add_menu_page('Placements Excel Import', 'Placements Excel Import', 'manage_options', 'sa-csv-import', 'sa_Ui', "dashicons-image-rotate-right", 2);
}
add_action('admin_menu', 'sa_plugin_setup_menu');