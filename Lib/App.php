<?php

namespace Lib;

class App
{
    protected $printer;

    protected $registry = [];

    

   

    public function __construct()
    {
        $this->printer = new Display();

        @ $this->$movieList = [
            ['name'=>'Zoro','time'=>125],
            ['name'=>'Justice League','time'=>240],
            ['name'=>'God Must Be Crazy','time'=>100],
            ['name'=>'Sarafina','time'=>125],
            ['name'=>'King Kong','time'=>175],
            ['name'=>'The Colony','time'=>95],
            ['name'=>'SnowComing','time'=>85],
            ['name'=>'Camen','time'=>75],
            ['name'=>'Duma','time'=>65],
            ['name'=>'Lion King','time'=>75],
            ['name'=>'2012','time'=>125]
        ];

    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function registerCommand($name, $callable)
    {
        $this->registry[$name] = $callable;
    }

    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

    public function runCommand(array $argv = [])
    {
        $command_name = "help";

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->getPrinter()->display("ERROR: Command \"$command_name\" not found.");
            exit;
        }

        call_user_func($command, $argv);
    }

    public function movieRecommendation($var)
    {
        $_viableMovies = [];
        $_finalMovies = []; // repetation to literal inversion
        $_cleanedArr =[];
        $_dur = $var;
        
        
        @ $movieList = $this->$movieList;
        foreach ($movieList as $key => $movie) {
            if($movie['time'] <= $_dur){
                array_push($_viableMovies,$movie);
            }
           
        }
        foreach ($_viableMovies as $key2 => $value2) {
           
            foreach ($_viableMovies as $key3 => $value3) {
                if(($value2['time']+$value3['time'] == $_dur) && ($value2['name'] != $value3['name'])){
                    $_aux = ['movies'=>$value2['name'].'+'.$value3['name'],'duration'=>$value2['time']+$value3['time']];
                    $_finalMovies[$key3] =  $_aux;
                    unset($_viableMovies[$key3]);
                    continue(2);
                }else{
                    continue;
                }
                unset($_viableMovies[$key2]);
            }
        
        }
        $count = count($_finalMovies);
        $_cleanedArr= array_splice($_finalMovies,$count/2);
        print_r($_cleanedArr);

    }

    public function movieList()
    {
        // display all our available movies

        @ $movieList = $this->$movieList;
        foreach ($movieList as $key => $movie) {
            echo ++$key.'. Title: '. $movie['name'] ." Length: " .$movie['time']. '(min)'."\n";
        }
    }
  
}


?>