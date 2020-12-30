<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

		return view('welcome_message');
	}

	//--------------------------------------------------------------------
	//session
    // public function createUserUsingSession()
    // {

	// 	$session = session();
    //     $data["categories"] = $this
    //         ->users_model
    //         ->getAllCategories();
    //     if ($this->session->get("user"))
    //     {
    //         $data["data"] = $this
    //             ->session
    //             ->set("user");
    //         $this
    //             ->load
    //             ->view("users/create_user_session", $data);
    //     }
    //     else
    //     {

    //         $this
    //             ->load
    //             ->view("users/create_user_session", $data);
	// 	}

    // }

    // public function createUserUsingSessionAdd()
    // {

    //     $product_name = $_REQUEST["product_name"];
    //     $category = $_REQUEST["category"];
    //     $price = $_REQUEST["price"];
    //     $quantity = $_REQUEST["quantity"];
    //     $total = $price * $quantity;

    //     $data = array(
    //         'product_name' => $product_name,
    //         'category' => $category,
    //         'price' => $price,
    //         'quantity' => $quantity,
    //         'total' => $total
    //     );

    //     if ($this->session->userdata("user"))
    //     {
    //         $values = array();
    //         $values = $this->session->userdata("user");
    //         echo $values;
    //         $count = 0;
    //         foreach ($values as $olddata)
    //         {
    //             if ($olddata["product_name"] == $data["product_name"])
    //             {
    //                 // array_splice($values,$count,$data);
    //                 $data["quantity"] += $olddata["quantity"];//adding quantity not overriding
    //                 $data["total"] = $data["quantity"]*$data["price"];
    //                 unset($values[$count]);
    //                 echo $olddata;
    //             }
    //             $count++;
    //         }
    //         $values = array_values($values);
    //         array_push($values, $data);
    //         $this->session->set_userdata("user", $values);
    //     }
    //     else
    //     {
    //         $values = array();
    //         array_push($values, $data);
    //         $this->session->set_userdata("user", $values);

    //     }

       

    //     return redirect("/user/createusersession");
    // }

    // public function emptySession()
    // {
    //     unset($_SESSION['user']);
    //     return redirect("user/createusersession");

    // }

    // public function submitAllSession()
    // {
    //     $data = $this
    //         ->session
    //         ->userdata("user");

    //     // print_r($data[0]['product_name']);
    //     foreach ($data as $val)
    //     {
    //         // print_r($val["product_name"]);
    //         $this
    //             ->users_model
    //             ->submitAllSession($val);
    //     }
    //     unset($_SESSION['user']);
    //     return redirect("/user/allusers");

    // }

    // public function deleteFromSession($row_num)
    // {
    //     $values = array();
    //     $values = $this
    //         ->session
    //         ->userdata("user");
    //     unset($values[--$row_num]);
    //     $values = array_values($values);

    //     $this
    //         ->session
    //         ->set_userdata("user", $values);

    //     return redirect("/user/createusersession");

    // }
	

}
