$(function(){
    $(document).on('click' , '.btn-delete-user' , function(e){
        let that = $(this);
        let form = $('form.delete-form-user');
        form.find('input.user-data-id').val(that.attr('data-id'));
    });
})
