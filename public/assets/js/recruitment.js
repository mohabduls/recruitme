$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN' : $('meta[name=csrf_token]').attr('content')
	}
});

$(document).ready(function(){
	$("#sliderTop").slick({
		infinite: true,
		autoplay: true
	});
});

function openMenu(){
	var menu = $("#recruitme-menu");
	menu.toggle('active');
}

function companyProfile(){
	var modal = $("#modal-company");
	modal.iziModal();
	modal.iziModal('setHeaderColor','#342ead');
	modal.iziModal('setTransitionIn','fadeInUp');
	modal.iziModal('setTransitionOut','fadeOutDown');
	
	modal.iziModal('open');

	var companyName = $("input[name=companyName]");
	var companyLogo = $("#companyLogo");
	var companyAddress = $("textarea[name=companyAddress]");
	var companySlogan = $("input[name=companySlogan]");

	modal.iziModal('startLoading');

	$.get('dashboard/company/data',function(response){
		modal.iziModal('stopLoading');
		companyName.val(response.name);
		companyLogo.attr('src',response.logo);
		companyAddress.append(response.address)
		companySlogan.val(response.slogan);
	});
}

function addCategories(){
	var modal = $("#modal-categories");
	modal.iziModal();
	modal.iziModal('setHeaderColor','#342ead');
	modal.iziModal('setTransitionIn','fadeInUp');
	modal.iziModal('setTransitionOut','fadeOutDown');
	
	modal.iziModal('open');
}

function addPosts(){
	var postEditor = $("#postEditor");
	postEditor.toggle('active');
	alert(this.html());
}