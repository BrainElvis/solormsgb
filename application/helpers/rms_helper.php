<?php

function debugPrint($object, $title = "", $isMarkup = false) {
   echo '<font color="red">Debug <<< START';
   if(!empty($title)) {
      echo "$title: ";
   }
   if($isMarkup == false) {
      echo "<pre>";
      print_r($object);
      echo "</pre>";
   }else {
      echo htmlspecialchars($object);
   }
   echo 'END >>></font>';
}
