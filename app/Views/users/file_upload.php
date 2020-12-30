<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        .usertable{
            width: 60%;
            margin-left: auto;
            margin-right: auto;
        }
        body{
            background-color: rgba(129, 129, 211, 0.541);
        }
        .fileclass{
            width: 20%;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <section class="text-center mb-5">
        <h4 class="text-white">product info</h4>
        <a class="btn btn-danger" data-toggle="tooltip" title="Be Carefull What You Wish For" href="<?php echo base_url();?>/user/emptysession">Empty Session</a>
        <a class="btn btn-primary" href="<?php echo base_url();?>/user/allusers">Show all products without datatable</a>

    <a class="btn btn-primary" href="<?php echo base_url();?>/user/getdatatable">SHOW ALL DATATABLE</a>


    <a class="btn btn-primary" href="<?php echo base_url();?>/user/createuser">ADD NEW USER</a>
    <a class="btn btn-primary" href="<?php echo base_url();?>/user/createusersession">ADD NEW USER USING SESSION</a>
    <a class="btn btn-success" href="<?php echo base_url();?>/user/fileupload">GOTO FILE UPLOAD</a>
 
    </section>
    <section class="text-center fileclass">
        <?php if($validation){echo $validation->listErrors();} ?>

        <form  action="<?php echo base_url();?>/user/fileupload" enctype="multipart/form-data" method="post">
            <input class="form-control" type="file" name="img">
            <input class="btn btn-primary" type="submit" name="submit">
        </form>
    </section>


</body>
</html>


