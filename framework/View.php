<?php

class View extends Main
{
  private $_modelName; // имя модели
  private $_viewName; // имя представления
  private $_params; // параметры из контроллера

  const VIEW_DIR = 'protected/views'; // путь к представлению
  const BASE_VIEW_DIR = 'protected/views/Layouts/main.php'; // путь к базовому шаблону
  
  // конструктор
  public function __construct($modelName, $viewName, $params = array())
  {
    $this->modelName = $modelName;
    $this->viewName = $viewName;
    $this->params = $params;
    
    $this->showPage();
  }
  
  // getter
  public function __get($field)
    {
        switch ($field)
        {
            case 'modelName':
                return $this->_modelName;
            case 'viewName':
                return $this->_viewName;
            case 'params':
                return $this->_params;
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
            case 'viewName':
                $this->_viewName = $value;
                break;
            case 'params':
                $this->_params = $value;
                break;
        }
    }
  
  // полный путь к файлу
  public function getFullPathToView()
  {
    return View::VIEW_DIR.'/'.$this->modelName . '/' . $this->viewName .'.php';
  }
  
  // получить текст из представления
  public function getViewText()
  {
    extract($this->params, EXTR_OVERWRITE); // массив в переменные
    require_once($this->getFullPathToView());
  }
  
  // вывод страницы
  public function showPage()
  {
      extract($this->params, EXTR_OVERWRITE); // массив в переменные
      require_once(View::BASE_VIEW_DIR);
  }
 
}