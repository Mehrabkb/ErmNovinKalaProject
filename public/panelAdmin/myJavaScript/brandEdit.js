$(function(){
    $(document).on('click' , 'button.btn-edit-brand-submit' , function(e){
        let that = $(this);
        let brand = that.parent().parent().find('.slc-brand').val();
        console.log(brand);
        let product_id = that.attr('data-id');
        let url = that.attr('data-url');
        let csrf_token = $('meta[name="csrf-token"]').attr('content');
        let method = that.attr('data-method');
        $.ajax({
            url : url,
            method : method ,
            data : {
                '_token' : csrf_token,
                'id' : product_id,
                'brand-id' : brand
            },
            success : function(result){
                if(!result){
                    alertify.error('مشکلی رخ داده است');
                }else{
                    alertify.success('با موفقیت ویرایش شد ');
                }
            }
        })
    })
})
