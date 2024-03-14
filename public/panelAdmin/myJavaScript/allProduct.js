$(function(){
    $(document).on('click' , '.btn-delete-product' , function(e){
        let that = $(this);
        let data_id = that.attr('data-id');
        let form = $('form.delete-form-product');
        form.find('input[name="product-id"]').val(data_id);
    })
})
