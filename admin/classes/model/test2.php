<?php
namespace Admin\Model;
class Test2 extends \Model
{
  
   public static function insert()
   {
     $mongo=\Mongo_Db::instance();
     $insert_id = $mongo->insert('users', array(
    'name' => 'John',
    'surname' => 'Doe',
    'email' => 'dont.em@ilme.com',
        ));
     return $insert_id;   
   }   
    
}
