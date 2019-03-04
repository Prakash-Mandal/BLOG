
$(document).ready(function() {
	let comment = $('#Comments');
    let article_Id = $('[name="ArticleId"]').val();
    let limit = 2;
    let getcommentsURL = "http://localhost/ASSIGNMENTS/Ajax_Assignment/product/readComment.php";
    $('#AddComment').click(function() {
        $.post(getcommentsURL, {
            article_id: article_Id,
            limit: limit
        }, function(data, status) {
            let text = comment.html();
            if(status) {
            	text = '';
                for(let x in data["data"]) {
                    console.log(data["data"][x].comment);
                    text = text +
                '<div class="card "><div class="card"><div class="card-body card-text "><pre id="ArticleContent" >' +
                    data["data"][x].comment +
                '</pre></div><div class="comment-footer card-footer ">' +
                '<p id="aboutBlog" class="text-small text-justify col-8">' +
                '<span class=form-inline>Created by :'
                    + data["data"][x].userName +
                '</span><span class=form-inline>Created on :'
                    + data["data"][x].createdOn +
                '</span></p></div></div></div>';
                }
            }
            comment.html(text);
        });
        limit = limit + 2;
    });

    $("#email").blur(function() {
        let email = $('#email').val();
        let checkemailURL = "http://localhost/ASSIGNMENTS/Ajax_Assignment/product/CheckEmail.php?email="+email;
        $.get(checkemailURL, function(data,status){
            if ("Proceed OK" !== data["message"])
                document.getElementById("mail_error").innerHTML = data["message"];
            else
                document.getElementById("mail_error").innerHTML = "";
        });
    });

    let upClick = true
    $("upVote").click(function () {

        if (upClick) {
           .get()
        }
    })
});


