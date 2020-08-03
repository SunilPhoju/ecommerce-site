/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
$(document).ready(function(){

	//change price & stock check
	$("#selColor").change(function(){
		var idColor = $(this).val();
		if(idColor == ""){
			return false;
		}
		$.ajax({
			type:'get',
			url:'/get-product-price',
			data:{idColor:idColor},
			success:function(resp){
				//alert(resp); return false;
				var arr = resp.split('#');
				$("#getPrice").html("NRS."+arr[0]);
				$("#price").val(arr[0]);
				if(arr[1]==0){
					$("#cardButton").hide();
					$("#Availability").text("Out Of Stock");
				}else{
					$("#cardButton").show();
					$("#Availability").text("In stock Stock");
				}
			},error:function(){
				alert("error");
			}	
		});
	});
	//replace alternative image in main image
	$(".changeImage").click(function(){
		var image = $(this).attr('src');
		$(".mainImage").attr("src",image);
	});

	var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);

		e.preventDefault();

			// Use EasyZoom's `swap` method
		api1.swap($this.data('standard'), $this.attr('href'));
	});

		// Setup toggles example
	var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

	$('.toggle').on('click', function() {
		var $this = $(this);

		if ($this.data("active") === true) {
			$this.text("Switch on").data("active", false);
			api2.teardown();
		} else {
			$this.text("Switch off").data("active", true);
			api2._init();
		}
	});

	$("#current_pwd").keyup(function(){
		//alert('test');
		var current_pwd = $(this).val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
			type:'post',
			url:'/check-user-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				//alert(resp);
				if(resp=="false"){
					$("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
				}else if(resp=="true"){
					$("#chkPwd").html("<font color='green'>Current Password is correct</font>");
				}
			},error:function(){
				alert("Error");
			}
		});
	});

	//copy billing address to shipping addrress
	$("#billtoship").click(function(){
		if(this.checked){
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_country").val($("#billing_country").val());
			$("#shipping_pincode").val($("#billing_pincode").val());
			$("#shipping_mobile").val($("#billing_mobile").val());

		}else{
			$("#shipping_name").val('');
			$("#shipping_address").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_country").val('');
			$("#shipping_pincode").val('');
			$("#shipping_mobile").val('');

		}
	});

	

});




