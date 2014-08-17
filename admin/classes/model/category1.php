<?php
namespace Admin\Model;
class Category extends \Model
{
    
    public static $mongodb;
    public static  function _init()
    {
        static::$mongodb=\Mongo_Db::instance();
    }
    public static function checkname($namecategory)
    {
      $mongodb=static::$mongodb;
      $query=$mongodb->select(array('name_category','note','active'))
                         ->where(array('name_category'=>$namecategory))
                         ->get_one('category');
      return $query;  
        
    
    }
    public static function insert($data)
    {
      $mongodb=static::$mongodb;
      $query=$mongodb->insert('category',$data);  
      return $query;
        
    }
    public static function count()
    {
        $mongodb=static::$mongodb;
        $query=$mongodb->count('category');
        return $query;
        
    }
    public static function show($limit,$offset)
    {
        
        $mongodb=static::$mongodb;
        $query=$mongodb->select(array('name_category','note','active'))
                        ->order_by(array('timecreater'=>'desc'))
                        ->limit($limit)->offset($offset)
                        ->get('category');
        return $query; 
        
        
    }
    public static function get($id)
    {
       $mongodb=static::$mongodb;
       $query=$mongodb->select(array('name_category','note','active','_id'))
                      ->where(array('_id'=>parent::id($id)))
                      ->get_one('category'); 
                      return $query;
    }
    public static function active($id)
    {
       $mongodb=static::$mongodb;
       $query= $mongodb->where(array('_id'=>parent::id($id)))
                       ->update('category',array('active'=>1));
       if($query)
       {
        return true;
       }
       else
       {
        return false;
       }
        
    }
    public static function unactive($id)
    {
        
         $mongodb=static::$mongodb; 
       $query= $mongodb->where(array('_id'=>parent::id($id)))->update('category',array('active'=>0));
       if($query)
       {
        return true;
       }
       else
       {
        return false;
       }
        
        
    }
    public static function updateedit($id,$data)
    {
        $mongodb=static::$mongodb;
        $query=$mongodb->where(array('_id'=>parent::id($id)))
                       ->update('category',$data);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
      
    }
    public static function delete($id)
    {
        
        $mongodb=static::$mongodb;
        $query=$mongodb->where(array('_id'=>parent::id($id)))
                        ->delete('category');
         if($query)
         {
            return true;
         }
         else
         {
            return false;
         }               
        
    }
    public static function getall()
    {
        $mongodb=static::$mongodb;
        $query=$mongodb->select(array('_id','note','name_category'))->get('category');
        return $query;
    }
    
    
    
}    
