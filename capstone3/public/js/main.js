$(window).on('load', function() {
	$('.grid').masonry({
		itemSelector: '.grid-item',
		columnWidth: 200
	});
});


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


	$(".comment-btn").click(function () {
		var postId = $(this).data('id');
		var user = $(this).data('user');
		var comment = $("#comment-area-"+postId).val();
		var created_at = $(this).data('time');
		$.ajax({
			headers: {
	          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          	},
			url: '/posts/'+postId+'/comment',
			type: 'POST',
			data: {
				comment: comment,
			},
			beforeSend:function() {
				$.blockUI();
			},
			success:function(data) {
				$.unblockUI();
				$("#comment-area-"+postId).val('');
				$(".comment-wrapper").find("#comment-body-"+postId).append("<div class='comment mx-3'><span>" + user + " said on: " + data.time + 
						"</span><p>" + comment +"</p></div>");
				$(".comment-body-wrapper").load(' .comment-body');
			}
		});
	});

	$(".comment-body-wrapper").on('click', '.delete-comment', function() {

		var commentId = $(this).data('id');
		var postId = $(this).data('post-id');

		alertify.confirm('Delete Comment', 'Are you sure you want to delete this comment?', function() {

			$.ajax({
				headers: {
		          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          	},
	          	url: '/posts/'+postId+'/comment/'+commentId+'/delete',
	          	type: 'POST',
	          	data: {
	          		// commentId : commentId
	          	},
	          	beforeSend:function() {
	          		$.blockUI();
	          	},
	          	success:function(data) {
	          		$.unblockUI();
	          		$("#"+commentId).remove();
	          	}

			});

		}, function() {
			
		});
	});


	$(".comment-body-wrapper").on('click', '.save-comment', function() {
		var commentId = $(this).data('id');
		var postId = $(this).data('post-id');
		var input = $("#commentArea_"+commentId).val();

		$.ajax({
			headers: {
		          		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          	},
          	url: '/posts/'+postId+'/comment/'+commentId+'/edit',
          	type: 'POST',
          	data: {
          		input: input
          	},
          	beforeSend:function() {
          		$.blockUI();
          	},
          	success:function(data) {
          		$.unblockUI();
          		$("#comment_"+commentId).html(input);
          		$("#editDelete_"+commentId).show();
				$("#editArea_"+commentId).hide();
				$("#comment_"+commentId).show();
          	}
		});
	});

	$(".comment-body-wrapper").on('click', '.edit-comment', function() {
		var commentId = $(this).data('id');
		$("#editDelete_"+commentId).hide();
		$("#editArea_"+commentId).show();
		$("#comment_"+commentId).hide();
	});

	$(".comment-body-wrapper").on('click', '.cancel-comment', function() {
		var commentId = $(this).data('id');
		var originalComment = $("#comment_"+commentId).html();

		$("#editDelete_"+commentId).show();
		$("#commentArea_"+commentId).val(originalComment);
		$("#editArea_"+commentId).hide();
		$("#comment_"+commentId).show();
	});

});
