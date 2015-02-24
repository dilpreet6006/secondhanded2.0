<?php
//debug($comment);
$commentAttributes = array(
    'openReply' => 'commentSlideOpen(this);',
    'closeReply' => 'commentSlideClose(this);',
        //dont forget to add a space after every class name
    'class' => ((isset($class))?$class." ":'comment ').
        (($parent)?'parent_comment ':'child_comment ').
        (($owner)?'owner_comment ':'standard_comment '),
);
?>

<div class='<?php echo $commentAttributes['class']." thread_".$thread; ?>'
     <?php
     if(isset($id)) { echo ' id="'.$id.'" '; } ?>  >
    <h2 class=" comment-username">
        <?php echo $this->element('image', array(
                'src' => $comment['Author']['img'],
                'class' => 'thumbnail comment-thumb'
        )); ?>
        <?php echo $comment['Author']['name']; ?>
    </h2>
    <?php
        if(!$parent)
            echo '<span class=" comment_target ">in response to '.$comment['Target']['Author']['name'].'</span>'; ?>
    <div class="text-area">
        <p class="comment-main">

            <?php echo $comment['body']; ?>
        </p>
    </div>
    <?php // reply to comment link
    echo $this->element('image', array(
        "class" => " reply_button ",
        "onClick" => $commentAttributes['openReply'],
        "src" => 'comment_reply_button.jpg',
    )); ?>
    <div class="comment_reply">
        <?php
        echo $this->element('image', array(
            "class" => " cancel_button ",
            "onClick" => $commentAttributes['closeReply'],
            "src" => 'comment_cancel_button.jpg'
        ));
        echo $this->element('commentForm', array(
        'target' => $comment['id'],
        'parent' => ($comment['parent_id'])? $comment['parent_id'] : $comment['id']
        ));
    ?>
    </div>
</div>