<?php namespace App\Models;

use CodeIgniter\Model;


class Users_model extends Model{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','product_name','category','price','quantity','total'];
   
   //datatable starts
    protected $column_order = array('sl','id','product_name','category','price','quantity','total');
    protected $order = array('id'=>'asc');
    public function getDatatable()
    {
        $builder = $this->db->table("users");
        //search
        if($_POST['search']['value']){
            $search = $_POST['search']['value'];
            $query = "product_name LIKE '%$search%' OR category LIKE '%$search%' OR quantity LIKE '%$search%'";

        }
        else{
            $query = "id !=''";
        }

        //order
        if($_POST["order"]){
            $result_order = $this->column_order[$_POST['order']['0']['column']];
            $result_dir = $_POST['order']['0']['dir'];

        }
        else if($this->order){
            $order = $this->order;
            $result_order = Key($order);
            $result_dir = $order[Key($order)];
        }
        if($_POST["length"]!=-1){
            $query = $builder->select("*")
                            ->where($query)
                            ->orderBy($result_order,$result_dir)
                            ->limit($_POST["length"],$_POST["start"])
                            ->get();

            return $query->getResult();

        }

    }

    public function getDatatableCount()
    {
        $builder = $this->db->table("users");
           $query = $builder->countAllResults();
       
        // $query = "SELECT COUNT(id) as rowcount FROM users";
        // $query = $db->query($query)->getRow();
        // print_r($query);
        return $query;

    }

    public function getDatatableFilter()
    {

        if($_POST['search']['value']){
            $search = $_POST['search']['value'];
            $query = "AND (product_name LIKE '%$search%' OR category LIKE '%$search%' OR quantity LIKE '%$search%')";

        }
        else{
            $query = "";
        }

        $db = \Config\Database::connect();

        $query2 = "SELECT COUNT(id) as rowcount FROM users WHERE id !='' $query";
        $query2 = $db->query($query2)->getRow();
        return $query2;
    }

    public function updateUserOnChange($data)
   {
            // print_r($data);
            // echo $data;
            // exit();
            $builder = $this->db->table("users");

                if($data["field_name"]=="category"){
                    $categories = $this->getAllCategories();
                    foreach($categories as $category){
                    
                        if($category->category_name==$data["field_value"]){
                            $data["field_value"]=$category->id;
                        }
                    }
                }

                $values = array(
                    $data["field_name"]=>$data["field_value"]
                );
                
                $builder->where("id",$data["field_id"]);
                
               $builder->update($values);
                
                // //
                $datas = $builder->where("id",$data["field_id"])
                                    ->get()->getResult();

                    
                    
                    $val=$datas[0]->price*$datas[0]->quantity;
                    
                   
                //
                $values = array(
                    "total" => $val
                );
                $builder->where("id",$data["field_id"]);
                
                $builder->update($values);


                $datas = $builder->where("id",$data["field_id"])
                                  ->get()->getResult();

                echo $datas[0]->total;
   
   
    }

    //datatable ends
    //*
    //*
    //*
    //*
    //*
    
    public function getAllCategories()
    {
        $query = $this->db->table("categories")
                          ->get();
        return $query->getResult();
    }
    //*
    //*
    //*
    //*
    //*
    //*
    //*
    //without data table

    public function allUsers($limit,$segment)
   {
    
        $query = $this->db
                            ->select("users.id as uid,categories.id as catid,
                            users.product_name as product_name,users.price as price,
                            users.quantity as quantity,users.total as total,
                            categories.category_name as category_name")
                            ->from("users")
                            ->join("categories","users.category=categories.id")
                            ->limit($limit,$segment)
                            ->get();
        // print "<pre>";
        // print_r($query->result());
        // print "</pre>";
        return $query->result();
   }

    public function createUser($data)
    {
        
        $this->db->insert("users",$data);
        
    }

    public function updateUser($id)
    {
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("id",$id);
        $query = $this->db->get();    
        return $result = $query->row();
    }

    public function updated($data)
    {
     
        $this->db->where("id",$data['id']);
        $this->db->update("users",$data);
    }


   public function deleteUser($id)
   {
       $builder = $this->db->table("users");
       $builder->where('id', $id);
       $builder->delete(); 
   }

   //ajax starts
   

   public function submitAllSession($data)
   {
       $this->db->table("users")->insert($data);
   }

   //pagination

   public function num_rows()
   {
       $this->db->select("*");
       $query = $this->db->get("users");
       return $result = $query->num_rows();
   }


        

}