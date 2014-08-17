<?php
namespace Admin\Model;
class Category extends \Model
{
    
    public static  $client;
    public static  function _init()
    {
        static::$client=new \Guzzle\Client;
    }
    public static function checkname($namecategory)
    {
      $result=static::$client->creater_url('/category/check_avb')
                        ->setmethod('POST')
                        ->adddata(array('name_category'=>$namecategory))
                        ->setreponse('json')
                        ->run()->get();      
        return $result;
    }
    public static function insert($data)
    {
      $result=static::$client->creater_url('/category/insert')
                        ->setmethod('POST')
                        ->adddata($data)
                        ->setreponse('json')
                        ->run()->get();      
        return $result;
        
    }
    public static function count()
    {
        $result=static::$client->creater_url('/category/count')
                        ->setmethod('POST')
                        ->setreponse('json')
                        ->run()->get();   
        return $result;
        
    }
    public static function show($limit,$offset)
    {
        
         $result=static::$client->creater_url('/category/show')
                        ->setmethod('POST')
                        ->adddata(array('limit'=>(int)$limit,'offset'=>(int)$offset))
                        ->setreponse('json')
                        ->run()->get();   
        return $result;
        
        
    }
    public static function get($id)
    {
        $result=static::$client->creater_url('/category/getid')
                        ->setmethod('GET')
                        ->adddata(array('id'=>$id))
                        ->setreponse('json')
                        ->run()->get();   
                        
    
                      return $result;
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
    public static function updateedit($data)
    {
        $result=static::$client->creater_url('/category/upadte')
                        ->setmethod('POST')
                        ->adddata($data)
                        ->setreponse('json')
                        ->run()->get();   
                        
    
                      return $result;
       
        if($result)
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
    }
    
    }