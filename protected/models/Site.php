<?php
class Site extends Model
{
    // пункты меню
    public static $mainMenu = array(
      'index.php?m=Books&a=List' => '—писок',
      'index.php?m=Books&a=Create' => 'ƒобавить',
    );  
    
    const DEFAULT_PAGE = 'index.php?m=Books&a=list'; // домашн€€ страница
    
    // перейти на домашн€ю страницу
    public static function goToDefaultPage()
    {
      return header("Location: ".Site::DEFAULT_PAGE);
    }
    
    // главное меню
    public static function getMainMenu()
    {
      $menu = '<ul>';
      foreach(Site::$mainMenu as $url => $title){
        $menu .= "<li><a href='".$url."'>".$title."</a></li>";
      }
      $menu .= '</ul>';
      return $menu;
    }
}