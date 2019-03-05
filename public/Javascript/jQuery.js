
$(document).ready(function() {
	let comment = $('#Comments');
    let article_Id = $('[name="ArticleId"]').val();
    let limit = 4;
    let getCommentsURL = "http://localhost/ASSIGNMENTS/Ajax_Assignment/product/readComment.php";
    $('#AddComment').click(function() {
        $.post(getCommentsURL, {
            article_id: article_Id,
            limit: limit
        }, function(data, status) {
            let text = comment.html();
            if(status) {
            	text = '';
                for(let x in data["data"]) {
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
        let checkEmailURL = "http://myblog.api/CheckEmail.php";
        $.get(checkEmailURL, {
            email: email
        } function(data,status){
            if ("Proceed OK" !== data["message"])
                document.getElementById("mail_error").innerHTML = data["message"];
            else
                document.getElementById("mail_error").innerHTML = "";
        });
    });

    let upClick = true;
    let checkVoteURL = "http://myblog.api/getVotes.php";
    $("#upVote").click(function () {
        if (upClick) {
            upClick = false;
            $.get(checkVoteURL, {
                articleId: article_Id,
                userId: User_Id,
                vote: 1,
                voteType: "up"
            },function (data,status) {
               if(status) {
                    console.log(data["VoteCount"]);
                    $('#votes').html(data["VoteCount"]);
               }
            });
        } else {
            upClick = true;
            $.get(checkVoteURL, {
                articleId: article_Id,
                userId: User_Id,
                vote: 0,
                voteType: "up"
            }, function (data,status) {
               if(status) {
                    console.log(data["VoteCount"]);
                   $('#votes').html(data["VoteCount"]);
               }
            });
        }
    });

    let downClick = true;
    $("#downVote").click(function () {
        if (downClick) {
            downClick = false;
            $.get(checkVoteURL, {
                articleId: article_Id,
                userId: User_Id,
                vote: 2,
                voteType: "up"
            },function (data,status) {
               if(status) {
                    console.log(data["VoteCount"]);
                   $('#votes').html(data["VoteCount"]);
               }
            });
        } else {
            downClick = true;
            $.get(checkVoteURL, {
                articleId: article_Id,
                userId: User_Id,
                vote: 0,
                voteType: "up"
            }, function (data,status) {
               if(status) {
                    console.log(data["VoteCount"]);
                   $('#votes').val(data["VoteCount"]);
               }
            });
        }
    });

});


