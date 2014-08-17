<?php
namespace Admin;
use Admin\Model\Category;
class Controller_Category extends \Controller_Template
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
        $total = Category::count();
        $config = array(
            'pagination_url' => \Uri::base() . 'admin/category/index/',
            'total_items' => $total['data'],
            'per_page' => 2,
            'uri_segment' => 4,

            );
            
        $pagination = \Pagination::forge('mypagination', $config);

        $category = Category::show($pagination->per_page, $pagination->offset);
       
        $data['category']=json_decode($category['data'],true);
        
        if (\Input::is_ajax()) {
            return \Response::forge(\View::forge('admin::category/pjax', $data));
        } else {
            $this->template->title = 'Trang thông tin category';
            $this->template->content = \View::forge('admin::category/index', $data);

        }


    }
    public function action_add()
    {
        $this->template->title = 'Tạo Category ';
        $this->template->content = \View::forge('admin::category/addcategory');

    }

    public function post_actionadd()
    {
        if (\Input::is_ajax()) {
            $name_category = trim(\Input::post('name_category'));
            $note = trim(\Input::post('note'));
            $check = Category::checkname($name_category);
            if ($check == true) {
                $data = array('name_category' => $name_category, 'note' => $note);
                $insert = Category::insert($data);
                if ($insert) {
                    $status = 'success';
                    echo json_encode(array('status' => $status));

                } else {
                    $status = 'errors 500';
                    echo json_encode(array('status' => $status));

                }

            } else {
                $status = 'false';
                echo json_encode(array('status' => $status));

            }

        }

    }
    public function post_active($id)
    {
        if (\Input::is_ajax()) {
            $update = Category::active($id);
            if ($update) {
                $status = 'success';
                echo json_encode(array('status' => $status));
            } else {
                $status = 'false';
                echo json_encode(array('status' => $status));
            }
        }

    }
    public function post_unactive($id)
    {

        if (\Input::is_ajax()) {
            $update = Category::unactive($id);
            if ($update) {
                $status = 'success';
                echo json_encode(array('status' => $status));
            } else {
                $status = 'false';
                echo json_encode(array('status' => $status));
            }
        }


    }
    public function action_edit($id)
    {
        
        $category = Category::get((string)$id);
        $data['category']=json_decode($category['data'],true);

        if ($data) {
            $this->template->title = 'Trang Edit Category ';
            $this->template->content = \View::forge('admin::category/edit', $data);

        } else {

        }


    }
    public function post_actionedit($id)
    {
        if (\Input::is_ajax()) {
            $namecategory = trim(\Input::post('name_category'));
            $note = trim(\Input::post('note'));
            $data = array('name_category' => $namecategory, 'note' => $note,'id'=>$id);
            $query = Category::updateedit($data);
            if ($query) {
                $status = 'success';
                echo json_encode(array('status' => $status));
            } else {
                $status = 'false';
                echo json_encode(array('status' => $status));
            }
        }

    }
    public function post_delete($id)
    {

        if (\Input::is_ajax()) {
            $query = Category::delete($id);
            $status = '';
            if ($query) {
                $status = 'success';
                echo json_encode(array('status' => $status));
            } else {
                $status = 'false';
                echo json_encode(array('status' => $status));
            }


        }


    }


}
