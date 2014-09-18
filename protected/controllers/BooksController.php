<?php

class BooksController extends Controller
{

  // конструктор
  public function __construct()
  {
    $this->modelName = 'Books';
    $this->controllerName = 'BooksController';
  }

  // страница по умолчанию
  public function actionIndex()
  {
    Site::goToDefaultPage();
  }

  // добавление объекта
	public function actionCreate()
	{
    $book = new Books;  
   
    if (isset($_REQUEST['Books']))
    {
      $book->setAttributes($_REQUEST['Books']);
    }
    
    if (isset($_REQUEST['save']) && $_REQUEST['save'])
    {
        $book->save();
    }
    
    $this->render('create', array('book'=>$book));
	}
	
  // список объектов
  public function actionList()
  {
    $this->render('list');
  }
	
	// искать по названию (аякс)
	public function actionSearch()
	{
      if (!isset($_GET['val']))
      {
        $_GET['val'] = NULL;
      }
      echo Books::getList(NULL, $_GET['val']);
	}
}