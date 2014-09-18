<?php

class SiteController extends Controller
{

  // конструктор
  public function __construct()
  {
    $this->modelName = 'Site';
    $this->controllerName = 'SiteController';
  }
  
  // домашняя страница
  public function actionIndex()
  {
    Site::goToDefaultPage();
  }
}