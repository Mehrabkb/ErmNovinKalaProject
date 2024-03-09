$(function(){
    $('input#tags-search').keypress(function(e){
        if(e.which === 13){
            let that = $(this);
            let inputValue = $('input#tags-value');
            let txt = inputValue.val() + that.val();
            let deleteButtons = $('.delete-buttons');
            if(that.val() != ''){
                deleteButtons.append(`<button class="btn btn-danger">
                <span>${that.val()}</span>
                    <button class="btn-delete-tag-item" style="background:none!important;border:none;"><i class="fa fa-close"></i></button>
                </button>`)
                inputValue.val(inputValue.val()+ ',' + that.val())
                that.val('');
            }
        }
    });
    $('form.form-add-tag').keypress(function(e){
        if(e.which === 13){
            e.preventDefault();
            return false;
        }
    })
    $(document).on('click' , 'button.btn-delete-tag-item' , function(e){
        let that = $(this);
        let txt = that.parent().find('span').html();
        let input = $('input#tags-value');
        let testTxt = '';
        testTxt = input.val();
        testTxt = testTxt.replace(',' +txt , '');
        input.val(testTxt);
        that.parent().remove();
    });
    $(document).on('click' , 'button.btn-delete-tag' , function(e){
        let that = $(this);
        $('.delete-form-tag').find('.tag-data-id').val(that.attr('data-id'));
    });
    if($('form.delete-form-tag')){
        $(document).on('submit' , 'form.delete-form-tag' , function(e){
            e.preventDefault();
            let that = $(this);
            let url = that.attr('action');
            let method = that.attr('method');
            let data = that.serialize();
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
        })
    }
});
