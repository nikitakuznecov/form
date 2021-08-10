<? declare(strict_types=1);

namespace FORM\Model;

class User 
{
    private int $id;

    private string $name;

    private string $phone;

    private string $email;

    private string $photo;

    /**
     * User constructor.
     */
    public function __construct(string $name,string $phone,string $email,string $photo)
    {
        $this->name = $name;

        $this->phone = $phone;

        $this->email = $email;

        $this->photo = $photo;
    }

    public function getId() : int{
        return $this->id;
    }

    public function setId(int $id): void {
       $this->id = $id;
    }

    public function getName() : string{
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getPhone() : string{
        return $this->phone;
    }

    public function setPhone(string $phone): void {
        $this->phone = $phone;
    }

    public function getEmail() : string{
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPhoto() : string{
        return $this->photo;
    }

    public function setPhoto(string $photo): void {
        $this->photo = $photo;
    }
}
?>