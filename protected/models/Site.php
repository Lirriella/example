<?php
class Site extends Model
{
    // ������ ����
    public static $mainMenu = array(
      'index.php?m=Books&a=List' => '������',
      'index.php?m=Books&a=Create' => '��������',
    );  
    
    const DEFAULT_PAGE = 'index.php?m=Books&a=list'; // �������� ��������
    
    // ������� �� �������� ��������
    public static function goToDefaultPage()
    {
      return header("Location: ".Site::DEFAULT_PAGE);
    }
    
    // ������� ����
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