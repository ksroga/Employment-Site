$(".editor").each(function() {
	var exp = /([^"])(https?:\/\/[a-zA-Z0-9\.\-\/]+(?:\?[a-zA-Z0-9=\&]+)?(?:#[\w]+)?)/gi, 
    subst = '$1<a href="$2" target="_blank">$2</a>'; 

	$(this).html($(this).html().replace(exp, subst));
	$(this).html($(this).html().replace("hidden information", "informacja ukryta"))
});

$("#send").click(function() {
	if($("#email").val().length == 0) {
		$("#send").prop('type', 'button');
		$("#email").addClass('is-invalid');
	} else {
		$("#send").prop('type', 'submit');
		$("#email").removeClass('is-invalid');
	}
});


if(window.location.pathname == '/') {
	$("#jobs").addClass('active');
} else {
	$("#" + window.location.pathname.substring(1)).addClass('active');
}



// =========== Cookies =====================

// cookies notify

if(Cookies.get('CookiesNotify_Accepted') === undefined) 
	$(".cookiesNotify").css('display', 'inline');


$("#acceptCookies").click(function() {
	$(".cookiesNotify").fadeOut();
	Cookies.set('CookiesNotify_Accepted', '1', { expires: 365 });
});


// ========== Others =======================

$("#city").geocomplete({
	details: "form"
});

$("#city").focusout(function(){
	$("#city").trigger("geocode");
});

var simplebar = new Nanobar();
simplebar.go(100); 


/**
notify('title', {
    body: 'Notification Text',
    icon: '',
    onclick: function(e) {}, // e -> Notification object
    onclose: function(e) {},
    ondenied: function(e) { alert(); }
  });
*/
