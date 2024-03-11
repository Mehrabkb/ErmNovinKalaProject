$(function(){
    $(document).on('click' , '.btn-delete-brand' , function(e){
        let that = $(this);
        $('form.delete-form-brand input.brand-data-id').val(that.attr('data-id'));
    })
    $(document).on('click' , '.btn-edit-brand-step-one' , function(e){
        let that = $(this);
        let data_id = that.attr('data-id');
        let url = that.attr('data-url');
        let method = that.attr('data-method');
        $.ajax({
            url : url,
            method : method ,
            data : {
                'product-brand-id' : data_id
            },
            success : function(result){
                let form = $('form.edit-form-brand');
                form.find('input[name="product-brand-data-id"]').val(result.product_brand_id);
                form.find('input[name="brand-title"]').val(result.brand_name);
                if(result.brand_logo != null){
                    form.find('.show-imaged-brand').addClass('show');
                    form.find('.show-imaged-brand img').attr('src' , result.brand_logo);
                }else{
                    form.find('.show-imaged-brand').removeClass('show');
                }
            }
        })
    });
})
