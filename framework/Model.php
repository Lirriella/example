<?php

class Model extends Main
{
  const MODELS_DIR = "protected/models"; // папка с моделями
  const CONFIG_DIR = "protected/config/main.php"; // путь к настройкам
  
  // тексты ошибок
  const ERROR_CONNECT = "Сервер не найден. ";
  const ERROR_DB = "База не найдена. ";
  const ERROR_QUERY = "Неправильный запрос. ";

  // конструктор
  public function __construct()
  {    
    $this->dbConnect();
  }
  
  // подключение к базе
  private static function dbConnect()
  {
     $config = Model::getConfig();
     
    // сооединиться с сервером
    $connect = mysql_connect($config['serverMySQL'], $config['userMySQL'], $config['passwordMySQL'])
      or die(Model::ERROR_CONNECT . mysql_error());
      
    // подключиться к базе  
    mysql_select_db($config['nameMySQL'], $connect)
      or die(Model::ERROR_DB . mysql_error());

    return true;
  }
  
  // получить настройки
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
  
   
  // открыть все модели, чтобы иметь к ним доступ
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
  
  // получить объекты из базы по условию
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
  
  // сохранить объект
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