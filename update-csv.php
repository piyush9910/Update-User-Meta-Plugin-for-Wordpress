<?php
global $wpdb;
$ld = learndash_get_groups();
if(isset($_POST['butimport']) or isset($_POST['butupdate'])){
  $group_users_new = array();
  $extension = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);
  if(!empty($_FILES['import_file']['name']) && $extension == 'csv'){
    $totalInserted = 0;
    $csvFile = fopen($_FILES['import_file']['tmp_name'], 'r');
    fgetcsv($csvFile);
    while(($csvData = fgetcsv($csvFile)) !== FALSE){
      $csvData = array_map("utf8_encode", $csvData);
      $dataLen = count($csvData);
      if( !($dataLen == 5) ) continue;
      $user_login = trim($csvData[0]);
      $user_email = trim($csvData[1]);
      $meta_key = trim($csvData[2]);
      $new_value = trim($csvData[3]);
      $new_user = $_POST["new_user"];
      $user_pa = trim($csvData[4]);
      $user_pass = wp_hash_password($user_pa);

      $gp_id = $_POST["group_id"];

      // Check if variable is empty or not
      if(!empty($user_login) && !empty($meta_key) && !empty($new_value) ) {
      $users = $wpdb->get_results("SELECT user_login, ID from wp_users where user_login = '".$user_login."'");
        if ($users[0]->user_login == $csvData[0]){
          $user_id = $users[0]->ID;
          //echo $user_id;
          $wp_user_object = new WP_User($users[0]->ID);
          $wp_user_object->set_role('subscriber');
          $usermeta = $wpdb->get_results("SELECT user_id, meta_value from wp_usermeta where user_id = '$user_id' and meta_key like '$meta_key' ");
          $prev_value = $usermeta[0]->meta_value;
          update_user_meta( $user_id, $meta_key, $new_value, $prev_value );
          ld_update_group_access($user_id, $gp_id);
            }
            
          elseif(!empty($new_user)){
            $insert = $wpdb->query("INSERT INTO wp_users (user_login, user_nicename, user_email, display_name, user_pass, user_registered) values('$user_login', '$user_login', '$user_email', '$user_login', '$user_pass' , '".date('Y-m-d H:i:s')."')");
            //$group_users_new[] = $gp_id;
            //learndash_set_groups_users($gp_id, $group_users_new);   
            //ld_update_group_access($user_id, $gp_id);  
            //insertMeta($user_login);
            //add_user_meta( $user_id, $meta_key, $new_value, false );
          }
        }
    }
    echo "<h3 style='color: green;'>Record Succesfully Updated </h3>";

  }else{
    echo "<h3 style='color: red;'>Invalid Extension</h3>";
  }
}
?>

<!-- HTML for Inserting new Users and Updating the meta key and value for the existing or new users .  -->
<div style="width: 50%; float:left" id="wrapper_1">
<h1 align="center"> Create UserMeta from CSV File (Comma Separated Values). </h1>
<!-- Form -->
<form method='post' action='<?= $_SERVER['REQUEST_URI']; ?>' enctype='multipart/form-data'>
<p><h2>Create New user when user not available <input type="checkbox" name="new_user" ></p></h2>
  <input type="file" name="import_file" >
  <input type="submit" name="butimport" value="Import" id="btn-bg">
  
</form>
</div>

<div style="width: 50%; float:right" id="wrapper_2">
<h1 align="center"> Update UserMeta from CSV File (Comma Separated Values). </h1>
<!-- Form -->
<form method='post' action='<?= $_SERVER['REQUEST_URI']; ?>' enctype='multipart/form-data'>
  <input type="file" name="import_file" >
  
  <p>Group:
        <select name="group_id">
            <option disabled selected>-- Select Group --</option>
            <?php
                for($i=0; $i<sizeof($ld); $i++)
                {
                    echo "<option value='". $ld[$i]->ID ."'>" . "" . $ld[$i]->post_title ."</option>";  // displaying data in option menu
                }	
            ?>  
        </select></p>
  <input type="submit" name="butupdate" value="Update" id="btn-bg">
  
</form>
</div>
</div>

<!-- CSS --->

<style>
    #btn-bg{
        background-color:#2271B1;
        color: white;
        height: 50px;
        width: 100px;
        border-radius: 10px;
        text-align: center;
    }

    #btn-bg:hover{
        background-color: #6495ED;
        color: white;
    }

   
</style>