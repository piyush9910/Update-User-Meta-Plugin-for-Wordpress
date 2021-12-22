<?php

/*
   Plugin Name: Assign-Group
   Description: Plugin to import data from CSV into User and UserMeta
   Version: 0.1
   Author: Krishworks
*/


// Add menu
function plugin_menu() {

   add_menu_page("Assign-Group", "Assign-Group","manage_options", "myplugin", "Update_CSV", "dashicons-welcome-widgets-menus");

}
add_action("admin_menu", "plugin_menu");

function Update_CSV(){
   include "update-csv.php";
  
}