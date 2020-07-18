<?php

namespace app\core;

class RouterCore
{
    private $uri;
    private $method;
    private $getArr = [];
    public function __construct()
    {
        $this->initialize();
        require_once('../app/config/Router.php');
        $this->execute();
    }

    private function initialize()
    {
        //pega uri
        $uri = $_SERVER['REQUEST_URI']; 

        //pegando toda uri e normalizando ela dps
        $ex = explode('/', $uri);
        $uri = $this->normalizeURI($ex);

        //removendo o primeiro index, que no caso é o nome da pasta do projeto
        for ($i = 0; $i < UNSET_URI_COUNT; $i++) {
            unset($uri[$i]);
        }

        //armazenando nas variaveis da classe
        $this->method = $_SERVER['REQUEST_METHOD']; //pega o method
        $this->uri = implode('/',$this->normalizeURI($uri)); // armazenando a uri normalizada

        //executa somente se a constante debug_uri estiver como true
        if (DEBUG_URI) dd($this->uri);
    }

    private function get($router, $call){
        $this->getArr[] = [
            'router' => $router,
            'call' => $call
        ];
    }

    private function execute(){
        switch($this->method){
            case 'GET':
            $this->executeGet();
            break;

            case 'POST':
            
            break;
        }
    }

    private function executeGet(){
        foreach($this->getArr as $get){
            $r = substr($get['router'], 1);
            // echo $r. ' - '. $this->uri.'<br>';
            if($r == $this->uri){
                if(is_callable($get['call'])){
                    $get['call']();
                    break;
                }
            }
        }
    }
    //removendo indexes vazios e realocando indexes
    private function normalizeURI($arr)
    {
        return array_values(array_filter($arr));
    }
}
