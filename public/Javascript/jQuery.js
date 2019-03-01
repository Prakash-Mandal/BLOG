let href = $('#deleteArticle').val();
$(document).ready(function() {
    $('#deleteArticle').click(function () {
        if (promptDelete()) {
            $(this).attr('href', href);
        }
    });
});

function checkEmail() {
    let email = $("#email").val();
    console.log(email);
    let url = "http://localhost/Ajax_Assignment/product/CheckEmail.php?email="+email;

}