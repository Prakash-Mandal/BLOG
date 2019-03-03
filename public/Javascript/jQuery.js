
$(document).ready(function() {
	let comment = $('#Comments');
    let article_Id = $('[name="ArticleId"]').val();
    let limit = 2;
    let url = "http://localhost/ASSIGNMENTS/Ajax_Assignment/product/readComment.php";
    $('#AddComment').click(function() {
        $.post(url, {
            article_id: article_Id,
            limit: limit
        }, function(data, status) {
            let text = comment.html();
            if(status) {
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
});


