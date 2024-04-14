$(function(){
    $(document).on('click' , '.request-verficitaion-code-btn' , function(e){
        let that = $(this);
        let url = that.attr('data-url');
        let mobile = that.parent().parent().find('input[name="mobile"]').val();
        let method = 'POST';
        if(mobile != ''){
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
            changeBtnHtml(true);
            setTimeout(function(){
                that.attr('disabled' , false);
                changeBtnHtml(false);
            },124000);
        }else{
            alertify.error('شماره موبایل معتبر نمی باشد');
        }
    });
});
function changeBtnHtml(flag){
    let elm = $('.request-verficitaion-code-btn');
    if(flag){
        let counter =  121 ;
        let myInterval = setInterval(function(){
            elm.html(--counter + ' ثانیه');
            if(counter == 0){
                clearInterval(myInterval);
            }
        } , 1000);
    }else{
        elm.html('ارسال کد فعالسازی');
    }
}
