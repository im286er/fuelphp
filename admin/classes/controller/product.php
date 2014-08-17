<?php
namespace Admin;
use Admin\Model\Category;
use Admin\Model\Product;
class Controller_Product extends \Controller_Template
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
        $total = Product::count();
        $config = array(
            'pagination_url' => \Uri::base() . 'admin/product/index/',
            'total_items' => $total,
            'per_page' => 1,
            'uri_segment' => 4,

            );
        $pagination = \Pagination::forge('mypagination', $config);
        $data['product'] = Product::getpage($pagination->per_page, $pagination->offset);
        if (\Input::is_ajax()) {
            return \Response::forge(\View::forge('admin::product/pjax', $data));
        } else {
            $this->template->title = 'Trang Product';
            $this->template->content = \View::forge('admin::product/index', $data);
        }


    }
    public function action_add()
    {
        $data['category'] = Category::getall();
        $this->template->title = 'Trang Add Thuộc Tính Product';
        $this->template->content = \View::forge('admin::product/add', $data);


    }
    public function post_actionadd()
    {
        if (\Input::is_ajax()) {
            $data_key = array();
            $numbkey = trim(\Input::post('numbkey'));

            if (is_numeric($numbkey)) {
                $status = '';
                for ($i = 1; $i < $numbkey + 1; $i++) {
                    $key = trim(\Input::post("key{$i}"));
                    $value = trim(\Input::post("value{$i}"));
                    $data_key[] = array($key => $value);
                }
                $name_product = trim(\Input::post('product'));
                $note = trim(\Input::post('note'));
                $category = trim(\Input::post('category'));
                $data = array(
                    'nameproduct' => $name_product,
                    'id_category' => $category,
                    'note' => $note,
                    'keyvalue' => $data_key,
                    'active' => 0,


                    );
                $check = Product::checkname($name_product);
                if ($check == false) {
                    $query = Product::insert($data);
                    if ($query) {
                        $status = 'success';
                        echo json_encode(array('status' => $status));

                    } else {
                        $status = 'false';
                        echo json_encode(array('status' => $status));
                    }
                } else {
                    $status = 'false';
                    echo json_encode(array('status' => $status));

                }


            }


        }

    }
    public function action_edit($id)
    {
        $data['category'] = Category::getall();
        $data['product'] = Product::get($id);

        if ($data) {
            $this->template->title = 'Trang Edit Product ';
            $this->template->content = \View::forge('admin::product/edit', $data);

        } else {

        }


    }
    public function post_actionedit($id)
    {

        if (\Input::is_ajax()) {
            $data_key = array();
            $numbkey = trim(\Input::post('numbkey'));

            if (is_numeric($numbkey)) {
                $status = '';
                for ($i = 1; $i < $numbkey + 1; $i++) {
                    $key = trim(\Input::post("key{$i}"));
                    $value = trim(\Input::post("value{$i}"));
                    $data_key[] = array($key => $value);
                }
                $name_product = trim(\Input::post('product'));
                $note = trim(\Input::post('note'));
                $category = trim(\Input::post('category'));
                $data = array(
                    'nameproduct' => $name_product,
                    'id_category' => $category,
                    'note' => $note,
                    'keyvalue' => $data_key,
                    );

                $query = Product::updateedit($id, $data);
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
    public function post_active($id)
    {
        if (\Input::is_ajax()) {
            $update = Product::active($id);
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
            $update = Product::unactive($id);
            if ($update) {
                $status = 'success';
                echo json_encode(array('status' => $status));
            } else {
                $status = 'false';
                echo json_encode(array('status' => $status));
            }
        }


    }


}
