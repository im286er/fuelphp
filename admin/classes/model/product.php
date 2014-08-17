<?php
namespace Admin\Model;
class Product extends \Model
{
 
    public static $mongodb;
    public static  function _init()
    {
        static::$mongodb=\Mongo_Db::instance();
    }
    public static function checkname($nameproduct)
    {
      $mongodb=static::$mongodb;
      $query=$mongodb->select(array('nameproduct','note','active'))
                         ->where(array('nameproduct'=>$nameproduct))
                         ->get_one('product_admin');
      return $query;  
        
    
   } 
   public static function get($id)
   {
       $mongodb=static::$mongodb;
       $query=$mongodb->select(array('nameproduct','note','active','_id','keyvalue','id_category'))
                      ->where(array('_id'=>parent::id($id)))
                      ->get_one('product_admin'); 
                      return $query;
    
   }
   public static function insert($data)
    {
        $mongodb=static::$mongodb;
        $query=$mongodb->insert('product_admin',$data);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public static function count()
    {
        $mongodb=static::$mongodb;
        $query=$mongodb->count('product_admin');
        return $query;
    }
    public static function getpage($limit,$offset)
    {
        
        $mongodb=static::$mongodb;
        $query=$mongodb->select(array('nameproduct','note','active','keyvalue','id_category'))
                        ->order_by(array('timecreater'=>'desc'))
                        ->limit($limit)->offset($offset)
                        ->get('product_admin');
        return $query; 
        
    }
    public static function active($id)
    {
        $mongodb=static::$mongodb;
       $query= $mongodb->where(array('_id'=>parent::id($id)))
                       ->update('product_admin',array('active'=>1));
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
       $query= $mongodb->where(array('_id'=>parent::id($id)))
                       ->update('product_admin',array('active'=>0));
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
                        ->delete('product_admin');
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
                       ->update('product_admin',$data);
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
      
    }
     
    }
    
