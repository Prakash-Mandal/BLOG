<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BLOG</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="./public/Stylesheet/blog.css">

    </head>
    <body>

        <span>Always Index</span>
        <div class="container-fluid">
<!--            <pre>-->
            <?php
            require_once 'core/init.php';

            use core\Blog;

            $blog = new Blog();

            $blog->addJS();

            $blog->autoload();

            $blog->config();

//            $blog->Database();

            $blog->call();

            ?>
        </div>

    </body>
    <script>
        $(document).ready(function(){
            $(".toast").toast('show');
        });
    </script>
</html>

