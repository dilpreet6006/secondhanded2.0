<?php foreach ($items as $item){ ?>
    <div class="SearchItem jumbotron">
        <div class="item_image medium">
            <?php
                echo $this->element('image', array(
                    'src' => $item['Item']['img_url'],
                    'url' => array(
                        'controller' => 'items',
                        'action' => 'view',
                        $item['Item']['id']
                    )
                ));
            ?>
        </div>
        <div class="item_detail">
        <?php
        //DUPLICATE CODE!!
        //THIS SHOULD BE ITS OWN ELEMENT
            echo "<h2>".$item['Item']['title']."</h2>";
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
        //PUT THIS INTO A DIV, MAKE EVERYTHING NICE WITH DIVS, USING <BR> IS ATROCIOUS
        echo "<br>";  echo "<br>";
        echo "<p> Asking Price: $".$item['Item']['price']."</p>";

        ?>
        </div>
    </div>
<?php } ?>