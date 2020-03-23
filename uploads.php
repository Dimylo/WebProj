<?php
  $filename = basename($_FILES["fileToUpload"]["name"]);
  echo $filename ."<br>";
  $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  if ($filetype != json)
    echo "RE FYGE RE MLKA APO DW RE BRO";
  else
    
  echo $fileType;
?>
