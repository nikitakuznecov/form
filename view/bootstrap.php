<?
    ini_set('error_reporting', E_ERROR);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
   
    require_once __DIR__ .'/../vendor/autoload.php';

    use FORM\Model\Di;
    use FORM\Model\DataBase;
    use FORM\Model\Config;
    use FORM\Model\Request;
    use FORM\Controller\FormController;

    try{
        //Include DI
        $di = new Di();

        //Add config
        $config = new Config();
        $di->set("Config",$config->get());

        //Add DataBase object
        $di->set("DataBase",DataBase::getDB($di));

        //Add Fenom object
        $fenom = new \Fenom(new \Fenom\Provider( __DIR__.'/../template/tpl/'));

        $fenom->setCompileDir(__DIR__.'/../cache/');

        $fenom->setOptions(array("auto_reload"=>true,"force_include"=>true,"strip"=>true,"disable_cache" => 1));

        $di->set("Fenom", $fenom);

        //Add Request object
        $request = new Request();
        
        $di->set("Request", $request);

        $controller = new FormController($di);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            
            $objects = $controller->getUsers();

            if(count($objects) > 0){

                $fenom->display("content.tpl",$objects );

            }else{

                $fenom->display("content.tpl",array());
            }
            

        }else{
           
            $controller->index();
        }

    }catch (\ErrorException $e) {

        echo $e->getMessage();

    }
?>