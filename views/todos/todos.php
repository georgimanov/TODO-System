<!-- +++++ Todos Admin Section +++++ -->

<div class="container">
    <div class="row">
        <h2 class="centered">List of TODOs</h2>
        <hr>
        <h3><a href="<?php echo DX_URL. "todos/add" ;?>" class="btn btn-primary">Add new TODO</a> </h3>
        <div class="table-responsive">
            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Category</th>
                    <th>Date published</th>
                    <th>Title</th>
                    <th>Comments</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($todos as $todo): ?>

                    <tr>
                        <td>
                            <?php echo $todo['id']; ?>
                        </td>
                        <td>
                            <?php echo htmlentities($todo['username']); ?>
                        </td>
                        <td>
                            <?php echo htmlentities($todo['name']); ?>
                        </td>
                        <td>
                            <?php echo $todo['date_published']; ?>
                        </td>
                        <td>
                            <details>
                                <summary><?php echo htmlentities($todo['title']); ?></summary>
                                <p>
                                    <?php echo htmlentities(substr($todo['description'],0,250)) . "..."; ?>

                                </p>
                            </details>

                        </td>

                        <td>
                            <a href="<?php echo DX_URL . 'comments/todo/' . $todo['id'];?>" class="btn btn-info">Comments
                            <?php echo "[" . $todo['comments_count'] . "]"; ?></a>
                        </td>
                        <td>
                            <a href="<?php echo DX_URL . 'todos/edit/' . $todo['id'];?>" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <a href="<?php echo DX_URL . 'todos/delete/' . $todo['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>