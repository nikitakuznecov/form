<?
namespace FORM\Model;

class User
{
    private $id;

    private $name;

    private $phone;

    private $email;

    private $photo;

    /**
     * User constructor.
     */
    public function __construct($name,$phone,$email,$photo)
    {
        $this->name = $name;

        $this->phone = $phone;

        $this->email = $email;

        $this->photo = $photo;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
       $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPhoto(){
        return $this->photo;
    }

    public function setPhoto($photo){
        $this->photo = $photo;
    }
}
?>