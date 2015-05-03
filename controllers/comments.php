<?php

namespace Controllers;

use Lib\Verify;

class Comments_Controller extends Master_Controller {

    public function __construct() {
        parent::__construct(get_class(),
            'comment', '/views/comments/');
    }

    public function index()
    {
        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        header("Location: ". DX_URL . 'todos/index');
    }

    // List all comments for the following TODO
    public function todo ( $id )
    {
        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        include  DX_ROOT_DIR . 'models/todo.php';
        $todo_model = new \Models\Todo_Model();
        $todo = $todo_model->get($id)[0];

        if( empty ( $todo ) ){
            $this->sorry("TODO Not found!");
        }

        include  DX_ROOT_DIR . 'models/user.php';
        $user_model = new \Models\User_Model();
        $user = $user_model->get($todo['user_id']);

        $comments = $this->model->get_comments( $id );

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function add( $todo_id )
    {
        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        if( ! empty( $_POST['content'] ) && ! empty( $_POST['user_id'] ) ) {
            $name = $_POST['name'];
            $content = $_POST['content'];
            $user_id = $_POST['user_id'];

            $comment = array(
                'content' => $content,
                'todo_id' => $todo_id,
                'user_id' => $user_id
            );

            $this->model->add( $comment );

            header("Location: ". DX_URL. "comments/todo/" . $todo_id);
            exit;
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function edit( $id )
    {
        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        if( ! empty( $_POST['id'] ) &&
            ! empty ($_POST['content'])
             ) {

            $id = $_POST['id'];
            $content = $_POST['content'];

            $comment = array(
                'id' => $id,
                'content' => $content,
            );

            $result = $this->model->update( $comment );

            if($result > 0){
                $element = $this->model->get($id);
                $message = $this->message['successful_edit'];
            } else {
                $message = $this->message['error'];
            }
        }

        $element = $element[0];

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function deleteall ( $id ){

        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        $result = $this->model->delete_comments_by_todo_id( $id );

        if($result >= 0 ){
            header("Location: " . DX_URL . 'comments/todo/'.$id);
            exit;
        } else {
            $message = "An error has occurred!";
        }
    }

    public function delete( $id )
    {
        $auth = \Lib\Auth::get_instance();
        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        $element = $this->model->get( $id );

        if( empty( $element ) ){
            $this->todo( $element['todo_id'] );
            exit;
        }

        $element = $element[0];

        if( !empty ($_POST['id']) ) {
            $id = $_POST['id'];

            $result = $this->model->delete( $id );

            if($result > 0){
                $message = 'Successfully deleted!';
            } else {
                $message = 'An error has occurred!';
            }
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

}
