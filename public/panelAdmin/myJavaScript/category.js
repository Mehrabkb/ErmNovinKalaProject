$(function(){
    $(document).on('click' , '.btn-delete-category' , function(e){
        let that = $(this);
        let product_category_id = that.attr('data-id');
        $('.delete-form-category').find('input.category-data-id').val(product_category_id);
    });
    $(document).on('submit' , 'form.delete-form-category' , function(e){
        e.preventDefault();
        let that = $(this);
        let url = that.attr('action');
        let method = that.attr('method');
        let data = that.serialize();
        $.ajax({
            url : url,
            method : method ,
            data : data ,
            success : function(result){
                let res = JSON.parse(result);
                switch (res.type){
                    case 'error' :
                        alertify.error(res.message);
                        break;
                    case 'success':
                        alertify.success(res.message);
                        that.trigger('reset');
                        location.reload();
                        break;
                }
            }
        })
    });
    $(document).on('click' , '.btn-edit-category-step-one' , function(e){
        let that = $(this);
        let url = that.attr('data-url');
        let category_id = that.attr('data-id');
        let method = that.attr('data-method');
        $.ajax({
            url : url,
            method : method ,
            data : {
                'category_id' : category_id
            },
            success : function(result){
                let form = $('form.edit-form-category');
                form.find('input.product-category-data-id').val(result.product_category_id);
                form.find('input#english-category').val(result.english_category);
                form.find('input#persian-category').val(result.persian_category);
                form.find('img.image').attr('src' , result.image);
                if(result.parent_category_id != 0){
                    form.find('.now-parent-category').addClass('show');
                    form.find('input.now-parent-category-input').val(result.parent_category_id);
                }else{
                    form.find('.now-parent-category').removeClass('show');
                }
                if(result.tag_id != 0){
                    form.find('.now-tag-category').addClass('show');
                    form.find('input.now-tag-category-input').val(result.tag_id);
                }else{
                    form.find('.now-tag-category').removeClass('show');
                }
            }
        })
    });
})
