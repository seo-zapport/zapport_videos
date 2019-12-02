jQuery(document).ready(function($){
	$('.show-edit').on('click', function(e){
	    $('.form-hidden-'+this.id).toggleClass('form-hide');
	});


	$("#cat_form").on('submit' ,function(e){
		e.preventDefault();
		var categories = $('#cat_form input[name="categories"]').val();
		console.log(categories);
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		});
		$.ajax({
			type: 'POST',
			//url: '/Dashboard/category',
			url: '/category',
			data: { categories:categories },
			dataType: 'json',
			success: function(response)
			{
				console.log(response);
				$('#cat_form')[0].reset();
				$("#category_id").prepend('<option value="'+response.id+'" selected>'+response.categories+'</option>')
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

	// Snippet Actions Hover_____________________________________________________________________________________________________
	$("table.table-hover tr").hover(function(e) {
		$(this).find('td').find('.row-actions').addClass('visible');
	},function(e){
		$(this).find('td').find('.row-actions').removeClass('visible');
	});

	// Sidebar hide&show_____________________________________________________________________________________________________
	$('.zp-navbar-show').on('click', function(e){
		$('#zp_nav').stop(true, true).animate({
		  opacity: 1,
		  marginLeft: '0'
		}, 'slow', 'linear');
	});

	$('.zp-nav-closed').on('click', function(e){
		$('#zp_nav').stop(true, true).animate({
		  opacity: 0,
		  marginLeft: '-999px'
		}, 'slow', 'linear');
	});

	// Remove inline style_____________________________________________________________________________________________________
	$(window).on('load resize', function(){
		var viewWidth = $(window).width();
		if ( viewWidth >= 750) {
		  if ( $('#zp_nav').attr('style') ) {
		    $('#zp_nav').removeAttr('style');
		  }
		}
	});

	// Output file name_____________________________________________________________________________________________________
	$("#mediaForm input[name='file_name']").change(function(e) {
		e.preventDefault();
		document.getElementById("slctdFile").innerHTML = '';
		var file = $(this).val().replace(/C:\\fakepath\\/i, '');
		$("#slctdFile").append(file);
	});

	$("#mediaForm").on('submit', function(){
		$("#pubMedia").prop('disabled', true);
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