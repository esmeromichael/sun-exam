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

var URL = window.location.origin;
var locked = 0;

$(document).ready(function(me){
    uploadimg()
    passwordConfirmation()
    $('#image_placeholder').html('');
    $('.post-btn').on('click', function(){

        var name = $('.name');
        var email = $('.email');
        var password = $('.password');
        var data_action = $('.data_action').val();

        if(!name.val()){
            swal('Opps!', 'Please fill up name', 'warning');
            return false;
        } else if(!email.val()) {
            swal('Opps!', 'Please fill up email', 'warning');
            return false;
        }  else if(!password.val()) {
            if(data_action == "add"){
                 swal('Opps!', 'Please fill up password', 'warning');
                return false;
            }
            
        } else if(!$('.terms').is(':checked')){
             swal('Opps!', 'Please check terms and condition', 'warning');
            return false;
        }

        $.ajax({
            url  : URL+"/user/create",
            type: 'post',
            data: $('#add_edit_form').serialize(),
            cache: false,
            success: function(data){
                if(data.success)
                {
                    swal('Opps!', data.message, 'warning');
                    window.reload.location();
                } else {
                    swal('Opps!', 'Nothing to save.', 'warning');
                }
            },
            complete: function() {
                
            }
        })
    })

    editList()

    $('.update-profile').on('click',function(){
        var that    = $(this);
       
        var id    = that.data('id');
        var name  = that.data('name')
        var email = that.data('email');
        var image = that.data('image');

        $('.data_action').val('edit');
        $('.name').val('').val(name);
        $('.email').val('').val(email);
        $('.user-id').val('').val(id);
        $('.terms').prop('checked', true);

        $('.img-div').show();
        $('#image_placeholder').html('');
        $('#image_placeholder').html(setImageHTML(null,URL+'/img/'+ image));
    })
    $(".close").on("click", function () {
        getList()
    });

    isDelete();

    $('.email').on('change', function(e){
        var email = e.target.value;
        if(!email){
            locked = 0;
        }
    });

    $('.email').on('keypress', function(event){
        var email = event.target.value;
        locked    = 0;

        if(event.which === 13){
            if(!validateEmail(email)) {
                swal('Opps!', 'Email not valid.', 'warning');
                $(this).val('')
                return false;
            }

            $.ajax({
                url: URL+'/user/validate-email?email='+email,
                beforeSend: function() {
                },
                complete: function() {
                    
                }
            }).done(function(data) {
                if(data.result > 0){
                    swal('Opps!', 'Email already in used.', 'warning');
                    $(this).val('')
                }
            }).fail(function() {
                return 'not success';
            });
        }
    })

    $('.loginbtn').on('click', function(){

        var email = $('.logemail');
        var password = $('.logpassword');

         if(!email.val()) {
            swal('Opps!', 'Please fill up email', 'warning');
            return false;
        }  else if(!password.val()) {
            swal('Opps!', 'Please fill up password', 'warning');
            return false;
        }

        $.ajax({
            url  : URL+"/user/login",
            type: 'post',
            data: $('#login_form').serialize(),
            cache: false,
            success: function(data){
                if(data.success)
                {
                    window.location.reload();
                } else {
                    if(data.not_password > 0){
                        locked++;
                    }
                    if(locked >= 3){
                        lockAccount(email.val())
                       // swal("Opps!", 'Youre reached 3 attempts. Account is locked', "danger");
                    } else {
                        swal("Opps!", data.message, "warning");
                    }
                    
                }
            },
            complete: function() {
                
            }
        })
    })
})

function lockAccount(email)
{
    $.ajax({
        url: URL+'/user/locked-account?email='+email,
        // dataType: 'json',
        beforeSend: function() {
            
        },
        complete: function() {
            
        }
    }).done(function(data) {
        swal('Opps!', data.message, 'warning');
        getList()
    }).fail(function() {
        return 'not success';
    });
}

function editList()
{
    $('table tbody').on('click', '.btn-edit',function(){
        var that    = $(this);
       
        var id    = that.data('id');
        var name  = that.data('name')
        var email = that.data('email');
        var image = that.data('image');

        
        $('.data_action').val('edit');
        $('.name').val('').val(name);
        $('.email').val('').val(email);
        $('.user-id').val('').val(id);
        $('.terms').prop('checked', true);
        $('.img-div').show();
        $('#image_placeholder').html('');
        $('#image_placeholder').html(setImageHTML(null,URL+'/img/'+ image));
        //$('#uploading').hide();
    
        uploadimg(id)
    })
}

function setImageHTML(item_id_image, image_url){
    var image_placeholder = '<form role="form" id="avatarForm" method="post" enctype="multipart/form-data">';
            image_placeholder += '<input type="hidden" id="recipe_id_image" name="recipe_id_image" value="'+item_id_image+'">';
            image_placeholder += '<label class="avatar_img" for="uploadImage" style="">';
                image_placeholder += '<span class="embed-avatar">';
                    image_placeholder += '<span class="img-avatar img-avatar-lg bg" style="background: url(\''+image_url+'\') no-repeat center;max-width: 100%;max-height: 100%;"></span>';
                image_placeholder += '</span>';
                image_placeholder += '<span id="uploading"><i class="fa fa-circle-o-notch fa-spin"></i> Uploading your image...</span>';
                image_placeholder += '<span class="camera" style="">';
                    image_placeholder += '<i class="fa fa-camera fa-lg" style="color: blueviolet"></i>';
                image_placeholder += '</span>';
                image_placeholder += '<input type="file" name="uploadImage" id="uploadImage" class="upload-avatar" accept="image/*" style="display: none;">';
            image_placeholder += '</label>';
        image_placeholder += '</form>';
    return  image_placeholder;
}

function uploadimg(id)
{
    $("input[name='uploadImage']").change(function () {
        if (this.files.length > 0) {
            if (!window.FormData) {
                swal("Opps!", "Your browser does not support FormData object.", "warning");
                return false;
            }
            $.ajax({
                url: URL+"/user/upload-img?id="+id,
                method: 'POST',
                dataType: 'json',
                data: new FormData(this.form),
                contentType: false,
                processData: false,
                beforeSend: function () {
                   $('#uploading').show();
                },
                success: function (data) {
                    if (data.success) {
                        var uploaded_url = data.image_url;
                        $(".avatar_img .embed-avatar .img-avatar").css({"background": "url('" + uploaded_url + "') no-repeat center"});
                    }else{
                        
                    }
                },
                complete: function () {
                    $('#uploading').hide();
                 },
                error: function () {
                    $('#uploading').hide();
                }
            });
        }
    });
}
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
        url: URL+'/user/delete?id='+id,
        // dataType: 'json',
        beforeSend: function() {
            
        },
        complete: function() {
            
        }
    }).done(function(data) {
        swal('Opps!', data.message, 'warning');
        getList()
    }).fail(function() {
        return 'not success';
    });
}

function getList()
{
    $.ajax({
        url: URL+'/',
        // dataType: 'json',
        beforeSend: function() {
            
        },
        complete: function() {
            
        }
    }).done(function(data) {
        $('.article-result').html(data);
        isDelete()
        editList()
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