<?php
$failImage = 'image404.png';

$imageSuccessArray =  array(
    "alt" => "Image Failed",
    "class" => "thumbnail",
    'url' => array(
        //   'controller' => 'items', 'action' => 'view', 6
        '#'),
    'a' => array(
        'class' => 'thumbnail'
    )//,
    //SECOND ARRAY TO NEST ARRAY VALUES
    //CLEAN THIS UP, THIS IS SAME AS IMAGE ELEMENT
    /* array(
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
)*/
);

$imageFailArray = array(
    'alt' => 'image failed',
    'class' => 'item_image thumbnail'
);
$imageEmptyArray = array(
    'alt' => 'image failed',
    'class' => 'item_image thumbnail',
);
?>


<?php
//make empty div if less than 4
//all fields used below must be given a value here
//empty message must be supplied in parameters
if(count($items)< 4) {
    $items[count($items)] = array(
            'title' => $emptyMessage,
            'img_url' => 'addButton.jpg',
        // THIS ID MAKES IT CRASH WHEN YOU CLICK THE PICTURE. FIX THE WHOLE PICTURE SYSTEM
            'id' => null,
            'url' => array(
                'controller' => 'items',
                'action' => 'add'
            )
    );

    //for full item model with owner information
/*    $items[count($items)] = array(
        "Item" => array(
            'title' => $emptyMessage,
            //empty_div img, arguably most important property
            'img_url' => 'addButton.jpg'
        ),
        "Owner" => array(
            'name' => ' '
        )
    );   */
}
?>

<?php foreach ($items as $item){ ?>
    <div class="col-sm-3">

        <div class="thumb_title">
             <?php echo "<h4>".$item['title']."</h4>"; ?>
        </div>  <?php
        // figure out how to include username
         //   echo "<h3>".$item['Owner']['name']."</h3>";
            if($item['img_url']) {
                echo $this->element('image', array(
                   // LINK FUNCTION OF IMAGE ELEMENT DOES NOT WORK
                   // 'type' => 'link',
                    'src' => $item['img_url'],
                    "class" => "thumbnail",
                    'url' => array(
                        'controller' => 'items',
                        'action' => 'view',
                        $item['id']
                    )
                ));
            }else echo $this->Html->image($failImage, $imageFailArray);
        ?>
    </div>

<?php } ?>