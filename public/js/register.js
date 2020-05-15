$('#create-btn').on('click', function(){
    var name = $('.name');
    var email = $('.email');
    var password = $('.password');
    var repeatpassword = $('.repeat-password');

    $('.data_action').val('add');
    name.val('');
    email.val('');
    password.val('');
    repeatpassword.val('');
    passwordConfirmation()
    $('.terms').prop('checked', false);
})

var BASE_URL = window.location.origin;

$(document).ready(function(me){
    
    passwordConfirmation()
    $('.post-btn').on('click', function(){

        var name = $('.name');
        var email = $('.email');
        var password = $('.password');
        var data_action = $('.data_action').val();

        if(!name.val()){
            alert('Please fill up name');
            return false;
        } else if(!email.val()) {
            alert('Please fill up email');
            return false;
        }  else if(!password.val()) {
            if(data_action == "add"){
                alert('Please fill up password');
                return false;
            }
            
        } else if(!$('.terms').is(':checked')){
            alert('Please check terms and condition');
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
       
        var id  = that.data('id');
        var name = that.data('name')
        var email = that.data('email');
        
        $('.data_action').val('edit');
        $('.name').val('').val(name);
        $('.email').val('').val(email);
        $('.user-id').val('').val(id);
        $('.terms').prop('checked', true);
    })

    $(".close").on("click", function () {
        getArticle()
    });

    isDelete();

    $('.email').on('change', function(e){
        var email = e.target.value;

        if(!validateEmail(email)) {
            alert('Email not valid.');
            $(this).val('')
            return false;
        }

        $.ajax({
            url: BASE_URL+'/validate-email?email='+email,
            beforeSend: function() {
            },
            complete: function() {
                
            }
        }).done(function(data) {
            if(data.result > 0){
                alert('Email already in used.')
                $(this).val('')
            }
        }).fail(function() {
            return 'not success';
        });
    })

    $('.login-btn').on('click', function(){

        var email = $('.email');
        var password = $('.password');

         if(!email.val()) {
            alert('Please fill up email');
            return false;
        }  else if(!password.val()) {
            alert('Please fill up password');
            return false;
        }

        $.ajax({
            url  : BASE_URL+"/login",
            type: 'post',
            data: $('#login_form').serialize(),
            cache: false,
            success: function(data){
                if(data.success)
                {
                    alert(data.message)
                } else {
                    alert('Unable to login.')
                }
            },
            complete: function() {
                
            }
        })
    })
})


function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test(email);
}

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

function passwordConfirmation(){
    $('.repeat-password').keyup(function(e){
        var password         = $('.password').val();
        var confirm_password = e.target.value;
        var p_tetxt          = $('.password-text');

        p_tetxt.html('')
        
        if(password == confirm_password)
        {
            p_tetxt.css('color', '#008000').html('Password match!')
        } else {
            p_tetxt.css('color', '#ff3333').html('Mismatch password!')
        }
    });
}