$(document).ready(function() {
	$("#image").on("change", function() {
	    var image = this.files[0].name;
	    $("#filename").val(image);
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$("#image-tag").attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#edit-image").change(function() {
		readURL(this);
	});

	$(".delete-post").click(function() {
		// e.preventDefault();
		var postId = $(this).data('id');
		
		alertify.confirm('Delete Post', 'Are you sure you want to delete this post?', function() {
			
			$.ajax({
				headers: {
	          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          	},
				url: '/posts/' + postId + '/delete',
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
