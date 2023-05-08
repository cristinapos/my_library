$(document).ready(function() {
    $('input[name="quantity"]').on('change', function() {
      var bookId = $(this).closest('tr').data('book');
      var quantity = $(this).val();
      let csrfToken = $('input[name="_csrfToken"]').val();

      $.ajax({
        url: '/carts/update/' + bookId + '/' + quantity,
        data: {
            _csrfToken: csrfToken
        },
        type: 'POST',
        success: function(response) {
          location.reload(); // Refresh the page to display the updated cart
        }
      });
    });

    $(document).on("change", "#county", function(e) {
		let $countyName = $("#county").val();

        if ($countyName != '') {
            $("#city").empty();
            $.ajax({
                url: "/cities/getCities/" + $countyName,
                type: "get",
                dataType: 'json',
                success: function(data) {
                    $("#city").empty();
                    $.each(data,function(key, value) {
                        $("#city").append(`<option value="${value['name']}">${value['name']}</option>`);
                    });
                }
            })
        }
	});

    $('#create-account-checkbox').change(function() {
        if ($(this).prop('checked')) {
          $('#account-details').removeClass('d-none');
        } else {
          $('#account-details').addClass('d-none');
        }
      });
});