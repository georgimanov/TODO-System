<?php

namespace Models;

class Comment_Model extends Master_Model {

    public function __construct( $args = array() ) {
        parent::__construct( array( 'table' => 'comments' ) );
    }

    public function delete_comments_by_todo_id( $todo_id ){
        $query = "DELETE FROM {$this->table}
                    WHERE todo_id=$todo_id";

        $this->db->query( $query );

        return $this->db->affected_rows;
    }

    public function get_comments ( $id ) {
        $query = "SELECT c.id, c.content, c.date_published, u.id AS user_id, u.username
                    FROM comments as c
                    LEFT JOIN todos as t ON t.id = c.todo_id
                    LEFT JOIN users AS u ON c.user_id = u.id";

        if ( ! empty ($id) ){
            $query .= " WHERE t.id=".$id;
        }


        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );


        return $results;
    }
}