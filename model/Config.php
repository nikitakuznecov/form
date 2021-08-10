<? 

namespace FORM\Model;

class Config
{

    private $config = array();
    
    private $fileName = 'config.json';

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = $this->get();
    }
    
    /**
      * меняем путь относительно проверенного результата, указывать относительный путь!
      */ 
    public function replacePath()
    {

       if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {

            $path = str_replace('/', '\\'.'\\', $_SERVER['DOCUMENT_ROOT']."/config/".$this->fileName);

        } else {

            $path = $_SERVER['DOCUMENT_ROOT']."/assets/config/".$this->fileName;
        }

        return $path;

   }

    /**
     * Метод позоволяет получить содержимое файла
     */
     public function get()
     {
         
         try{
              $path = $this->replacePath();
              
              if( !is_readable ( $path) ){throw new \ErrorException('Ошибка, файл не удалось прочитать!');}
              
              $data = json_decode(file_get_contents($path),'JSON_OBJECT_AS_ARRAY');
              
              if( !($data) ){throw new \ErrorException('Ошибка, данные не получилось прочитать');}
              
              $this->config = $data;
              
              return $this->config; 
             
         }catch(\ErrorException $e){
             
              return $e->getMessage();
             
         }

    }

    /**
     * @return array|string
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array|string $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

}