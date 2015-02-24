/**
 * Created by santiago on 2015-02-10.
 */

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview_img').attr('src', e.target.result).width(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function commentSlideOpen(e){
    var parent = $(e).closest('div');
    var id = parent[0].id;
    var elem = $('#'+id+' .comment_reply');
    var replyBtn = $('#'+id+' .reply_button');
    elem.show( "slow" );
    replyBtn.hide( "slow" );
}

function commentSlideClose(e){
    var parents = $(e).parents();
    var id = parents[1].id;
    var elem = $('#'+id+' .comment_reply');
    var replyBtn = $('#'+id+' .reply_button');
    elem.hide( "slow" );
    replyBtn.show( "slow" );
}