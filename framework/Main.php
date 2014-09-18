<?php

class Main
{
  private $_modelName; // ��� ������
  private $_actionName; // ��������

  const DEFAULT_MODEL = 'Site'; // ������ �� ���������
  const DEFAULT_ACTION = 'Index'; // �������� �� ���������
  const DEFAULT_PAGE = 'index.php'; // ����� �����
    
  // �����������
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
  
  // ������ �������� �����
  private function setDefaultValues()
  {
      $this->modelName = Main::calcModelName();
      $this->actionName = Main::calcActionName();
  }
  
  // ����������� ������
  private static function calcModelName()
  {
     return isset($_GET['m']) ? $_GET['m'] : Main::DEFAULT_MODEL;
  }
  
  // ����������� ��������
  private static function calcActionName()
  {
     return isset($_GET['a']) ? $_GET['a'] : Main::DEFAULT_ACTION;
  }
  
  // �������� ����� ��������
  public static function getUrl()
  {
    return Main::DEFAULT_PAGE . '?m='. Main::calcModelName() . '&a=' . Main::calcActionName();
  }
  
  // ��������� ��������
  private function doAction()
  {
    require_once('Model.php');
    Model::openModels();
    
    require_once('Controller.php');
    $controller = new Controller($this->modelName, $this->actionName);
  }
  
}