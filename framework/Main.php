<?php

class Main
{
  private $_modelName; // имя модели
  private $_actionName; // действие

  const DEFAULT_MODEL = 'Site'; // модель по умолчанию
  const DEFAULT_ACTION = 'Index'; // действие по умолчанию
  const DEFAULT_PAGE = 'index.php'; // точка входа
    
  // конструктор
  public function __construct()
  {
    $this->setDefaultValues();
    $this->doAction();
  }
  
  // getter
  public function __get($field)
    {
        switch ($field)
        {
            case 'modelName':
                return $this->_modelName;
            case 'actionName':
                return $this->_actionName;
        }
    }
 
   // setter
    public function __set($field, $value)
    {
        switch ($field)
        {
            case 'modelName':
                $this->_modelName = $value;
                break;
            case 'actionName':
                $this->_actionName = $value;
                break;
        }
    }
  
  // задать значения полей
  private function setDefaultValues()
  {
      $this->modelName = Main::calcModelName();
      $this->actionName = Main::calcActionName();
  }
  
  // определение модели
  private static function calcModelName()
  {
     return isset($_GET['m']) ? $_GET['m'] : Main::DEFAULT_MODEL;
  }
  
  // определение действия
  private static function calcActionName()
  {
     return isset($_GET['a']) ? $_GET['a'] : Main::DEFAULT_ACTION;
  }
  
  // получить адрес страницы
  public static function getUrl()
  {
    return Main::DEFAULT_PAGE . '?m='. Main::calcModelName() . '&a=' . Main::calcActionName();
  }
  
  // выполнить действие
  private function doAction()
  {
    require_once('Model.php');
    Model::openModels();
    
    require_once('Controller.php');
    $controller = new Controller($this->modelName, $this->actionName);
  }
  
}