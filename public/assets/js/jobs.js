function apply(data){
	var modal = $("#modal-apply");
	modal.iziModal();
	modal.iziModal('setHeaderColor','#342ead');
	modal.iziModal('setTransitionIn','fadeInUp');
	modal.iziModal('setTransitionOut','fadeOutDown');
	modal.iziModal('setWidth','100%');
	modal.iziModal('open');

	var apply_id = data.getAttribute('apply-id');
	$("input[name=candidateApply]").val(apply_id);
}