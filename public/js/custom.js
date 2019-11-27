jQuery(document).ready(function($){
	$("#cat_form").on('submit' ,function(e){
		e.preventDefault();
		var categories = $('#cat_form input[name="categories"]').val();
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		});
		$.ajax({
			type: 'POST',
			url: '/Dashboard/category',
			data: { categories:categories },
			dataType: 'json',
			success: function(response)
			{
				console.log(response);
				$('#cat_form')[0].reset();
				$("#category_id").append('<option value="'+response.id+'" selected>'+response.categories+'</option>')
				$("#roleModal").modal('hide');
			},
			error: function(response)
			{
	    		document.getElementById("errorlogTag").innerHTML = '';
				if (jQuery.isEmptyObject(response.responseJSON) == false) {
					var errors = response.responseJSON.errors.categories;
					errors.forEach(function(i){
						document.getElementById("errorlogTag").innerHTML += i + "<br>";
					});
				}
			}
		});
	});
});

function copyFunction(id) {
	console.log(id.value);
	var copyText = document.getElementById(id);
	console.log(copyText);
	copyText.select();
	copyText.setSelectionRange(0, 99999)
	document.execCommand("copy");
	alert("Copied the text: " + copyText.value);
}