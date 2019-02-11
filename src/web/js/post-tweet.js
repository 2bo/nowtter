$(function () {
    $('#submit_button').on("click", function (event) {
        event.preventDefault();
        $.ajax({
            url: './post/json',
            type: 'POST',
            data: {'body': $('#body').val()},
            success: function (data) {
                if (data.success === "ok") {
                    window.location.href = './timeline'
                }
            }
        })
    });
});
