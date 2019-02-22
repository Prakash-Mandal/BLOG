<?php
    if (0 === session_status()) {
      session_start();
    }

    function sessionDestroy()
    {
      session_unset();
      session_destroy();
      require("index.php");
    }           
?>
<div class="container-fluid">
    <div id="Footer" class="jumbotron row">
        <div class="col-sm-6 left">
            <p >
                Last viewed on <?php echo date("h:i:s a D d,M,Y");?>
            </p>
        </div>
        <div class="col-sm-6 right">
            <p>
                <?php
                    if(!empty($_SESSION['name'])) {
                        echo $_SESSION['name'];
                        // echo $_SESSION['User_Id'];
                    }
                ?>
            </p>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>