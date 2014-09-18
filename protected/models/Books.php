<?php
class Books extends Model
{    
    // пол€
    private $title;
    private $year;
    private $author;
    private $description;
    private $notice;
    private $search;
    
    public static $required = array('title','author'); // об€зательные пол€
    public static $dbFields = array('title','year','author','description'); // пол€ дл€ записи в базу
    
    // сообщени€
    const SAVED_TEXT = 'ƒанные успешно сохранены.';
    const NOT_SAVED_TEXT = 'ѕри сохранении произошла ошибка.';
    const TABLE_NAME = 'books';
    
    // getter
    public function __get($field)
    {
        switch ($field)
        {
            case 'title':
                return $this->title;
            case 'year':
                return $this->year;
            case 'author':
                return $this->author;
            case 'description':
                return $this->description;
            case 'notice':
                return $this->notice;
            case 'search':
                return $this->search;
        }
    }
 
    // setter
    public function __set($field, $value)
    {
        switch ($field)
        {
            case 'title':
                $this->title = $value;
                break;
            case 'year':
                $this->year = $value;
                break;
            case 'author':
                $this->author = $value;
                break;
            case 'description':
                $this->description = $value;
                break;
            case 'notice':
                $this->notice = $value;
                break;
            case 'search':
                $this->search = $value;
                break;
        }
    }
    
    // заголовки полей
    public static function getLabels($field, $checkRequires = false)
    {
      $labels = array(
        'title' => 'Ќазвание книги',
        'year' => '√од выпуска',
        'author' => '»м€ автора',
        'description' => 'ƒополнительное описание',
      );
       
      $star = NULL; 
      if ($checkRequires && Books::checkRequiredField($field))
      {
        $star = ' *';
      }
      
      return isset($labels[$field]) ? $labels[$field].$star : ''.$star;
    }
    
    // €вл€етс€ ли заданное поле об€зательным
    public static function checkRequiredField($field)
    {
      return in_array($field, Books::$required);
    }
    
    // задать значени€ пол€м объекта из массива
    public function setAttributes($attrArray)
    {
      foreach($attrArray as $key => $val)
        {
          if(property_exists($this, $key))
            {
              $val = Books::checkField($val);
              $this->$key = $val;
            }
        }
    }

    // экранировать слэши
    public static function checkField($val)
    {
        $val = stripcslashes($val);
        $val = addslashes($val);
        return $val;
    }

    //валидаци€ полей
    public function checkRequired()
    {
        $errors = array();
        $required = Books::$required;
        
        foreach ($required as $field)
        {
          if(!property_exists($this, $field) || $this->$field === '')
           {
                $errors[] = '"'.Books::getLabels($field).'"';
            }
        }
        
        return $errors;
    }
    
    // узнать, верно/неверно заполнены пол€
    public function validate()
    {
      if (!$this->checkRequired())
      {
        $validate = true;
      }
      else
      {
        $validate = false;
        $this->notice = $this->validateErrorsText();
      }
      return $validate;
    }
    
    // список ошибок валидации
    public function validateErrorsText()
    {
      $text = NULL;
      $errors = $this->checkRequired();
      if ($errors)
      {
        $text = "Ќе заполнены об€зательные пол€: ".implode(',',$errors);
      }
      return $text;
    }
    
    // получить объекты из базы по условию
    public static function find($where = '1')
    {
      return parent::find(Books::TABLE_NAME, $where);
    }
    
    // определить услови€ поиска
    public static function getWhere($value = NULL)
    {
      $where = '1';
      if ($value)
      {
        $where = " title LIKE '%".Books::checkField($value)."%' OR author LIKE '%".Books::checkField($value)."%'";
      }
      return $where;
    }
    
    // получить список книг
    public static function getList($fields = array(), $value = NULL)
    {
      $where = Books::getWhere($value); // услови€ поиска
      $books = Books::find($where); // резулитат поиска
      
      $list = '<table class=\'book-list\'>';
      // заголовок таблицы
      if (!$fields)
          {
            $fields = Books::$dbFields;
          }
      Books::addTitlesToTable($fields, $list);
          
      // список книг
      foreach ($books as $book)
      {    
          $list .= "<tr>";          
          foreach ($fields as $field)
          {
            if (property_exists($book, $field))
            {
              $list .= "<td>{$book->$field}</td>";
            }
          }
          $list .= "</tr>";
      }
      
      $list .= '</table>';
      
      return $list;
    }
    
    // добавить заголовок к таблице
    public static function addTitlesToTable($fields, &$list)
    {
        $list .= "<tr>";          
        foreach ($fields as $field)
        {
           $list .= "<td class='bold'>".Books::getLabels($field)."</td>";
        }
        $list .= "</tr>";
    }
    
    // сохранить объект
    public function save()
    {
      $save = false;
      if ($this->validate())
      {
          $keys = Books::$dbFields;
          $fields = $this->getFieldsForSave();
          $save = parent::save(Books::TABLE_NAME, $keys, $fields);
      }
      
      $this->setSaveMsg($save);
      
      return $save;
    }
    
    // список значений полей дл€ сохранени€
    public function getFieldsForSave()
    {
          $keys = Books::$dbFields;
          $fields = array();
          
          foreach ($keys as $key)
          {
            if (property_exists($this, $key))
            {
              $this->$key = Books::checkField($this->$key);
              $fields[$key] = $this->$key;
            }
          }
          
          return $fields;
    }
    
    // сообщение о результате сохранени€
    public function setSaveMsg($save)
    {
      if ($save)
      {
        $this->notice = Books::SAVED_TEXT;
      }
      elseif(!$this->notice)
      {
        $this->notice = Books::NOT_SAVED_TEXT;
      }
    }
}