$(function(){
    $(document).on('click' , '.btn-delete-brand' , function(e){
        let that = $(this);
        $('form.delete-form-brand input.brand-data-id').val(that.attr('data-id'));
    })

})
