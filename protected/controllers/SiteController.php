<?php

class SiteController extends Controller
{

  // �����������
  public function __construct()
  {
    $this->modelName = 'Site';
    $this->controllerName = 'SiteController';
  }
  
  // �������� ��������
  public function actionIndex()
  {
    Site::goToDefaultPage();
  }
}