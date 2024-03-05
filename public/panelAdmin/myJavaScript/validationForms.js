let Regexes = {
    'userName' : {
        'regex' : /^[a-zA-Z0-9]+$/,
        'errorMessage' : 'نام کاربری معتبر نمیباشد'
    },
    'password' : {
        'regex' : /^[a-zA-Z0-9]+$/,
        'errorMessage' : 'رمز عبور معتبر نمیباشد'
    },
}
function notificationMessageRegex(key , type){
    switch (type){
        case 'error' :
            alertify.error(Regexes[key].errorMessage);
    }
}
function regexChecker(form){
    let inputs = $(form).find('input');
    let flag = true;
    for(let i = 0 ; i < inputs.length ; i++){
        let data_regex = inputs[i].getAttribute('data-regex');
        if(data_regex != null){
            if(inputs[i].value.match(Regexes[data_regex].regex) == null){
                notificationMessageRegex(data_regex , 'error');
                flag = false;
            }
        }
    }
    return flag;
}
$(function(){
    if($('form.login-user-form')){
        $(document).on('submit' , 'form.login-user-form' , function(e){
            e.preventDefault();
            let that = $(this);
            let successUrl = that.attr('data-success-url');
            let method = that.attr('method');
            let url = that.attr('action');
            let data = that.serialize();
            if(regexChecker(that)){
            $.ajax({
                    type : method,
                    url : url,
                    data : data,
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
                })
            }
        });
    }

})
