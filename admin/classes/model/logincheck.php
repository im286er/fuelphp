<?php
namespace Admin\Model;
class Logincheck extends \Model
{
   public static  $client;
   public static function _init(){
    static::$client=new \Guzzle\Client;
       
   }   
   public static function check($username){
        /*$curl = \Request::forge('http://localhost:5000/admin/login', 'curl');
        $curl->http_login('tuanlinh', 'tuanlinh', 'BASIC');
        $curl->set_method('post');
        $curl->add_param(array('username' =>$username));
    
        $curl->set_mime_type('json');
        $curl->execute();
        $response=$curl->respon*/
        //$result=static::$client->post('/admin/login',array('username'=>$username));
        $result=static::$client->creater_url('/admin/login')
                        ->setmethod('POST')
                        ->adddata(array('username'=>$username))
                        ->setreponse('json')
                        ->run()->get();              
        return $result;
    
   }
    
}
