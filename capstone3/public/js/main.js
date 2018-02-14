$(document).ready(function() {
	$("#image").on("change", function() {
	    var image = this.files[0].name;
	    $("#filename").val(image);
	});

	$(".delete-post").click(function() {
		// e.preventDefault();
		var postId = $(this).data('id');
		
		alertify.confirm('Delete Post', 'Are you sure you want to delete this post?', function() {
			
			$.ajax({
				headers: {
	          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          	},
				url: '/post/delete/'+postId,
				type: 'POST',
				data: {
					
				},
				beforeSend:function() {
					$.blockUI();
				},
				success:function(data) {
					$.unblockUI();
					$('#card_'+postId).remove();
				}
			});

		}, function() {

		});
	});
});
