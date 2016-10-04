// каруселька отзывов
jQuery(document).ready(function() {
	$("#owl-reviews").owlCarousel();
});
// каруселька партнеров	
jQuery(document).ready(function() {		 
	$("#owl-example").owlCarousel({	  
		autoPlay: 3000, //Set AutoPlay to 3 seconds	 
		items : 4,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,3]		 
	});
});
// отображение раздела в котором находится пользователь
jQuery('body').scrollspy({ target: '.navbar-example' })
// плавный переход по разделам	
jQuery(function(){
	$('.some_link').on('click', function(e){
		$('html,body').stop().animate({ scrollTop: $('#some_point').offset().top }, 1000);
		e.preventDefault();
	});
});	
 // кнопка вверх		
jQuery(function () {
	$.scrollUp();
});	
// меню в разделе о компании
jQuery(document).ready(function($) {
	$('#myTabExample a:last').tab('show');
 });
// меню в разделе оптимизация	
 jQuery(document).ready(function($) {
	$('#myStepExample a:last').tab('show');
});

/*подсчет оставшихся символов в форме*/

//при нажатию на любую кнопку, имеющую класс .btn открыть модальное окно с id="myModal"

// галлерея с мероприятий
