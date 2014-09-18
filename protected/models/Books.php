<?php
class Books extends Model
{    
    // ����
    private $title;
    private $year;
    private $author;
    private $description;
    private $notice;
    private $search;
    
    public static $required = array('title','author'); // ������������ ����
    public static $dbFields = array('title','year','author','description'); // ���� ��� ������ � ����
    
    // ���������
    const SAVED_TEXT = '������ ������� ���������.';
    const NOT_SAVED_TEXT = '��� ���������� ��������� ������.';
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
    
    // ��������� �����
    public static function getLabels($field, $checkRequires = false)
    {
      $labels = array(
        'title' => '�������� �����',
        'year' => '��� �������',
        'author' => '��� ������',
        'description' => '�������������� ��������',
      );
       
      $star = NULL; 
      if ($checkRequires && Books::checkRequiredField($field))
      {
        $star = ' *';
      }
      
      return isset($labels[$field]) ? $labels[$field].$star : ''.$star;
    }
    
    // �������� �� �������� ���� ������������
    public static function checkRequiredField($field)
    {
      return in_array($field, Books::$required);
    }
    
    // ������ �������� ����� ������� �� �������
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

    // ������������ �����
    public static function checkField($val)
    {
        $val = stripcslashes($val);
        $val = addslashes($val);
        return $val;
    }

    //��������� �����
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
    
    // ������, �����/������� ��������� ����
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
    
    // ������ ������ ���������
    public function validateErrorsText()
    {
      $text = NULL;
      $errors = $this->checkRequired();
      if ($errors)
      {
        $text = "�� ��������� ������������ ����: ".implode(',',$errors);
      }
      return $text;
    }
    
    // �������� ������� �� ���� �� �������
    public static function find($where = '1')
    {
      return parent::find(Books::TABLE_NAME, $where);
    }
    
    // ���������� ������� ������
    public static function getWhere($value = NULL)
    {
      $where = '1';
      if ($value)
      {
        $where = " title LIKE '%".Books::checkField($value)."%' OR author LIKE '%".Books::checkField($value)."%'";
      }
      return $where;
    }
    
    // �������� ������ ����
    public static function getList($fields = array(), $value = NULL)
    {
      $where = Books::getWhere($value); // ������� ������
      $books = Books::find($where); // ��������� ������
      
      $list = '<table class=\'book-list\'>';
      // ��������� �������
      if (!$fields)
          {
            $fields = Books::$dbFields;
          }
      Books::addTitlesToTable($fields, $list);
          
      // ������ ����
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
    
    // �������� ��������� � �������
    public static function addTitlesToTable($fields, &$list)
    {
        $list .= "<tr>";          
        foreach ($fields as $field)
        {
           $list .= "<td class='bold'>".Books::getLabels($field)."</td>";
        }
        $list .= "</tr>";
    }
    
    // ��������� ������
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
    
    // ������ �������� ����� ��� ����������
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
    
    // ��������� � ���������� ����������
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