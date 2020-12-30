<?php namespace App\Controllers;

use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;

use CodeIgniter\Controller;
use App\Models\Users_model;
use CodeIgniter\HTTP\IncomingRequest;
class Users extends Controller
{
    
    public function index(){
        return redirect()->to("/user/createusersession");
    }

    //*
    //*
    //*
    //*
    //*
    //*
    //*
    //*
    //*
    //*
    //*
    
    public function getDatatableEdit()
    {
        // echo "ewfewftew";
        // exit();
        $users_model = new Users_model();
        Editor::inst( $users_model, 'users' )
    ->fields(
        Field::inst( 'product_name' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A first name is required' ) 
            ) ),
        Field::inst( 'price' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A last name is required' )  
            ) ),
        Field::inst( 'quantity' ),
      
    )
    ->process( $_POST )
    ->json();
    }

    //datatable 
    public function getDatatable()
    {
        return view("users/show_data_table");
    }

    public function getDatatablePost()
    {
        $users_model = new Users_model();
        $listing = $users_model->getDatatable();
        $listingCount = $users_model->getDatatableCount();
        $listingFilter = $users_model->getDatatableFilter();
        $data = array();
        $cat= $users_model->getAllCategories();
        $no = $_POST["start"];
        
        foreach($listing as $key){
            $no++;
            $row= array();
            $row[] = $no;
            $row["id"] = $key->id;
            $row["product_name"] = $key->product_name;
            $row["category"] = $key->category;
            $row["price"] = $key->price;
            $row["quantity"] = $key->quantity;
            $row["total"] = $key->total;
            $row[] = $cat;
            $grandTotal = $grandTotal+$key->total;
            $data[] = $row;

        }
       

        $output = array(
            "draw" => $_POST['draw'],            
            "recordsTotal" => $listingCount,
            "recordsFiltered" => $listingFilter->rowcount,
            "data" => $data,
            "grand" => $grandTotal
        );
        echo json_encode($output);
    }

    public function getDatatableDelete($id)
    {
        
        $users_model = new Users_model();
        $users_model->deleteUser($id);
        return redirect()->to("/user/getdatatable");
    }

    public function updateUserOnChange()
    {
        $request = service('request');
        $users_model = new Users_model();
        $data = $request->getGet();
        $users_model->updateUserOnChange($data);
           
    }

    
    
    
    //*
    //*
    //*
    //*
    //*
    //*
    //*
    //*





    //without data table
    public function allUsers($segment = 0)
    {
        $users_model = new \App\Models\Users_model();
        $pager = \Config\Services::pager();
        
        $data = [
            'data' => $users_model->paginate(10),
            'pager' => $users_model->pager,
            'categories' => $users_model->getAllCategories()
        ];
        //  print "<pre>";
        //  print_r($data["pager"]);
        //  print "</pre>";
        return view("users/alluser",$data);

    }


//*
//*
//*
//*
//*
//*
//*
//*
//*
//*



    //file upload
    public function fileUploadGet()
    {
        return view("users/file_upload");
    }
    public function fileUploadPost()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'img' => 'uploaded[img]|max_size[img,1024]|ext_in[img,jpg]'
        ]);

        if($validation->withRequest($this->request)->run()==false){

            $data["validation"] = $validation;
            return view("users/file_upload",$data);

        }
        else{

            $file = $this->request->getFile('img');
            if($file->isValid()){
                $file->store('images/','newimages.jpg');
                return redirect()->to("/");
            }
        }
       
    }
//*
//*
//*
//*
//*
//*
//*
//*
//*
//*
//*

    //session
    public function createUserUsingSession()
    {
        $session = session();
        $usersModel = new Users_model();
        $data["categories"] = $usersModel->getAllCategories();
        if ($session->get("user"))
        {
            $data["data"] =$session->get("user");
           return view("users\create_user_session", $data);
        }
        else
        {

           return view("users\create_user_session", $data);
        }
        return view("users\create_user_session",$data);

    }

    public function createUserUsingSessionAdd()
    {
        $session = session();
        
        $validation =  \Config\Services::validation();
        $validation->setRules([

            'product_name' => 'required',
            'price' => 'required',
            'quantity' => 'required'

        ]);

         if($validation->withRequest($this->request)->run()==false){

            if ($session->get("user"))
              {
                $values = array();
                $values = $session->get("user");
                
                $count = 0;
                foreach ($values as $olddata)
                {
                    if ($olddata["product_name"] == $data["product_name"])
                    {
                        // array_splice($values,$count,$data);
                        $data["quantity"] += $olddata["quantity"];//adding quantity not overriding
                        $data["total"] = $data["quantity"]*$data["price"];
                        unset($values[$count]);
                        echo $olddata;
                    }
                    $count++;
                }
                $values = array_values($values);
                array_push($values, $data);
                $session->set("user", $values);
              }
                // print_r($validation->listErrors());
                    $usersModel = new Users_model();
                $data["categories"] = $usersModel->getAllCategories();
                $data["validation"] = $validation;
            
                return view("users\create_user_session",$data);
           
         }
         else{   
                


        $product_name = $_REQUEST["product_name"];
        $category = $_REQUEST["category"];
        $price = $_REQUEST["price"];
        $quantity = $_REQUEST["quantity"];
        $total = doubleval($price) * doubleval($quantity);



        $data = array(
            'product_name' => $product_name,
            'category' => $category,
            'price' => $price,
            'quantity' => $quantity,
            'total' => $total
        );
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        if ($session->get("user"))
        {
            $values = array();
            $values = $session->get("user");
            echo $values;
            $count = 0;
            foreach ($values as $olddata)
            {
                if ($olddata["product_name"] == $data["product_name"])
                {
                    // array_splice($values,$count,$data);
                    $data["quantity"] += $olddata["quantity"];//adding quantity not overriding
                    $data["total"] = $data["quantity"]*$data["price"];
                    unset($values[$count]);
                    echo $olddata;
                }
                $count++;
            }
            $values = array_values($values);
            array_push($values, $data);
            $session->set("user", $values);
        }
        else
        {
            $values = array();
            array_push($values, $data);
            $session->set("user", $values);

        }

       

        return redirect()->to("/user/createusersession");

        }

    }

    public function emptySession()
    {
        $session = session();
        $session->remove('user');
        return redirect()->to("/user/createusersession");

    }

    public function submitAllSession()
    {
        $session = session();
        $data = $session->get("user");
        $usersModel = new Users_model();

        // print_r($data[0]['product_name']);
        foreach ($data as $val)
        {
            // print_r($val["product_name"]);
            $usersModel->submitAllSession($val);
        }

        $session->remove("user");
        return redirect()->to("/");

    }

    public function deleteFromSession($row_num)
    {
        $session = session();
        $values = array();
        $values = $session->get("user");
        unset($values[--$row_num]);
        $values = array_values($values);

        $session->set("user", $values);

        return redirect()->to("/user/createusersession");

    }











}