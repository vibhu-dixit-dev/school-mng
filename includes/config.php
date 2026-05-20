<?php

  $db_host = trim(getenv('DB_HOST')) ?: 'localhost';
  $db_user = trim(getenv('DB_USER')) ?: 'root';
  $db_pass = trim(getenv('DB_PASS')) ?: 'root';
  $db_name = trim(getenv('DB_NAME')) ?: 'sms_project';
  $db_port = trim(getenv('DB_PORT')) ?: 3306;

  $db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

  if (!$db_conn) {
    echo 'Connection Failed';
    exit;
  }
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  date_default_timezone_set('Asia/Kolkata');
  include('functions.php');

  $site_url = get_setting('site_url', true);

  if(empty($site_url)){

    if(!empty($_POST['site_url'])){


      $query = mysqli_query($db_conn, "INSERT INTO `settings` (setting_key, setting_value) VALUES ('site_url' , '{$_POST['site_url']}')") or die('Error while inserting');
      
      if($query){
        header('Location: /index.php'); die;
      }
    }

    ?>
    <form action="" method="post">
      <div class="">
        <input type="url" class="" name="site_url" placeholder="Enter your site URL">

        <button>Submit</button>
      </div>
    </form>
    <?php 

    die;
  }
?>
