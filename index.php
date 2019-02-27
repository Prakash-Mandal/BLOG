<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BLOG</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="/public/Stylesheet/blog.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="/public/Javascript/blog.js"></script>
        <noscript>Script not running</noscript>
    </head>
    <body>
        <div class="container-fluid">
            <?php
            require_once 'core/init.php';

            use core\Blog;

            $blog = new Blog();

            $blog->autoload();

            $blog->config();

//            $blog->Database();

            $blog->call();

            ?>
        </div>
    </body>
</html>

