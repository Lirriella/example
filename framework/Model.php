<?php

class Model extends Main
{
  const MODELS_DIR = "protected/models"; // ����� � ��������
  const CONFIG_DIR = "protected/config/main.php"; // ���� � ����������
  
  // ������ ������
  const ERROR_CONNECT = "������ �� ������. ";
  const ERROR_DB = "���� �� �������. ";
  const ERROR_QUERY = "������������ ������. ";

  // �����������
  public function __construct()
  {    
    $this->dbConnect();
  }
  
  // ����������� � ����
  private static function dbConnect()
  {
     $config = Model::getConfig();
     
    // ������������ � ��������
    $connect = mysql_connect($config['serverMySQL'], $config['userMySQL'], $config['passwordMySQL'])
      or die(Model::ERROR_CONNECT . mysql_error());
      
    // ������������ � ����  
    mysql_select_db($config['nameMySQL'], $connect)
      or die(Model::ERROR_DB . mysql_error());

    return true;
  }
  
  // �������� ���������
  private static function getConfig()
  {
    $configDefault = array(
      'serverMySQL' => 'localhost',
      'userMySQL' => 'root',
      'passwordMySQL' => '',
      'nameMySQL' => 'lib',
    );
    
    require(Model::CONFIG_DIR);
  
    return isset($config) ? $config : $configDefault;
  }
  
   
  // ������� ��� ������, ����� ����� � ��� ������
  public static function openModels()
  {
    $dir = Model::MODELS_DIR;
  
   if (is_dir($dir)) 
   {
      if ($dh = opendir($dir)) 
      {
          while (($file = readdir($dh)) !== false) 
          {
            if ($file != '.' && $file != '..')
            {
              require_once(Model::MODELS_DIR . '/' . $file);
            }
          }
          closedir($dh);
      }
    }
  }
  
  // �������� ������� �� ���� �� �������
  public static function find($modelName, $where = '1')
  {
    Model::dbConnect();
    $models = array();
    $sql = mysql_query("SELECT * FROM $modelName WHERE $where");

    while($row = mysql_fetch_object($sql, $modelName))
    {
        $models[] = $row;
    }
    return $models;
  }
  
  // ��������� ������
  public function save($tableName, $keys, $fields)
  {
    $save = false;
    if ($tableName && $keys && $fields && count($keys) == count($fields))
    {
        $query = "INSERT INTO $tableName (".implode(',', $keys).") VALUES ('" . implode("','",$fields) . "')";
        $save = mysql_query($query);
    }
    return $save;
  }
}