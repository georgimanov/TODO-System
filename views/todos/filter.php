<!-- +++++ TODO FILTER +++++ -->

<section>
    <div class="container">
        <div class="categories text-center">
            <h4>Categories:

                        <span class="badge"><?php
                            $sum = 0;
                            foreach ($categories_list as $category) {
                                $sum += $category['count'];
                            }
                            echo $sum;
                            ?></span>
                <a href="<?php echo DX_URL . "todos/index";?>">All</a>

                <?php foreach( $categories_list as $category ): ?>

                    <span class="badge"><?php echo $category['count'];?></span>

                    <a href="<?php echo DX_URL . "todos/index?category=" . strtolower($category['name']);?>">
                        <?php echo htmlentities($category['name'], ENT_QUOTES);?>
                    </a>
                <?php endforeach;?>
            </h4>
        </div>
    </div>
</section>