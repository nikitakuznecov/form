<?
    ini_set('error_reporting', E_ERROR);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    require_once __DIR__ .'/../vendor/autoload.php';

    use FORM\Core\Di;
    use FORM\Core\DataBase;
    use FORM\Core\Config;
    use FORM\Core\Request;
    use FORM\Controller\FormController;

    try{
        //Include DI
        $di = new Di();

        //Add config
        $di->set("Config",Config::getInstance()->get());

        //Add DataBase object
        $di->set("DataBase",DataBase::getInstance());

        //Add Fenom object
        $fenom = new \Fenom(new \Fenom\Provider( __DIR__.'/../template/tpl/'));

        $fenom->setCompileDir(__DIR__.'/../cache/');

        $fenom->setOptions(array("auto_reload"=>true,"force_include"=>true,"strip"=>true,"disable_cache" => 1));

        $di->set("Fenom", $fenom);

        //Add Request object
        $request = new Request();
        
        $di->set("Request", $request);

        $controller = new FormController($di);

        if ($request->server['REQUEST_METHOD'] !== 'POST') {
            
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