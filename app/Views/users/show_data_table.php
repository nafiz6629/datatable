<html>
    <head>
<title>home page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" integrity="" crossorigin="anonymous">
<style type="text/css">
    .usertable{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        height: 500px;
    }
    .usertable table{
      box-shadow: 20px 20px 40px #aaa;
    }
    body{
      background-color: rgb(255, 255, 255);
    }
    .page{
      margin-left: 45%;
    }
    .myform{
      border: none;
    }
</style>
</head>

<body>

	<section class="text-center mb-5">
        <h4 class="text-white">All users</h4>

        <a class="btn btn-primary" href="<?php echo base_url();?>/user/allusers">Show all products without datatable</a>

        <a class="btn btn-success" href="<?php echo base_url();?>/user/getdatatable">SHOW ALL DATATABLE</a>

       
        <a class="btn btn-primary" href="<?php echo base_url();?>/user/createuser">ADD NEW PRODUCT</a>
        <a class="btn btn-primary" href="<?php echo base_url();?>/user/createusersession">ADD NEW PRODUCT USING SESSION</a>
	</section>

	<section class="usertable text-center mt-5">

		<table id="mytableid" class="table">
      <input placeholder="search product name" type="text">
      <input placeholder="search quantity" type="text">
            <thead>
              <tr>
              
                <th scope="col">#SL</th>
                <th scope="col">Product id</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th class="text-right" scope="col">Price</th>
                <th class="text-right" scope="col">Quantity</th>
                <th  class="text-right" scope="col">Total</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
           
            <tfoot>
              <tr>
                
                <th colspan="6">
                  
                </th>
               
               
                <th class="grandtotal text-right"></th>
              </tr>
            </tfoot>

          </table>

        </section>
      
    
	
</body>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="<?= base_url("assets/js/jquery-3.4.1.min.js");?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?= base_url("assets/js/jquery.dataTables.min.js");?>" ></script>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" ></script>
<!-- <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js" ></script> -->
<script src="<?= base_url("assets/editor/js/dataTables.editor.min.js");?>" ></script>

<script>

    function inputClicked(item){
        $('.myform').attr("readonly",true);
        $(item).attr("readonly",false);
        
    }

    function textChanged(item,id){
     // console.log(id);

        $.ajax({
          url:'<?= base_url('user/updateuseronchange') ?>',
          method:'get',
          data:{"field_name":item.name,"field_value":item.value,"field_id":id},
          contentType:'application/x-www-form-urlencoded',
          success:function(response){
              
            $(".total"+id).val(response);
            //  console.log(response);
          },
          error:function(err){

          },
          
        })
    }

</script>

<script>
// var editor;
  $(document).ready(function () {

//     editor = new $.fn.dataTable.Editor( {
//         ajax:'<?= base_url('user/getdatatableedit') ?>',
//         table: "#mytableid",      
//         idSrc:  'id',//for row identifier
//         fields: [ 
//           {
//               //  label: "First name:",
//                 name: "0"
//             }, 
//           // {
//           //     //  label: "First name:",
//           //       name: "id"
//           //  }, 
//           {
//               //  label: "First name:",
//                 name: "product_name"
//             }, 
//             {
//               //  label: "Last name:",
//                 name: "category"
//             }, 
//             {
//               //  label: "Last name:",
//                 name: "price"
//             }, 
//             {
//               //  label: "Last name:",
//                 name: "quantity"
//             }, 
//             {
//               //  label: "Position:",
//                 name: "total"
//             }, 
           
//         ],
       
//     } );

//     $('#mytableid').on( 'click', 'tbody td:not(:first-child .noedit)', function (e) {
//         editor.inline( this );
//     } );
    //editor.inline( $('#example tbody tr:first-child td:last-child'), 'product_name' );


 

    //** */
    //** */
    //** */
    //** */
    //** */
    //** */
    //** */
    //** */
    //** */
    //** */

   var mytable= $('#mytableid').DataTable({
      "order":[],
      "serverSide":true,
      "processing":true,

      "ajax":{
        url:"<?php echo base_url('/user/getdatatable'); ?>",
        type:"POST",
        
        // success:function(response){
        //   console.log(response);
   
        //   },
        //   error:function(err){
        //      console.log(err); 
        //   },
      },

      drawCallback:function(setting){
        $('.grandtotal').html("Grand Total :"+setting.json.grand+"   ");
      },
     
      select: {
            style:    'os',
            selector: 'td:first-child'
        },
      "columnDefs": [
        {
        "targets" : [0],
        "orderable" : false,      
        
       },
       {
        "targets" : [1],
        "data":"id",   
        className: "noedit"    
        
       },
        {
        "targets" : [2],        
        name:"product_name",
        className: "productname",
        'searchable': true,
        "data":null , render: function (data,type, row) {
           
            return '<input onclick="inputClicked(this)" name="product_name"'+ 
            'onchange="textChanged(this,'+data["id"]+')" class="myform" readonly  type="text" value="'+data["product_name"]+'">';


              }       
        
       }
       ,
        {
        "targets" : [3],
        "orderable" : false,
        "data": null, render: function (data, type, row) {
            // Combine the first and last names into a single table field
            return '<select class="form-control" onchange="textChanged(this,'+data["id"]+')" name="category"> '+
                data[1].map(v=>{
                  if(v.id==data["category"]){
                    return '<option selected value="'+v.category_name+'">'+v.category_name+'</option>'
                  }
                  else{
                    return '<option value="'+v.category_name+'">'+v.category_name+'</option>'

                  }
                })
              '</select>';
           
          }
        
       },
        {
        "targets" : [4],            
          name:"4",
          "data":null , render: function (data,type, row) {
           
           return '<input onclick="inputClicked(this)" name="price"'+ 
           'onchange="textChanged(this,'+data["id"]+')" class="myform text-right" readonly  type="text" value="'+data["price"]+'">';


             }       
       },
       {
        "targets" : [5],
        name:"5",
        'searchable': true,
        "data":null , render: function (data,type, row) {
           
           return '<input onclick="inputClicked(this)" name="quantity"'+ 
           'onchange="textChanged(this,'+data["id"]+')" class="myform text-right" readonly  type="text" value="'+data["quantity"]+'">';


             }       
        
       },
       {
        "targets" : [6],   
      
        "data":null , render: function (data,type, row) {
           
           return '<input onclick="inputClicked(this)" name="total"'+ 
           'onchange="textChanged(this,'+data["id"]+')" class="myform text-right total'+data["id"]+'" readonly  type="number" value="'+data["total"]+'">';


             }       
        
        
       },
        {
        "targets" : [7],
        "orderable" : false,
        "data": null, render: function (data, type, row) {
            // Combine the first and last names into a single table field
            return '<a class="btn btn-primary text-white mr-1">Save</a>'+
            '<a class="btn btn-success mr-1" href="<?=base_url()?>/user/updateuser/' + data["id"] + '">Edit</a>'+
            '<a class="btn btn-danger" href="<?=base_url()?>/user/getdatatabledelete/' + data["id"] + '">Delete</a>';
           
          }
       },

    ]
    });
    //datatable ends
    // mytable.columns().every( function () {
    //             var that = this;
 
    //             $( 'input', this.footer() ).on( 'keyup change clear', function () {
    //                 if ( that.search() !== this.value ) {
    //                     that
    //                         .search( this.value )
    //                         .draw();
    //                 }
    //             } );
    //         } );
    


    
   
  });

</script>



<script>
  
// function searchProductName(item){
//       var m1=$('.multisearch1').value;
//       var m2=$('.multisearch2').value;
//   $.ajax({
//           url:'<?= base_url('user/updateuseronchange') ?>',
//           method:'get',
//           data:{"field_name":item.name,"field_value":item.value,"field_id":id},
//           contentType:'application/x-www-form-urlencoded',
//           success:function(response){
              
//             $(".total"+id).val(response);
//             //  console.log(response);
//           },
//           error:function(err){

//           },
          
//         })

// }


 
    // DataTable
    // var table = $('#mytableid').DataTable({
    //     initComplete: function () {
    //         // Apply the search
    //         this.api().columns().every( function () {
    //             var that = this;
 
    //             $( 'input', this.footer() ).on( 'keyup change clear', function () {
    //                 if ( that.search() !== this.value ) {
    //                     that
    //                         .search( this.value )
    //                         .draw();
    //                 }
    //             } );
    //         } );
    //     }
    // });
  
</script>

</html>