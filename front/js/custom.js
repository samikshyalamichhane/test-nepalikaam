$(document).ready(function() {
	$(window).scroll(function() {
		var scroll = $(window).scrollTop();
		// console.log(scroll);
		if (scroll >= 140) {
			// $(".navbar").addClass("sticky");
			$("#site__header").addClass("sticky");
			$("#site__header .topBar__Wrapper").addClass("display-none");
			// $(".scroll__nav").addClass("items-end");
			// $("#nav .navbar-collapse").addClass("removePadding");
		} else {
			// $(".navbar").removeClass("sticky");
			$("#site__header").removeClass("sticky");
			$("#site__header .topBar__Wrapper").removeClass("display-none");
			$(".scroll__nav").removeClass("items-end");
			$("#nav .navbar-collapse").removeClass("removePadding");
		}
		if (scroll >= 100) {
			$(".booking__Box").addClass("booking__Box-scroll");
		} else {
			$(".booking__Box").removeClass("booking__Box-scroll");
		}
		if (scroll > 50) {
			$(".scroll-to-top").fadeIn();
		} else {
			$(".scroll-to-top").fadeOut();
		}
	});
});
//  // active nav
//     const currentLocation = location.href;
//     const menuItem = document.querySelectorAll('a');
//     const menuLength = menuItem.length
//     for (i = 0; i < menuLength; i++) {
//         if (menuItem[i].href === currentLocation) {
//             menuItem[i].className = 'active'
//         }
//     }
/////////////////////////////////////////
function slider() {
	$(".slider").owlCarousel({
		loop:true,
		rewind: true,
		autoplay: true,
		autoPlaySpeed: 800,
		autoPlayTimeout: 800,
		autoPlayHoverPause: true,
		margin: 20,
		nav: true,
		navigation: true,
		dots: true,
		// animateOut: "slideOutDown",
		animateOut:  "slideOutLeft",
		// animateIn: "flipInX",
		animateIn: "slideInRight",
		
		smartSpeed: 450,
		lazyLoad: true,
		navText: [
			'<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'<i class="fa fa-angle-right" aria-hidden="true"></i>'
		],
		navClass: [ "owl-prev", "owl-next" ],
		responsiveClass: true,
		items: 1
	});
	$(".feedback-slider").owlCarousel({
		loop: true,
		margin: 10,
		nav: true,
		autoplay: true,
		items: 1
	});

	$(".ad__slider").owlCarousel({
		loop: true,
		margin: 10,
		nav: true,
		autoplay: true,
		items: 1
	});
}

////////////////////////////////////////

// $('.navbar-nav li.drop_menu').click(function () {
// 	$('.navbar-nav li.drop_menu').each(function () {
// 		$(this).removeClass('active_menu');
// 	});
// 	$(this).addClass('active_menu');
// 	if ($(window).innerWidth() <= mobileWidth) {
// 		$(this).children('ul').slideToggle(300);
// 	}
// })

$("#book-modal").on("shown.bs.modal", function() {
	$("#myInput").trigger("focus");
});
// $(document).ready(function() {
// 	$(".home_slick_slider").flexslider({
// 		animation: "fade", // fade, slide, ...
// 		slideshowSpeed: 12000,
// 		animationSpeed: 1000,
// 		controlNav: false,
// 		pauseOnAction: false,
// 		initDelay: 0,
// 		directionNav: false
// 	});
// });

window.onscroll = function() {
	scrollFunction();
};

function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		// document.getElementById("top").style.display = "block";
		$("#top").addClass("d-block").removeClass("d-none");
	} else {
		$("#top").addClass("d-none").removeClass("d-block");
		// document.getElementById("top").style.display = "none";
	}
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

$(document).ready(function() {
	var submitIcon = $(".searchbox-icon");
	var inputBox = $(".searchbox-input");
	var searchBox = $(".searchbox");
	var isOpen = false;
	submitIcon.click(function() {
		if (isOpen == false) {
			searchBox.addClass("searchbox-open");
			inputBox.focus();
			isOpen = true;
		} else {
			searchBox.removeClass("searchbox-open");
			inputBox.focusout();
			isOpen = false;
		}
	});
	submitIcon.mouseup(function() {
		return false;
	});
	searchBox.mouseup(function() {
		return false;
	});
	$(document).mouseup(function() {
		if (isOpen == true) {
			$(".searchbox-icon").css("display", "block");
			submitIcon.click();
		}
	});
});
function buttonUp() {
	var inputVal = $(".searchbox-input").val();
	inputVal = $.trim(inputVal).length;
	if (inputVal !== 0) {
		$(".searchbox-icon").css("display", "block");
	} else {
		$(".searchbox-input").val("");
		$(".searchbox-icon").css("display", "block");
	}
}
document.addEventListener("DOMContentLoaded", function() {
	var elements = document.getElementsByClassName("searchbox-input");
	for (var i = 0; i < elements.length; i++) {
		elements[i].oninvalid = function(e) {
			e.target.setCustomValidity("");
			if (!e.target.validity.valid) {
				e.target.setCustomValidity(" ");
			}
		};
		elements[i].oninput = function(e) {
			e.target.setCustomValidity("");
		};
	}
});

$(".log_me_out").click(function() {
	$(".options").slideToggle(100);
});

// main pull menu //

var main = function() {
	$(".menu-icon a").click(function() {
		$(".main-menu-wrapper").animate({ left: "0px" }, 300);
		$(".whole-sec-wrapper").addClass("open");
		// $("body").animate({ right: "" }, 300);
		$("body").animate({ right: "" });

		// $(".main-menu-wrapper").css({"display": "inline-block"});
		$(".main-menu-wrapper").show(300);
	});
	$(".icon-close1").click(function() {
		$(".main-menu-wrapper").animate({ left: "-240px" }, 300);
		$(".whole-sec-wrapper").removeClass("open");
		$("body").animate({ left: "0px" }, 300);
	});
};

$(document).ready(main);

// document.onload function


$(document).ready(function() {
	$(".drop-menu a").click(function() {
		var link = $(this);
		var closest_ul = link.closest("ul");
		var parallel_active_links = closest_ul.find(".active");
		var closest_li = link.closest("li");
		var link_status = closest_li.hasClass("active");
		var count = 0;

		closest_ul.find("ul").slideUp(function() {
			if (++count == closest_ul.find("ul").length) parallel_active_links.removeClass("active");
		});

		if (!link_status) {
			closest_li.children("ul").slideDown();
			closest_li.addClass("active");
		}
	});
});

$(document).ready(function() {
	$(".popupslider").owlCarousel({
		loop: true,
		margin: 10,
		nav: true,
		autoplay: true,
		items: 1,
		dots: false
	});
	slider();
});

/* added by Bishow Thapa */
$(document).ready(function() {
	$(".slider").hover(function() {
		$(".owl-nav").toggleClass('dp-block');
	});
});

$(document).ready(function() {
	$('.owl-carousel').owlCarousel({
		items: 3,
		loop: true,
		// stagePadding: 40,
		margin: 10,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		nav: true,
		responsiveClass: true,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			768:{
				items:2,
				nav:false
			},
			1024:{
				items:3,
				nav:true,
				// loop:false
			}
		}
	})	
})

// Services
$(document).ready(function() {
	$(".services-col-one").hover(function() {
		$(".fa-plane").toggleClass("fa-plane-toogle");
		// $(".service-h3-col-one").toggleClass("service-h3-col-one-toggle");
		$(".service-btn-one").toggleClass("service-btn-one-toggle");
		$(".service-btn-a-one").toggleClass("service-btn-a-one-toggle");

		$(".service-icon-one").toggleClass("service-icon-one-toggle");
	});

	$(".services-col-two").hover(function() {
		// $(this).toogleClass('addBoxShadow');
		$(".fa-university").toggleClass("fa-university-toggle");
		// $(".service-h3-col-two").toggleClass("service-h3-col-two-toggle");
		$(".service-btn-two").toggleClass("service-btn-two-toggle");
		$(".service-btn-a-two").toggleClass("service-btn-a-two-toggle");

		$(".service-icon-two").toggleClass("service-icon-two-toggle");
	});

	$(".services-col-three").hover(function() {
		$(".fa-sort-amount-desc").toggleClass("fa-sort-amount-desc-toggle");
		// $(".service-h3-col-three").toggleClass("service-h3-col-three-toggle");
		$(".service-btn-three").toggleClass("service-btn-three-toggle");
		$(".service-btn-a-three").toggleClass("service-btn-a-three-toggle");

		$(".service-icon-three").toggleClass("service-icon-three-toggle");
	});

	$(".services-col-four").hover(function() {
		$(".fa-usd").toggleClass("fa-usd-toggle");
		// $(".service-h3-col-four").toggleClass("service-h3-col-four-toggle");
		$(".service-btn-four").toggleClass("service-btn-four-toggle");
		$(".service-btn-a-four").toggleClass("service-btn-a-four-toggle");

		$(".service-icon-four").toggleClass("service-icon-four-toggle");
	});
});


// User.css


/* Slider text animation using Jquery */
$(document).ready(function() {
	$('.slider__item__image__Description').fadeIn(slow, linear);
})