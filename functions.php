<?php
function lastModified(){
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $query="SELECT UPDATE_TIME FROM information_schema.tables WHERE TABLE_SCHEMA='".DB_NAME."' AND TABLE_NAME = 'points'";
  $data = mysqli_fetch_array(mysqli_query($dbc, $query));
  mysqli_close($dbc);

  return $data[0];
}
?>
