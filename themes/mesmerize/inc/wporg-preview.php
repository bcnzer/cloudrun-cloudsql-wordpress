<?php

add_filter('mesmerize_post_image_preview', function ($value) {
//    $id = uniqid('mesmerize-image-uniq');
//    return "https://picsum.photos/1024/600?$id";
  return $value;
});
