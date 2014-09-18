<?php

class Controller extends Main
{
  private $_modelName; // имя модели
  private $_controllerName; // имя контроллера
  private $_actionName; // действие

  const CONTROLLERS_DIR = 'protected/controllers'; // путь к контроллеру
  const FILE_POSTFIX = 'Controller'; // постфикс в имени файла контроллера
  const ACTION_PREFIX = 'action'; // префикс функции действия
  
  // конструктор
  public function __construct($modelName, $actionName)
  {
    $this->modelName = $modelName;
    $this->controllerName = $modelName . Controller::FILE_POSTFIX;
    $this->actionName = $actionName;
    
    $this->doAction();
  }
  
   // getter
  public function __get($field)
    {
        switch ($field)
        {
            case 'modelName':
                return $this->_modelName;
            case 'controllerName':
                return $this->_controllerName;
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
            case 'controllerName':
                $this->_controllerName = $value;
                break;
            case 'actionName':
                $this->_actionName = $value;
                break;
        }
    }
  
  // полный путь к файлу контроллера
  public function getFullPathToController()
  {
    return Controller::CONTROLLERS_DIR.'/'.$this->controllerName.'.php';
  }
  
  // выполнить действие
  public function doAction()
  {
    require_once($this->getFullPathToController());
    
    $controllerName = $this->controllerName;
    $actionName = Controller::ACTION_PREFIX . $this->actionName;

    $controller = new $controllerName();
    $controller->$actionName();
  }
  
  // переход к представлению
  public function render($viewName, $params = array())
  {
    require_once('View.php');
    $view = new View($this->modelName, $viewName, $params);
  }
}