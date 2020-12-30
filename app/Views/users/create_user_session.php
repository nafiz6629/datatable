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
            background-color: rgb(129, 129, 211);
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
    <a class="btn btn-success" href="<?php echo base_url();?>/user/createusersession">ADD NEW USER USING SESSION</a>
    <a class="btn btn-primary" href="<?php echo base_url();?>/user/fileupload">GOTO FILE UPLOAD</a>
 
    </section>

	<section class="usertable text-center mt-5">


        <div class="text-center text-white">
            <?php if($validation){echo $validation->listErrors();} ?>

        </div>
        <form class="usertable" method="post" action="<?php echo base_url();?>/user/createusersession">

           
            <div class="form-group text-white">
                <label for="exampleFormControlInput1">Product Name</label>
                <input type="text" class="form-control" name="product_name" >
            </div>
            <div class="form-group text-white">
                <label for="exampleFormControlInput1">Category</label>
                <select readonly  name="category"  class="form-control" 
                     aria-label="Default select example">
                      <option selected>Open this select menu</option>
                      <?php foreach($categories as $category): ?>
                      
                      <option  value="<?= $category->category_name ?>"><?=$category->category_name?></option>
                      
                      <?php endforeach; ?>
                      
                 </select>
            </div>

            <div class="form-group text-white">
                <label for="exampleFormControlInput1">price</label>
                <input type="number" class="form-control" name="price" >
            </div>
           
            <div class="form-group text-white">
                <label for="exampleFormControlInput1">Quantity</label>
                <input type="number" class="form-control" name="quantity" >
            </div>
            
           

            <input type="submit" name="add" class="btn btn-success" value="ADD">
           
    </form>


</section>
    
<section class="usertable text-center mt-5">

<table class="table table-dark">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Product Name</th>
    <th scope="col">Category</th>
    <th scope="col">Quantity</th>
    <th scope="col">price</th>
    <th scope="col">total</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
  <tr>
      <?php $count=1  ?>
      <?php if(!empty($data)): ?>
      <?php foreach($data as $user):  ?>
    <th scope="row"><?=$count ?></th>
    <td>
        <input  onclick="inputClicked(this)"  onchange="textChanged(this)" name="product_name"  class="form-control" readonly  type="text" value="<?= $user['product_name'] ?>">
        
    </td>
    <td>
        <input onclick="inputClicked(this)" onchange="textChanged(this)" name="category"  class="form-control" readonly  type="text" value="<?= $user['category'] ?>">
        
    </td>   
    
    <td>
        <input onclick="inputClicked(this)"  onchange="textChanged(this)" name="quantity" class="form-control" readonly  type="text" value="<?= $user['quantity'] ?>">
        
    </td>
    <td>
        <input onclick="inputClicked(this)"  onchange="textChanged(this)" name="price" class="form-control" readonly  type="text" value="<?= $user['price'] ?>">
        
    </td>
    <td>
        <input onclick="inputClicked(this)"  onchange="textChanged(this)" name="total" class="form-control" readonly  type="text" value="<?= $user['total'] ?>">
        
    </td>
   
    <td>
        <a class="btn btn-danger" href="<?php echo base_url();?>/user/deletefromsession/<?=$count?>">Delete</a>
      
    </td>
   
  </tr>
<?php $count++; endforeach; ?>
<?php endif; ?>
</tbody>

</table>

<a class="btn btn-success" href="<?php echo base_url();?>/user/submitall">submit all</a>

</section>

    
</body>
</html>