<? declare(strict_types=1);

namespace FORM\Core;

class Request
{
    /**
     * @var array
     */
    public array $get = [];

    /**
     * @var array
     */
    public array $post = [];

    /**
     * @var array
     */
    public array $request = [];

    /**
     * @var array
     */
    public array $cookie = [];

    /**
     * @var array
     */
    public array $files = [];

    /**
     * @var array
     */
    public array $server = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->get     = $_GET;
        $this->post    = $_POST;
        $this->request = $_REQUEST;
        $this->cookie  = $_COOKIE;
        $this->files   = $_FILES;
        $this->server  = $_SERVER;
    }
}
?>