<?php

namespace Models;

class Todo_Model extends Master_Model {

    public function __construct( $args = array() ) {
        parent::__construct( array( 'table' => 'todos' ) );
    }

    // USERS
    public function get_user($id){
        $user_model = new \Models\User_Model();
        $users = $user_model->get( $id );
        $user = $users[0];

        return $user;
    }

    public function get_todos_by_criteria( $category = null ) {

        $query = "SELECT t.id, t.title, t.description, t.date_published, categories.name, u.id AS user_id, u.username, count(comments.id) as 'comments_count'
                    FROM todos as t
                    LEFT JOIN categories ON t.category_id=categories.id
                    LEFT JOIN users AS u ON t.user_id = u.id
                    LEFT JOIN comments ON comments.todo_id = t.id";

        if( ! empty( $category ) ) {
            $query .= " WHERE categories.name='{$category}'";
        }

        $query .= " GROUP BY (t.id)";

        $query .= " ORDER BY t.date_published
                      DESC";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }

    public function get_categories_count(){
        $category_model = new \Models\Category_Model();
        $categories = $category_model->get_categories_with_todos_count();

        return $categories;
    }

    public function get_all_categories(){
        $category_model = new \Models\Category_Model();
        $categories = $category_model->find( );

        return $categories;
    }
}