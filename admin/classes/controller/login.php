<?php
namespace Admin;
use Admin\Model\Test2;
use Admin\Model\Logincheck;
class Controller_Login extends \Controller
{

    public function before()
    {

        if (\Session::get('user') != '' and \Session::get('isadmin') != '') {

            if (\Session::get('isadmin') == 0) {

                return \Response::redirect('admin/home/');

            }

        }
    }
    public function action_index()
    {

        return \Response::forge(\View::forge('Admin::login'));
    }
    public function action_checklogin()
    {


        if (\Input::is_ajax()) {
        
           
            $filters = array('strip_tags', 'htmlentities');
            $name = \Security::xss_clean(\Security::clean(\Input::post('user'), $filters));
            $password = \Security::xss_clean(\Security::clean(\Input::post('password'), $filters));
            $data_check = Logincheck::check($name);
            
            if($data_check['data']!=False){
                $data_check=json_decode($data_check['data'],true);
              
            if ($password == \Crypt::decode($data_check['password'])) {
                $status = 'success';
                $session_set = array(
                    'user' => $data_check['username'],
                    'isadmin' => $data_check['isadmin'],
                    'id' => (string)$data_check['_id']['$oid']);
                \Session::set($session_set);

                echo json_encode(array('status' => $status));
            } else {
                $status = 'false';
                echo json_encode(array('status' => $status));

            }
            }else{
                $status = 'false';
                echo json_encode(array('status' => $status));
                
            }
        }


    }
    public function action_creater()
    {
        /* $test='tuanlinh';
        $password =\Crypt::encode('tuanlinh');
        $text='U_ku2uHpIxWVTuIc3kARl0xDajVBN2RJU3BTdUNDb2hxYi1ZZWJqVmJBLTZ1dGtQeGROS1EzV0ROaVk';
        if($test=\Crypt::decode($password))
        {
        echo 'ok';
        }
        else
        {
        echo 'not ok';
        }
        echo '<br/>';
        echo $password;
        die();*/

        $password = \Crypt::encode('tuanlinh');
        $mongo = \Mongo_Db::instance();
        $insert_id = $mongo->insert('users', array(
            'username' => 'admincp',
            'active' => '1',
            'email' => 'dont.em@ilme.com',
            'isadmin' => '0',
            'password' => $password,
            'access' => 'full'));


    }


}
