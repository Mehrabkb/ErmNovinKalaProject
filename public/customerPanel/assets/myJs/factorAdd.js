$(function(){
    $(document).on('keyup' , '#search-bar' , function(){
        let that = $(this);
        let url = that.attr('data-url');
        let method = 'GET';
        let value = that.val();
        $.ajax({
            url : url,
            method : method,
            data : {
                'q' : value
            },
            success : function(result){
                let select = $('.slc-products');
                select.empty();
                // select.append(`<option selected disabled>انتخاب کنید</option>`);
                if(result.length > 0){
                    for(let i = 0 ; i < result.length ; i++){
                        select.append(`<option value="${result[i].product_id}">${result[i].title} ${result[i].description}</option>`);
                    }
                }else{
                    select.append(`<option selected disabled>هیچ محصولی با این مشخصات یافت نشد</option>`)
                }
            }
        });
    });
});
