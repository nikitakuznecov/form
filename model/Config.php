<?php

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
     * @param $key
     * @param $value
     * @return string
     */
    public function set($key, $value)
    {
        try{
            
            if(empty ( $key ) ){throw new \ErrorException('Ошибка, ключ не указан!');}
            
            if(empty ( $value ) ){throw new \ErrorException('Ошибка, массив значений не указан!');}
            
             $this->config[$key] = array_merge($this->config[$key], $value);
            
            if(!file_put_contents($this->replacePath(), json_encode($this->config), LOCK_EX)){throw new \ErrorException('Ошибка, данные не получилось записать в файл!');}
            
        }catch(\ErrorException $e){
             
              return $e->getMessage();
             
         }
    }

    /**
     * @param $key
     * @return string
     */
    public function addKey($key)
    {
        try{
            
            if(empty ( $key ) ){throw new \ErrorException('Ошибка, ключ не указан!');}
            
             $this->config = array_merge($this->config, array($key=>array()));
            
            if(!file_put_contents($this->replacePath(), json_encode($this->config), LOCK_EX)){throw new \ErrorException('Ошибка, данные не получилось записать в файл!');}
            
        }catch(\ErrorException $e){
             
              return $e->getMessage();
             
         }
    }

    /**
     * @param $keyParent
     * @param $keyChildren
     * @return string
     */
    public function remove($keyParent, $keyChildren)
    {
      
        try{
            
            if( empty ( $keyParent ) ){throw new \ErrorException('Ошибка, ключ кутегории не указан!');}
            
            if( empty ( $keyChildren ) ){throw new \ErrorException('Ошибка, ключ не указан!');}
            
            unset($this->config[$keyParent][$keyChildren]);
            
            if(!file_put_contents($this->replacePath(), json_encode($this->config), LOCK_EX)){throw new \ErrorException('Ошибка, данные не получилось удалить из файла!');}
            
        }catch(\ErrorException $e){
             
             return $e->getMessage();
             
         }
    }

    /**
     * @param $keyParent
     * @param $keyChildren
     * @param $valueChildren
     * @return string
     */
    public function update($keyParent, $keyChildren, $valueChildren)
    {
      
        try{
            
            if( empty ( $keyParent ) ){throw new \ErrorException('Ошибка, ключ кутегории не указан!');}
            
            if( empty ( $keyChildren ) ){throw new \ErrorException('Ошибка, ключ не указан!');}
            
            if( empty ( $valueChildren ) ){throw new \ErrorException('Ошибка, значение не указано!');}
            
            $this->config[$keyParent][$keyChildren] = $valueChildren;
            
            if(!file_put_contents($this->replacePath(), json_encode($this->config), LOCK_EX)){throw new \ErrorException('Ошибка, данные не получилось обновить в файле!');}
            
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