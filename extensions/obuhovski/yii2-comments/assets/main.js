$(document).on('click','[href="#comment-form"]',function(){
    $media = $(this).parents('.media');
    if ($media.length > 0) {
        $media.append($('.post-comment'));
        $(document).find('[name="CommentForm[parent_id]"]').val($(this).attr('data-comment-id'));
    } else {
        $(this).parent().parent().append($('.post-comment'));
        $(document).find('[name="CommentForm[parent_id]"]').val('');
    }
});


