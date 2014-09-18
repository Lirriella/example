<?php

class Controller extends Main
{
  private $_modelName; // ��� ������
  private $_controllerName; // ��� �����������
  private $_actionName; // ��������

  const CONTROLLERS_DIR = 'protected/controllers'; // ���� � �����������
  const FILE_POSTFIX = 'Controller'; // �������� � ����� ����� �����������
  const ACTION_PREFIX = 'action'; // ������� ������� ��������
  
  // �����������
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
  
  // ������ ���� � ����� �����������
  public function getFullPathToController()
  {
    return Controller::CONTROLLERS_DIR.'/'.$this->controllerName.'.php';
  }
  
  // ��������� ��������
  public function doAction()
  {
    require_once($this->getFullPathToController());
    
    $controllerName = $this->controllerName;
    $actionName = Controller::ACTION_PREFIX . $this->actionName;

    $controller = new $controllerName();
    $controller->$actionName();
  }
  
  // ������� � �������������
  public function render($viewName, $params = array())
  {
    require_once('View.php');
    $view = new View($this->modelName, $viewName, $params);
  }
}