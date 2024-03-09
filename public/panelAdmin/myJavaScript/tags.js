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
    $('input#tags-search-edit').keypress(function(e){
        if(e.which === 13){
            let that = $(this);
            let inputValue = $('input#tags-value');
            let txt = inputValue.val() + that.val();
            let deleteButtons = that.parent().find('.delete-buttons');
            if(that.val() != ''){
                deleteButtons.append(`<button class="btn btn-danger">
                <span>${that.val()}</span>
                    <button class="btn-delete-tag-item" type="button" style="background:none!important;border:none;"><i class="fa fa-close"></i></button>
                </button>`)
                inputValue.val(inputValue.val()+ ',' + that.val())
                that.val('');
            }
        }
    });

    $('form.edit-form-tag').keypress(function(e){
        if(e.which === 13){
            e.preventDefault();
            return false;
        }
    });
    $('form.form-add-tag').keypress(function(e){
        if(e.which === 13){
            e.preventDefault();
            return false;
        }
    });
    $(document).on('click' , 'button.btn-delete-tag-item' , function(e){
        e.preventDefault();
        let that = $(this);
        let txt = that.parent().find('span').html();
        let input = that.closest('.form-group').find('input#tags-value');
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
    $(document).on('click' , '.btn-edit-tag-step-one' , function(e){
        let that = $(this);
        let url = that.attr('data-url');
        let method = that.attr('data-method');
        let tag_id = that.attr('data-id');
        $.ajax({
            url : url,
            method : method ,
            data : {
                'tag-id' : tag_id
            },
            success: function(result){
                let form = $('form.edit-form-tag');
                form.find('.tag-data-id').val(result.public_tag_id);
                form.find('#tags-title').val(result.tags_title);
                form.find('input[name="tags-value"]').val(result.tags_value);
                let buttonsTag = form.find('.delete-buttons');
                buttonsTag.empty();
                for(let i = 0 ; i < result.tags_value.split(',').length ; i++){
                    if(result.tags_value.split(',')[i] != ''){
                        buttonsTag.append(`<button  class="btn btn-danger" style="margin-top:3px;">
                        <span>${result.tags_value.split(',')[i]}</span>
                        <button class="btn-delete-tag-item" type="button" style="background:none!important;border:none;"><i class="fa fa-close"></i></button>
                        </button>`);
                    }
                }
            }
        })
    });
    if($('form.edit-form-tag')){
        $(document).on('submit' , 'form.edit-form-tag' , function(e){
            e.preventDefault();
            let that = $(this);
            let url = that.attr('action');
            let method = that.attr('method');
            let data = that.serialize();
            $.ajax({
                url : url,
                method : method,
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
    }
});
