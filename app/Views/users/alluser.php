<html>

<head>
  <title>home page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style type="text/css">

    li{
        background-color: rgb(255, 255, 255);
        padding: 8px 15px;
        border: 1px solid rgb(41, 176, 218);
        
    }
    li a{
        cursor: pointer;
        text-decoration: none;
        text-decoration: none;
    }
    .usertable {
      width: 80%;
      margin-left: auto;
      margin-right: auto;
      height: 800px;
    }

    .usertable table {
      box-shadow: 20px 20px 40px #aaa;
    }

    body {
      background-color: #aaa;
    }

    .page {
      margin-left: 45%;
    }
  </style>
</head>

<body>

  <section class="text-center mb-5">
    <h4 class="text-white">All users</h4>

    <!-- <a class="btn btn-primary" href="<?php echo base_url();?>user/createuserfivethou">ADD NEW USER 5 thou</a> -->
    <a class="btn btn-success" href="<?php echo base_url();?>/user/allusers">Show all products without datatable</a>

    <a class="btn btn-primary" href="<?php echo base_url();?>/user/getdatatable">SHOW ALL DATATABLE</a>


    <a class="btn btn-primary" href="<?php echo base_url();?>/user/createuser">ADD NEW USER</a>
    <a class="btn btn-primary" href="<?php echo base_url();?>/user/createusersession">ADD NEW USER USING SESSION</a>
  </section>

  <section class="usertable text-center mt-5">

    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Product Name</th>
          <th scope="col">Category</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
          <th scope="col">Total</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>


          <?php foreach($data as $key => $user):  ?>
          <th scope="row">
            <?=++$count; ?>
          </th>
          <td>
            <input onclick="inputClicked(this)" name="product_name" onchange="textChanged(this,<?= $user->uid ?>)"
              class="form-control" readonly type="text" value="<?= $user['product_name'] ?>">

          </td>
          <td>

            <select readonly onclick="inputClicked(this)" name="category" class="form-control"
              aria-label="Default select example" onchange="textChanged(this,<?= $user->uid ?>)">
              <option selected>Open this select menu</option>
              <?php foreach($categories as $category): ?>
              <?php if($category->id==$user['category']): ?>
              <option selected value="<?= $category->category_name ?>">
                <?=$category->category_name?>
              </option>
              <?php else: ?>
              <option value="<?= $category->category_name ?>">
                <?=$category->category_name?>
              </option>
              <?php endif; ?>
              <?php endforeach; ?>

            </select>
          </td>


          <td>
            <input onclick="inputClicked(this)" name="price" onchange="textChanged(this,<?= $user->uid ?>)"
              class="form-control" readonly type="text" value="<?= $user['price'] ?>">

          </td>
          <td>
            <input onclick="inputClicked(this)" name="quantity" onchange="textChanged(this,<?= $user->uid ?>)"
              class="form-control" readonly type="text" value="<?= $user['quantity'] ?>">

          </td>
          <td>
            <input onclick="inputClicked(this)" name="total" onchange="textChanged(this,<?= $user->uid ?>)"
              class="form-control total<?=$user->uid?>" readonly type="text" value="<?= $user['total'] ?>">

          </td>

          <td>
            <a class="btn btn-primary">Save</a>
            <a class="btn btn-success" href="<?php echo base_url();?>/user/updateuser/<?=$user->uid ?>">Edit</a>
            <a class="btn btn-danger" href="<?php echo base_url();?>/user/delete/<?=$user->uid ?>">Delete</a>

          </td>

        </tr>
        <?php endforeach; ?>
      </tbody>

    </table>

  </section>
  <div class="page">


  <?= $pager->links() ?>

  </div>



</body>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="<?= base_url("assets/js/jquery-3.4.1.min.js");?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  function inputClicked(item) {
    $('.form-control').attr("readonly", true);
    $(item).attr("readonly", false);

  }

  function textChanged(item, id) {
    // console.log(id);
    $.ajax({
      url: '<?= base_url('/user/updateuseronchange') ?>',
      method: 'get',
      data: { "field_name": item.name, "field_value": item.value, "field_id": id },
      contentType: 'application/x-www-form-urlencoded',
      success: function (response) {

        $(".total" + id).val(response);

      },
      error: function (err) {

      }
        })
    }

</script>

</html>