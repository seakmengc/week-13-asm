$(document).ready(function () {
    $.ajaxSetup({
        headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        },
    });

    $(".ajax-delete").click(function () {
		const self = $(this);

        if (confirm("Do you want to delete?")) {
            $.ajax({
                url: self.data("url"),
                type: "DELETE",
                success: function (res) {
                    if (res.success) {
                        $('#' + self.data('id')).html('');
                    } else {
						if(confirm(res.message + '\nDo you want to refresh the page?'))
							window.location.reload();
					}
				},
				error: function (res) {
					if (confirm(res.responseJSON.message + '\nDo you want to refresh the page?'))
						window.location.reload();
				}
            });
        }
    });
});
