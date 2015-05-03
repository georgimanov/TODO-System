<!-- +++++ Comment Edit Section +++++ -->

<div id="white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 centered">
                <h3>Edit Comment <a href="<?php echo DX_URL . 'comments/todo/' . $element['todo_id'];?>" >#back</a> </h3>
                <hr>
                <i class="alert-info">
                    <?php echo !empty ($message) ? $message  : "" ; ?>
                </i>
            </div>
            <div class="col-lg-8 col-lg-offset-2">
                <form role="form" method="post">

                    <textarea name="content"  placeholder="" class="form-control" rows="6"  required="required" ><?php echo $element['content']; ?></textarea>

                    <input name="id" value=" <?php echo $element['id']; ?>" type="hidden">

                    <br>
                    <button type="submit" class="btn btn-success">EDIT</button>
                </form>
            </div>
        </div>
    </div>
</div>