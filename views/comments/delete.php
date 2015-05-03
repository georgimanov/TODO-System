<!-- +++++ Comment Delete Section +++++ -->

<div id="white">
    <div class="container">
        <div class="row">


            <div class="col-lg-8 col-lg-offset-2 centered">
                <h3>Delete Comment <a href="<?php echo DX_URL . 'comments/todo/' . $element['todo_id'];?>" >#back</a> </h3>
                <hr>
                <i class="alert-info">
                    <?php echo !empty ($message) ? $message  : "" ; ?>
                </i>
            </div>


            <div class="col-lg-8 col-lg-offset-2">
                <form role="form" method="post">
                    <div class="form-group">
                    <input type="text" value="<?php echo $element['date_published'];?>" readonly>
                        </div>
                    <div class="form-group">
                    <textarea name="content"  placeholder=" " class="form-control" rows="6"  required="required" readonly><?php echo htmlentities($element['content']); ?></textarea>
                        </div>
                    <button type="submit" class="btn btn-success">DELETE</button>
                    <input name="id" value=" <?php echo htmlentities($element['id']); ?>" type="hidden">

                </form>
            </div>
        </div>
    </div>
</div>