<?php

class BooksController extends Controller
{

  // �����������
  public function __construct()
  {
    $this->modelName = 'Books';
    $this->controllerName = 'BooksController';
  }

  // �������� �� ���������
  public function actionIndex()
  {
    Site::goToDefaultPage();
  }

  // ���������� �������
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
	
  // ������ ��������
  public function actionList()
  {
    $this->render('list');
  }
	
	// ������ �� �������� (����)
	public function actionSearch()
	{
      if (isset($_GET['val']))
      {
        $_GET['val'] = iconv("UTF-8", "windows-1251", $_GET['val']);
      }
      else
      {
        $_GET['val'] = NULL;
      }
      echo Books::getList(NULL, $_GET['val']);
	}
}