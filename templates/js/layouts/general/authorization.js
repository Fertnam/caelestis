$(document).ready(function() {
    $("div.aside-wrapper-model:first").on("submit.authorizationForm", "#authorization-form-id", function(event) {
        event.preventDefault(); 
        
        $.ajax({
            type: "POST",
            url: "php/authorization/site_authorizater.php",
            data: $(this).serialize(),
            success: function(data) {
                data = JSON.parse(data);

                if (data.status) {
                    let page = window.location.pathname !== '/' ? window.location.pathname.substr(1) : window.location.pathname;
                    loadPage(page);
                } else {
                    $("#authorization-error-message-id").html("<i class=\"fas fa-exclamation-circle\"></i> " + 
                        data.content);
                    useRecaptcha();
                }
            },
            error: function() {
                $("#authorization-error-message-id").html("<i class=\"fas fa-exclamation-circle\"></i> Возникла ошибка при подключении к серверу");
            }
        });
    });
});