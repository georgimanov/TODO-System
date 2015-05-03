<!-- +++++ Comment Add Section +++++ -->

<div id="white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 centered">
                <h3>Add Comment <a href="<?php echo DX_URL . 'comments/todo/' . $todo_id;?>" >#back</a> </h3>
                <hr>
                <i class="alert-info">
                    <?php echo !empty ($message) ? $message  : "" ; ?>
                </i>
            </div>

            <div class="col-lg-8 col-lg-offset-2">
                <form role="form" method="post">

                    <textarea name="content"  placeholder="" class="form-control" rows="6"  required="required" ></textarea>

                    <br>
                    <input type="hidden" name="user_id" value="<?php echo ($this->logged_user['id']);?>" >
                    <button type="submit" class="btn btn-success">ADD</button>
                </form>
            </div>
        </div>
    </div>
</div>