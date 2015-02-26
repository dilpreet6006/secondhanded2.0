<?php
//this element accepts: (all optional)
//src -> string (or 'fail', or 'empty')
//url -> array (controller, action, params) [enables <a>]
//type -> string ('link')    //[link is imgButton enabler]
//onclick -> string
//class -> string
//id -> int || numeric_string
//add more...


//overriding defaults, applying values
//add parameter validation here:
$img_array = array(
    'alt' => "Image Failed",
    'src' => (!isset($src))?'image404.png':$src,
    'class' => (!isset($class))?'thumbnail':$class,
    'id' => (!isset($id))?'':$id,
    )
    + ((isset($url) && isset($url['controller']))? array(
        'url' => $url
    ) : array())
    + ((isset($onClick))? array(
        'onclick' => $onClick
    ) : array());

echo $this->Html->image($img_array['src'], $img_array);
