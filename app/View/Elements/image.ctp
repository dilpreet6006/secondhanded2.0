<?php
//this element accepts: (all optional)
//src -> string (or 'fail', or 'empty')
//url -> string
//link -> string
//class -> string
//add more...

$failImage = 'image404.png';
//basic img values, values specified below will override these
$img_array = array(
    "alt" => "Image Failed",
    'class' => (!isset($class))?'thumbnail':$class,
    'id' => (!isset($id))?'':$id,
);

// use these to define behaviour
$imageSuccessArray =  array_merge($img_array, array(
    //'class' = 'override_class'
    )
    //enable url if successful and url passed
    + ((isset($url))? array(
        'url' => $url
    ) : array())
    //onclick if passed
    + ((isset($onClick))? array(
        'onclick' => $onClick
    ) : array())
);
$imageFailArray = array_merge($img_array, array(
    //'class' = 'override_class'
));
//this is handled by caller, different calls require different empty behaviours
/*$imageEmptyArray =  array_merge($img_array, array(
    //'url' => ''
));*/


if(isset($type) && $type == 'link') {
    if (isset($src) && $src) {
        //normal img output with src
        echo $this->Html->link(
            $this->Html->image($src, $imageNoUrl),
            $img_array['url'],
            array(
                'class' => 'thumbnail'
            )
        );
    } //no src
    else echo $this->Html->link(
        $this->Html->image($failImage, $imageFailArray),
        $img_array['url'],
        array(
            'class' => 'thumbnail'
        ));
} else {
//check if given src, and check if it works
    if (isset($src) && $src) {
        //normal img output with src
        echo $this->Html->image($src, $imageSuccessArray);
    } //no src
    else echo $this->Html->image($failImage, $imageFailArray);
}


