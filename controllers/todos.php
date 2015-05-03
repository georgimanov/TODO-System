<?php

namespace Controllers;

class Todos_Controller extends Master_Controller {

    public function __construct() {
        parent::__construct( get_class(),
            'todo', '/views/todos/' );

        include  DX_ROOT_DIR . '/models/category.php';
        include  DX_ROOT_DIR . '/models/comment.php';
        include  DX_ROOT_DIR . '/models/user.php';
    }

    public function index() {

        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL );
            exit;
        }

        $todos = '';
        if ( !empty ( $_GET["category"] ) ) {
            $category_name = $_GET["category"];
            $todos = $this->model->get_todos_by_criteria( $category_name );
        } else {
            $todos = $this->model->get_todos_by_criteria ( );
        }

        $categories_list  = $this->model->get_categories_count();

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    // TODO: Auth
    public function add( ) {

        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        $categories_list = $this->model->get_all_categories();

        if( ! empty( $_POST['title'] ) && ! empty( $_POST['user_id'] )  && ! empty( $_POST['category_id'] )  && ! empty( $_POST['description'] ) ) {
            $title = $_POST['title'];
            $category_id = $_POST['category_id'];
            $description = trim($_POST['description'], " ");

            $todo = array(
                'title' => $title,
                'category_id' => $category_id,
                'user_id' => 6,
                'description' => $description,
            );

            $result = $this->model->add( $todo );

            if( $result > 0){
                $this->index();
            } else {
                $message = 'An error has occurred!';
            }
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    // TODO: Auth!
    public function edit( $id )
    {
        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        $todos = $this->model->get($id);
        if( empty( $todos) ){
            $this->sorry( "TODO was not found!" );
            exit;
        }

        if( ! empty( $_POST['id'] ) && ! empty( $_POST['title'] ) && ! empty( $_POST['category_id'] )  && ! empty( $_POST['description'] ) && ! empty( $_POST['date_published'] ) ) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $date_published = $_POST['date_published'];

            $todo = array(
                'id' => $id,
                'title' => $title,
                'category_id' => $category_id,
                'description' => $description,
                'date_published' => $date_published
            );

            $result = $this->model->update( $todo );

            if($result > 0){
                $todo = $this->model->get($id);
                $todo = $todo[0];
                $message = 'Successfully edited todo!';
            } else {
                $message = 'An error has occurred!';
            }
        }

        $todo = $todos[0];
        $user = $this->model->get_user( $todo['user_id'] );
        $categories_list = $this->model->get_all_categories();

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }


    // TODO: Auth!
    public function delete ( $id ){

        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        $todos = $this->model->get($id);

        if( ! empty( $_POST['id'] ) ) {
            $result = $this->model->delete($id);

            if($result > 0){
                $this->index();
            } else if ($result == -1) {
                $message = 'Deleting TODO with comments is not allowed! <br/>
                                    You should delete the comments first!';
            }else {
                $message = 'An error has occurred!';
            }
        }

        if( empty( $todos) ){
            $this->sorry( "TODO was not found!" );
            exit;
        }

        $todo = $todos[0];

        $user = $this->model->get_user( $todo['user_id'] );
        $categories_list = $this->model->get_all_categories();

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }
}