<section id="articles">
    <div class="container">
        <h2 class="title">Latest Articles</h2>
        <a class="more" href="<?php echo base_url().'/article/Articlehome' ?>">more</a>
        <div class="listarticle">

            <?php
            foreach ($articles as $article) {

                 $imageUrl ="";
                $src = base_url() . 'assets/uploads/files/' . $article['imageurl'] . '_thump.jpg';
                if (@getimagesize($src)) {
                    $imageUrl = base_url() . 'assets/uploads/files/' . $article['imageurl'] . '_thump.jpg';
                } else {

                    $imageUrl = base_url() . 'images/frontpage/articledefault.jpg';
                }
                $string = strip_tags($article['article_content']);
                if (strlen($string) > 200) {
                    $stringCut = substr($string, 0, 200);
                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a class="btn btn-primary" role="button" href=' . base_url() . '/article/Articlehome/showArticle/' . $article['article_id'] . '">Read More</a>';
                }
                ?>
                <article class="col-md-4">
                        <div class="thumbnail">
                        <img alt="<?php echo $article['article_heading']; ?>" src="<?php echo $imageUrl; ?>">
                        <div class="caption">
                            <h3><?php echo $article['article_heading']; ?></h3>
                            <p><?php echo $string ?></p>
                            
                        </div>
                    </div>
                        </article>
               

                <?php }
            ?>

        </div>               
    </div>

</section>


