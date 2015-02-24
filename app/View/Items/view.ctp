<br/>

<?PHP //MAKE USER ELEMENT THAT SPITS OUT USER DIV WITH FORMATTED THUMBNAIL AND NAME LINK ?>


<?php
//debug($item);
?>

<?php
    //FIX THE <BR/>!!
?>
<div class="container" id="item_view row">
    <div class="col-sm-3 image_container">
        <!-- main image ADD OTHER IMAGES -->
        <div class="col-sm-3">
            <?php echo $this->element('image', array(
                'src' => $item['Item']['img_url'],
                'class' => "large_img",
                'id' => 'itemImage',
               // 'type' => 'link',
            )); ?>
        </div>
        <div class="other_imgs">
                <!-- INSERT OTHER IMAGES UNDERNEATH THE MAIN -->
        </div>
    </div>
    <div class="singleItemDetails">
        <?php echo "<h2 class='item_title'>".$item['Item']['title']."</h2>";?>
        <div class="owner_div">
            <?php
                //text link
                echo $this->element('image', array(
                    'src' => $item['Owner']['img'],
                    //CLASS IS COMMENT???!!
                    'class' => 'thumbnail comment-thumb',
                ));
                echo $this->Html->link("<h3 class ='item_owner'>".$item['Owner']['name']."</h3>",
                    //first array for link
                    array(
                        '#'
                    //second array from attributes
                    ), array(
                    'id' => 'hi',
                    //'escapeTitle => true' means html will be outputted as text and not html
                    'escapeTitle' => false
                    ));
            ?>
            </div>

        <?php

        echo "<h2 class='item_condition item_detail'> Condition: ".$item['Item']['condition']."</h2>";
        echo "<p class='item_description item_detail'> Description: ".$item['Item']['description']."</p>";
        echo "<p class='item_description item_detail'> Asking Price: $".$item['Item']['price']."</p>";

        //MAKE THIS WORK AGAIN OR SOMETHING
        /*
         *                 echo $this->element('image', array(
                    'src' => 'cake.icon.png',
                    'class' => 'btn btn-lg btn-success',
                    'url' => array(
                        'controller' => 'items',
                        'action' => 'watch',
                        $user['User']['id'],
                        $item['Item']['id']
                    )
                ));

       */

        //ONLY INCLUDING THIS BUTTON IF LOGGED IN CAUSE OTHERWISE URL CRASHES AND DONT WANT TO WRITE TOO MUCH LOGIC HERE.
        // FIX THIS, BUTTON SHOULD APPEAR ANYWAYS AND TAKE USER TO LOGIN
        if($user) {
            echo $this->Html->link(
                'Add to WatchList',
                array(
                    'controller' => 'items',
                    'action' => 'watch',
                    $user['User']['id'],
                    $item['Item']['id']
                ),
                array(
                    'class' => 'btn btn-lg btn-success login',
                    'target' => '_blank',
                )
            );
        }

            ?>
    </div>
</div>
<div class="container">
    <?php
    echo $this->element('commentSection', array(
        'comments' => $item['Comment'],
        'owner_id' => $item['Item']['owner_id']
    ));
    ?>
</div>

