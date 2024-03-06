$(function(){
    $('#unit-table').DataTable({
        "language": {
            "lengthMenu": "نمایش _MENU_ در هر صفحه",
            "zeroRecords": "هیچ چیزی برای نمایش وجود ندارد",
            "info": "نمایش _PAGE_ از _PAGES_",
            "infoEmpty": "خالی",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "جستجو : ",
            'paginate': {
                'previous': 'قبلی',
                'next': 'بعدی'
            }
        }
    });
    $(document).on('click' , 'button.btn-delete-unit' , function(e){
        let that = $(this);
        $('.delete-form-unit').find('.unit-data-id').val(that.attr('data-id'));
    });
    if($('form.delete-form-unit')){
        $(document).on('submit' , 'form.delete-form-unit' , function(e){
            e.preventDefault();
            let that = $(this);
            let method = that.attr('method');
            let url = that.attr('action');
            let data = that.serialize();
            $.ajax({
                url : url ,
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
                            setTimeout(function(){
                                location.reload();
                            } , 3000)
                            break;
                    }
                }
            })
        })
    }
    $(document).on('click' , 'button.btn-edit-unit-step-one' , function(e){
        let that = $(this);
        let url = that.attr('data-url');
        let method = that.attr('data-method');
        let id = that.attr('data-id');
        $.ajax({
            url : url,
            method : method,
            data : {
                'id' : id
            } ,
            success : function(result){
                let form = $('form.edit-form-unit');
                form.find('input.unit-data-id').val(result.unit_id);
                form.find('input.long-title').val(result.long_title);
                form.find('input.short-title').val(result.short_title);


            }
        })
    });
})
