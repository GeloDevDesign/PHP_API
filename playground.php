<?php


 function slug($string)
 {
  $slug = preg_replace('/[^a-z0-9\s-]/', '', $string);
  return $slug;
 }

  //  localhost:8000/{id}


 echo slug(" localhost:8000/{id}");

 ?>

