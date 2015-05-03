<div class="container">
    <div class="row">
        <h2>List of comments for TODO: </h2>
        <hr>
        <div class="container">
            Id: <?php echo htmlentities($todo['id']); ?> <br>
            Title: <?php echo htmlentities($todo['title']); ?> <br>
            Description: <?php echo htmlentities($todo['description']); ?> <br>
            Publish: <?php echo htmlentities($todo['date_published']); ?> <br>
            User : <?php echo htmlentities($user[0]['username']) ;?> <br>
            <a href="<?php echo DX_URL . 'todos/index';?>" class="text-right">#back </a>
        </div>
        <hr>
        <h3><a href="<?php echo DX_URL. "comments/add/".$todo['id'] ;?>" class="btn btn-primary">Add new comment</a>
            <a href="<?php echo DX_URL. "comments/deleteall/".$todo['id'] ;?>" class="btn btn-danger">Delete All</a>
        </h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Content</th>
                    <th>Name</th>
                    <th>Date published</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($comments as $comment): ?>

                    <tr>
                        <td>
                            <?php echo $comment['id']; ?>
                        </td>
                        <td>
                            <?php echo htmlentities($comment['content']); ?>

                        </td>
                        <td>
                            <?php echo htmlentities($comment['username'])?>
                        </td>

                        <td>
                            <?php echo htmlentities($comment['date_published']); ?>
                        </td>

                        <td>
                            <a href="<?php echo DX_URL . 'comments/edit/' .$comment['id'];?>" class="btn btn-warning">edit</a>
                        </td>
                        <td>
                            <a href="<?php echo DX_URL . 'comments/delete/' .$comment['id'];?>" class="btn btn-danger" >delete</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>