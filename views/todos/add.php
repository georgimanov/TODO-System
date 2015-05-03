<!-- +++++ TODO Add Section +++++ -->

<div class="container pt">
    <div class="row mt">
        <div class="col-lg-6 col-lg-offset-3 centered">
            <h3>Add new TODO <a href="<?php echo DX_URL . 'comments/todo/' . $element['todo_id']; ?>" >#back</a> </h3>
            <hr>
            <i class="alert-info">
                <?php echo !empty ($message) ? $message  : "" ; ?>
            </i>
        </div>
    </div>
    <div class="row mt">
        <div class="col-lg-8 col-lg-offset-2">
            <form role="form" method="post">
                <div class="form-group">
                    <input name="title" class="form-control" placeholder="Title" required="required">
                    <br>
                </div>

                <div class="form-group">
                    <select name="category_id"  class="form-control">
                        <?php foreach( $categories_list as $category ): ?>
                        <option class="form-control" value="<?php echo $category['id'];?>"><?php echo $category['name'];?>
                            <?php endforeach;?>
                    </select>
                    <br>
                </div>

                <textarea name="description" class="form-control" id="editor1" rows="6" placeholder="Enter your text here" required="required"></textarea>
                <br>
                <button type="submit" class="btn btn-success">SUBMIT</button>
                <input type="hidden" name="user_id" value="<?php echo $this->logged_user['id'];?>" >
            </form>
        </div>
    </div><!-- /row -->
</div><!-- /container -->

