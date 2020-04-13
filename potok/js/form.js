$(document).ready(function () {
    $("#form").on("submit", function (event) {
        let text = $("#text").val();
        let image = $("#img").val();
        let formData = new FormData();
        let message = $("#errors");
        event.preventDefault();
        if(($('#img')[0].files).length != 0 ){
            formData.append($("#img")[0].files);
        } else {
            message.html("Please choose image file to download");
            return false;
        }
        $.ajax({
            url: "config/ajax.php",
            type: "POST",
            data: formData,
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert(data);
            }
        })
    });
});
