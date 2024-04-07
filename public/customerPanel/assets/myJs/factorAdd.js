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
    $(document).on('click' , '.btn-delete-basket-item' , function(e){
       let that = $(this);
       let url = that.attr('data-url');
       let id = that.attr('data-id');
       $.ajax({
           url : url ,
           method : 'POST',
           data : {
               'id' : id
           },
           success : function(result){
               let res = JSON.parse(result);
               switch (res.type){
                   case 'error' :
                       alertify.error(res.message);
                       break;
                   case 'success':
                       alertify.success(res.message);
                       setTimeout(function(){
                           location.reload();
                       } , 2000)
                       break;
               }
           }
       });
    });

});
function changeOfficialBillCheckBox(event){
    let basket_id = event.getAttribute('data-id');
    let url = event.getAttribute('data-url');
    let value = 0 ;
    if(event.checked){
        value = 1;
    }
    $.ajax({
        url : url ,
        method : 'POST',
        data:{
            'basket-id' : basket_id,
            'value' : value
        },
        success:function(result){
            let res = JSON.parse(result);
            switch (res.type){
                case 'error' :
                    alertify.error(res.message);
                    break;
                case 'success':
                    alertify.success(res.message);
                    setTimeout(function(){
                        location.reload();
                    } , 2000)
                    break;
            }
        }
    })
}
