<?php
//debug($comments);

$index = array();

//order comments into index with their id's as value
//result will look like this:
/* $index = array(
 *      [1] => array (
 *          [1] => Parent_id(comment_id),
 *          [2] => reply_id(comment_id)
 *      ),
 *      [2] => array (
 *          [1] => OP_id(comment_id)
 *      )
 * );
 *
 */
//get all parents and put them into index as first entries in each array
foreach($comments as $comment){
    //check if comment is parent
    if(!$comment['parent_id']){
        $index[count($index)] = array(
            $comment['id']
        );
    }
}
//get all children and put them in the right threads
foreach($comments as $comment){
    //check if comment is child
    if($comment['parent_id']){
        //find its thread and insert comment
        $threadIndex = findThreadIndex($comment['parent_id'], $index);
        //add clause because threadIndex gives false when 0
        if ($threadIndex || $threadIndex === 0){
            $index[$threadIndex][count($index[$threadIndex])] = $comment['id'];
        }
    }
}

// end of comment section, comment form
// comment form with false target for basic comment form
echo '<div class="jumbotron">';
echo $this->element('commentForm', array(
    'target' => false
));
echo '</div>';

// here we get each id in order and call comment element to print out the comments with appropriate display
$idBase = 'comment_';
$idCounter = 0;
foreach($index as $thread_key => $thread){
    foreach($thread as $key => $comment_id) {
        //get comment, function defined below
        $comment = getComment($comment_id, $comments);
        if ($comment) {
            echo $this->element('comment', array(
                'class' => ($key == 0) ? 'jumbotron comment' : 'jumbotron jumbo-reply comment',
                'id' => $idBase.$idCounter,
                'comment' => $comment,
                'parent' => ($key == 0) ? true : false,
                'owner' => ($comment['author_id'] == $owner_id) ? true : false,
                'thread' => $thread_key
            ));
        }
        $idCounter++;
    }
}

//functions:

//function gets whole comment object that has matching id, or false
function getComment($comment_id, $comments){
    foreach($comments as $comment){
        if($comment['id'] == $comment_id){
            return $comment;
        }
    }
    return false;
}

//returns index of thread containing comment
function findThreadIndex($parent_id, $index){
    foreach($index as $key => $thread){
        if($thread[0] == $parent_id){
            return $key;
        }
    }
    return false;
}
