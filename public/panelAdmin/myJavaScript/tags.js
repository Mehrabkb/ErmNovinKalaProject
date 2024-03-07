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
    })
    $(document).on('click' , 'button.btn-delete-tag-item' , function(e){
        let that = $(this);
        let txt = that.parent().find('span').html();
        let input = $('input#tags-value');
        let testTxt = '';
        testTxt = input.val();
        testTxt = testTxt.replace(',' +txt , '');
        console.log(testTxt);
        input.val(testTxt);
        that.parent().remove();
    });
});
