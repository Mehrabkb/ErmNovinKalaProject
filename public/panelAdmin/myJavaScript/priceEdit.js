$(function(){
	$(document).on('click' , 'button.btn-edit-price-submit' , function(e){
		let that = $(this);
		let price = that.parent().parent().find('input.price').val();
        let company_price = that.parent().parent().find('input.product-company-price').val();
		let product_id = that.attr('data-id');
		let url = that.attr('data-url');
		let csrf_token = $('meta[name="csrf-token"]').attr('content');
		let method = that.attr('data-method');
		$.ajax({
			url : url,
			method : method ,
			data : {
				'_token' : csrf_token,
				'id' : product_id,
				'price' : price,
                'product-company-price' : company_price
			},
			success : function(result){
				if(!result){
					alertify.error('مشکلی رخ داده است');
				}else{
					alertify.success('با موفقیت ویرایش شد ');
				}
			}
		})
	})
})
