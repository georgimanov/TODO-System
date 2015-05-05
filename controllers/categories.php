z<?php

namespace Controllers;

class Categories_Controller extends Master_Controller {

    protected $message;
    protected $auth;

    public function __construct() {
        parent::__construct(get_class(),
            'category', '/views/categories/');

        $this->message = "";
        $auth = \Lib\Auth::get_instance();
        $auth->authorize_admin();
    }

    public function index()
    {
        $categories = $this->model->find();

        if( empty( $categories ) ){
            $this->sorry("No categories were found!");
            exit;
        }

        $this->message = '';

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function add()
    {
        if( ! empty( $_POST['name'] ) ) {
            $name = $_POST['name'];

            $category = array(
                'name' => $name,
            );

            $result = $this->model->add( $category );

            if($result > 0){
                $this->message = 'Successfully added category';

            } else {
                $this->message = 'An error has occurred!';
            }

        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function edit($id)
    {
        $element = $this->model->get($id);
        $element = $element[0];

        if( empty( $element ) ){
            $this->sorry("Category was not found!");
            exit;
        }

        if( ! empty( $_POST['name'] ) && !empty ($_POST['id']) ) {
            $name = $_POST['name'];
            $id = $_POST['id'];

            $category = array(
                'id' => $id,
                'name' => $name,
            );

            $result = $this->model->update( $category );

            if($result > 0){
                $element = $this->model->get($id);
                $element = $element[0];
                $this->message = 'Successfully edited category';
            } else {
                $this->message = 'An error has occurred!';
            }

        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function delete($id)
    {
        $element = $this->model->get($id);

        if( empty( $element ) ){
            $this->sorry("Category was not found!");
            exit;
        }

        $element = $element[0];


        if( ! empty( $_POST['name'] ) && !empty ($_POST['id']) ) {
            $name = $_POST['name'];
            $id = $_POST['id'];

            $result = $this->model->delete( $id );

            if($result > 0){
                $this->index();
            } else {
                $this->message = 'An error has occurred!';
            }

        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }
}
