let Regexes = {
    'userName' : {
        'regex' : /^[a-zA-Z0-9]+$/,
        'errorMessage' : 'نام کاربری معتبر نمیباشد'
    },
    'password' : {
        'regex' : /./,
        'errorMessage' : 'رمز عبور معتبر نمیباشد'
    },
    'force-english' :{
        'regex' : /^[a-zA-Z]+$/,
        'errorMessage' : 'فقط حروف انگلیسی مجاز میباشند'
    },
    'force-persian' :{
        'regex' : /^[\u0600-\u06FF\s]+$/,
        'errorMessage' : 'فقط حروف فارسی مجاز می باشند'
    },
    'english-number' :{
        'regex'  : /^[a-zA-Z0-9]+$/,
        'errorMessage' : 'از واژه های انگلیسی و اعداد استفاده شود'
    },
    'perisan-number':{
        'regex' : /[\u0600-\u06FF\s0-9]+$/,
        'errorMessage' : 'از واژه های فارسی و اعداد استفاده شود'
    }
}
function notificationMessageRegex(title , key , type){
    switch (type){
        case 'error' :
            alertify.error(title + " : " + Regexes[key].errorMessage);
    }
}
function regexChecker(form){
    let inputs = $(form).find('input');
    let flag = true;
    for(let i = 0 ; i < inputs.length ; i++){
        let data_regex = inputs[i].getAttribute('data-regex');
        let data_title = inputs[i].getAttribute('data-title');
        if(data_regex != null){
            if(inputs[i].value.match(Regexes[data_regex].regex) == null){
                notificationMessageRegex(data_title , data_regex , 'error');
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
                    },
                    error:function(result){
                        alertify.error(result.responseJSON.message);
                    }
                })
            }
        });
    }
    if($('form.form-add-unit')){
        $(document).on('submit' , 'form.form-add-unit' , function(e){
            e.preventDefault();
            let that = $(this);
            let method = that.attr('method');
            let url = that.attr('action');
            let data = that.serialize();
            if(regexChecker(that)){
                $.ajax({
                    type : method ,
                    url : url ,
                    data : data ,
                    success  : function(result){
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
            }
        })
    }
    if($('form.edit-form-unit')){
        $(document).on('submit' , 'form.edit-form-unit' , function(e){
            e.preventDefault();
            let that = $(this);
            let url = that.attr('action');
            let method = that.attr('method');
            let data = that.serialize();
            if(regexChecker(that)){
                $.ajax({
                    method : method ,
                    url : url ,
                    data : data,
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
            }
        });
    }
    if($('form.form-add-tag')){
        $(document).on('submit' , 'form.form-add-tag' , function(e){
            e.preventDefault();
            let that = $(this);
            let url = that.attr('action');
            let method = that.attr('method');
            let data = that.serialize();
            if($('input[name="tags-title"]').val() != '' && $('input[name="tags-value"]').val() != ''){
                $.ajax({
                    url : url ,
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
            }else{
                alertify.error('کاربر گرامی لطفا مقادیر تعیین شده را تکمیل و سپس اقدام به ثبت آیتم مورد نظر کنید');
            }
        });
    }
})
