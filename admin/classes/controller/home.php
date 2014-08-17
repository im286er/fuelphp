<?php
namespace Admin;
class Controller_Home extends \Controller_Template
{
    public $template = 'admin::layout/layout';
    public function before()
    {
        if (\Session::get('user') != '' and \Session::get('isadmin') != '') {
            if (\Session::get('isadmin') != 0) {

                return \Response::redirect('admin/login');

            }


        } else {
            return \Response::redirect('admin/login');
        }
        parent::before();

    }

    public function action_index()
    {

        $this->template->title = 'Trang Quan tri';
        $this->template->content = \View::forge('admin::home/home');

    }


}
