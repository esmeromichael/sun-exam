$('#create-btn').on('click', function(){
    var title = $('.article-title');
    var content = $('.article-content');

    $('.data_action').val('add');
    title.val('');
    content.val('');


})

var BASE_URL = window.location.origin;

$(document).ready(function(me){
    

    $('.post-btn').on('click', function(){

        var title = $('.article-title');
        var content = $('.article-content');

        if(!title.val()){
            alert('Please fill up article title');
            return false;
        } else if(!content.val()) {
            alert('Please fill up article content');
            return false;
        }

        $.ajax({
            url  : BASE_URL+"/create",
            type: 'post',
            data: $('#add_edit_form').serialize(),
            cache: false,
            success: function(data){
                if(data.success)
                {
                    alert(data.message)
                } else {
                    alert('Nothing to save.')
                }
            },
            complete: function() {
                
            }
        })
    })

    $('.btn-edit').on('click', function(){
        var that    = $(this);
        var title   = $('.article-title');
        var content = $('.article-content');

        var id      = that.data('id');
        var article_title = that.data('title')
        var article_content = that.data('content');

        $('.data_action').val('edit');
        title.val('').val(article_title);
        content.val('').val(article_content);
        $('.article-id').val('').val(id);
    })

    $(".close").on("click", function () {
        getArticle()
    });

    isDelete();
})

function isDelete()
{
    $('.btn-delete').on('click', function(){
        var id = $(this).data('id');

        var con = confirm('Are you sure you want to delete?')
        if(con){
            deleteArticle(id)
        }
    })
}

function deleteArticle(id)
{
    $.ajax({
        url: BASE_URL+'/delete?id='+id,
        // dataType: 'json',
        beforeSend: function() {
            
        },
        complete: function() {
            
        }
    }).done(function(data) {
        alert(data.message)
        getArticle()
    }).fail(function() {
        return 'not success';
    });
}

function getArticle()
{
    $.ajax({
        url: BASE_URL+'/',
        // dataType: 'json',
        beforeSend: function() {
            
        },
        complete: function() {
            
        }
    }).done(function(data) {
        $('.article-result').html(data);
        isDelete()
    }).fail(function() {
        
        return 'not success';
    });
}