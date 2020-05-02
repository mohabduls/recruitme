$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN' : $('meta[name=csrf_token]').attr('content')
	}
});

$(document).ready(function(){
	CKEDITOR.replace('ckeditor');
	
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

	$.get('/dashboard/company/data',function(response){
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

function addPosts(data){
	var postEditor = $("#postEditor");
	postEditor.toggle('active');
}

function editJobPosts(data){
	var modal = $("#modal-editjobposts")
	modal.iziModal();
	modal.iziModal('setHeaderColor','#342ead');
	modal.iziModal('setTransitionIn','fadeInUp');
	modal.iziModal('setTransitionOut','fadeOutDown');
	modal.iziModal('setWidth','100%');
	modal.iziModal('open');

	//start loading
	modal.iziModal('startLoading');

	CKEDITOR.replace('editJobPosts');

	var hash = data.getAttribute('hash');
	var inputHash = $("input[name=hash]").val(hash);

	$.post('/dashboard/job/details',{hash:hash},function(response){
		modal.iziModal('stopLoading');
		$("#jobTitle").val(response[0].title);
		$("#jobCategories").val(response[0].categories);
		CKEDITOR.instances['editJobPosts'].setData(response[0].posts);

		//delete job adding hash
		$("#deleteJobs").attr('hash',hash);
	});
}

function deleteJobs(data){
	var modal = $("#modal-editjobposts")
	modal.iziModal();
	modal.iziModal('startLoading');
	var hash = data.getAttribute('hash');

	//delete with ajax
	$.post('/dashboard/job/delete',{hash:hash},function(response){
		if(response.status != undefined && response.status == true){
			modal.iziModal('stopLoading');
			modal.iziModal('close');
			window.location = "/dashboard";
		}
		else{
			modal.iziModal('stopLoading');
			this.val('Failed!');
		}
	});
}

function editCategories(data){
	var modal = $("#modal-editcategories")
	modal.iziModal();
	modal.iziModal('setHeaderColor','#342ead');
	modal.iziModal('setTransitionIn','fadeInUp');
	modal.iziModal('setTransitionOut','fadeOutDown');
	modal.iziModal('open');

	var dataid = data.getAttribute('data-id');
	$("#deleteCategories").attr('data-id',dataid);
	$("#idCategories").val(dataid);
	$("#editCategories").val(data.getAttribute('data-content'));
}

function deleteCategories(data){
	var modal = $("#modal-editcategories")
	modal.iziModal();
	modal.iziModal('startLoading');
	var id = data.getAttribute('data-id');

	//delete with ajax
	$.post('/dashboard/categories/delete',{id:id},function(response){
		if(response.status != undefined && response.status == true){
			modal.iziModal('stopLoading');
			modal.iziModal('close');
			window.location = "/dashboard";
		}
		else{
			modal.iziModal('stopLoading');
			this.val('Failed!');
		}
	});
}

function seeCandidates(data){
	var modal = $("#modal-candidates");
	modal.iziModal();
	modal.iziModal('setHeaderColor','#342ead');
	modal.iziModal('setTransitionIn','fadeInUp');
	modal.iziModal('setTransitionOut','fadeOutDown');

	//id
	var id = data.getAttribute('candidates-id');
	//information variable
	var candidateNames = $("*[name=candidateName]");
	var candidateAge = $("*[name=candidateAge]");
	var candidateAddress = $("*[name=candidateAddress]");
	var candidateEducation = $("*[name=candidateEducation]");
	var candidateEmail = $("*[name=candidateEmail]");
	var candidateStatus = $("*[name=candidateStatus]");
	var candidateAppliedAt = $("*[name=candidateAppliedAt]");
	var candidatePhotos = $("*[name=candidatePhotos]");
	var candidateArchive = $("*[name=candidateArchive]");

	//whitelisted change status
	var whiteListedChange = $("select[name=whiteListedChange]");

	//open modals
	modal.iziModal('open');

	//starting loading
	modal.iziModal('startLoading');
	//ajax
	$.post('/dashboard/applicants/data',{id:id},function(response){
		//stop loading
		modal.iziModal('stopLoading');
		//status
		var status = undefined;
		if(response[0].status != true){
			status = "Not Whitelisted";
		}
		else{
			status = "Whitelisted";
		}

		candidateNames.text(response[0].name);
		candidateAge.text(response[0].age + "y.o");
		candidateAddress.text(response[0].address);
		candidateEducation.text(response[0].education);
		candidateEmail.text(response[0].email);
		candidateStatus.text(status);
		candidateAppliedAt.text(response[0].created_at);
		candidatePhotos.attr('src',response[0].photos)
		candidateArchive.attr('href',response[0].files)

		whiteListedChange.val(response[0].status);

		$(".iziModal-header-title").text(response[0].name);

		$("a[name=deleteCandidates]").attr('href',"dashboard/applicants/delete/"+response[0].id);
	});

	//status alert
	var statusAlert = $("div[name=statusAlert]");
	//on change status
	whiteListedChange.on('change',function(){
		//start loading
		modal.iziModal('startLoading');

		//ajax on change
		$.post('/dashboard/applicants/status',{id:id,status:whiteListedChange.val()},function(response){
			if(response.status != true){
				modal.iziModal('stopLoading');
				statusAlert.removeClass('d-none');
				statusAlert.addClass('alert-danger');
				statusAlert.removeClass('alert-success');
				statusAlert.addClass('active');
				$("div[name=statusText]").html('');
				$("div[name=statusText]").append('Sorry, we can\' process to change this candidate status!');
			}
			else{
				modal.iziModal('stopLoading');
				statusAlert.removeClass('d-none');
				statusAlert.addClass('alert-success');
				statusAlert.removeClass('alert-danger');
				statusAlert.removeClass('active');
				$("div[name=statusText]").html('');
				$("div[name=statusText]").append('Status changed!');
			}
		});
	})
}

function openSettings(){
	var modal = $("#modal-settings");
	modal.iziModal();
	modal.iziModal('setHeaderColor','#342ead');
	modal.iziModal('setTransitionIn','fadeInUp');
	modal.iziModal('setTransitionOut','fadeOutDown');

	//open
	modal.iziModal('open');
}