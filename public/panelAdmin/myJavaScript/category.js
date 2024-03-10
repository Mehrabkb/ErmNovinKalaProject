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
    })
})
