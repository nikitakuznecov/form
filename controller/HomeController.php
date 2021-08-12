<?

namespace FORM\Controller;
use FORM\Model\User;

class HomeController extends Controller
{

    private $users = [];

    public function index(){

        $fenom = $this->di->get('Fenom');

        $objects = $this->getUsers();

        if($objects){

            $fenom->display("content.tpl",$objects);

        }else{

            $fenom->display("content.tpl",array());
        }
    }

    public function addUser(){

        $request = $this->di->get('Request');

        $fenom = $this->di->get('Fenom');

        $post = $request->post;

        try{

            $images = $this->uploadImages($_FILES["photo"]);

            if(count($images) > 0){

                $user = new User($post['name'],$post['phone'],$post['email'],json_encode($images));

                if($id = $this->saveUser($user)){

                    $user->setId($id);

                    $objects = $this->getUsers();

                    $result = $fenom->fetch("table.tpl", $objects);

                    print(json_encode(array('Success'=>true,'Message'=>'Пользователь успешно добавлен!','arrResponse'=>$result)));

                }

            }

        }catch (\ErrorException $e){

            print($e->getMessage());

        }

    }
    
    public function saveUser(User $user) : int{

        $db = $this->di->get('DataBase');

        $query = "INSERT INTO `users`(`name`, `phone`, `email`, `extended`) VALUES ({?},{?},{?},{?})";
        
        $result = $db->query($query,array($user->getName(),$user->getPhone(),$user->getEmail(),$user->getPhoto()));

        return $result;
    }


    public function uploadImages(array $images = []) : array{

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

    public function getUsers() : array{

        $db = $this->di->get('DataBase');

        $query = "SELECT * FROM `users` WHERE 1";

        $result = $db->select($query); 

        if($result){

            foreach($result as $key => $value){

                $user = new User($value['name'],$value['phone'],$value['email'],$value['extended']);

                $user->setId((int) $value['id']);
                
                $this->users['Users'][] = $user;
            }

        }

        return $this->users;
    }

}
?>