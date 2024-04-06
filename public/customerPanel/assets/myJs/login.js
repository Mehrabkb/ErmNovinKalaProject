$(function(){
    $(document).on('click' , '.request-verficitaion-code-btn' , function(e){
        let that = $(this);
        let url = that.attr('data-url');
        let mobile = that.parent().parent().find('input[name="mobile"]').val();
        let method = 'POST';
        if(mobile != '' && mobile.match(/(0|\+98)?([ ]|-|[()]){0,2}9[1|2|3|4]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/)){
            $.ajax({
                url : url ,
                method : method ,
                data : {
                    'mobile' : mobile
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
                                location.replace(successUrl);
                                location.reload();
                            } , 2000)
                            break;
                    }
                }
            });
            that.attr('disabled' , true);
            setInterval(function(){
                that.attr('disabled' , false);
            },120000);
        }else{
            alertify.error('شماره موبایل معتبر نمی باشد');
        }
    });
});
