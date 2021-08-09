<?
namespace FORM\Controller;
use FORM\Model\User;

class FormController
{
    private $di;

    private $users;

    public function __construct($di)
    {
        $this->di = $di;
    }

    public function index(){

        $request = $this->di->get('Request');

        $post = $request->post;

        try{

            $images = $this->uploadImages($_FILES["photo"]);

            if(count($images) > 0){

                $user = new User($post['name'],$post['phone'],$post['email'],json_encode($images));

                if($id = $this->saveUser($user)){

                    print_r("Пользователь успешно добавлен!");
                }

            }

        }catch (\ErrorException $e){

            print($e->getMessage());

        }

    }
    
    public function saveUser(User $user){

        $db = $this->di->get('DataBase');

        $query = "INSERT INTO `users`(`name`, `phone`, `email`, `extended`) VALUES ({?},{?},{?},{?})";
        
        $result = $db->query($query,array($user->getName(),$user->getPhone(),$user->getEmail(),$user->getPhoto()));

        return $result;
    }


    public function uploadImages($images = []){

        $result = [];

        foreach ($images["error"] as $key => $error) {

            if ($error == 0) {
                $tmp_name = $images["tmp_name"][$key];

                $name = basename($images["name"][$key]);
               
                if(move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'].'/template/images/'.$name)){

                    array_push($result, '/template/images/'.$name);
                }

            }

        }

        return $result;
    }

    public function getUsers(){

        $db = $this->di->get('DataBase');

        $query = "SELECT * FROM `users` WHERE 1";

        $result = $db->select($query); 

        if(count($result) > 0){

            foreach($result as $key => $value){

                $user = new User($value['name'],$value['phone'],$value['email'],$value['extended']);

                $user->setId($value['id']);
                
                $this->users['Users'][] = $user;
            }

        }

        return $this->users;
    }

}
?>