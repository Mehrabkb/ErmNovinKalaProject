$(function(){
    $(document).on('click' , '.btn-delete-user' , function(e){
        let that = $(this);
        let form = $('form.delete-form-user');
        form.find('input.user-data-id').val(that.attr('data-id'));
    });
    $(document).on('click' , '.btn-edit-user-step-one' , function(e){
        let that = $(this);
        let user_id = that.attr('data-id');
        let url = that.attr('data-url');
        let method = 'GET';
        $.ajax({
            url : url,
            method : method ,
            data : {
                'id' : user_id
            },
            success: function(result){
                console.log(result);
                let form = $('form.edit-form-user');
                form.find('input.user-data-id').val(result.user_id);
                form.find('input[name="username"]').val(result.user_name);
                form.find('input[name="first-name"]').val(result.first_name);
                form.find('input[name="last-name"]').val(result.last_name);
                form.find('input[name="phone"]').val(result.phone);
            }
        })
    })
})
