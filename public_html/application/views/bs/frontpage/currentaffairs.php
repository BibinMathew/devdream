<section id="currentaffairs">
    <div class="container">
        <h2 class="title">Latest Current Affairs</h2>
        <a class="more" href="#">more</a>
        <div class="listarticle">
            <div class="row">
            <?php
            foreach ($articles as $article) {
               
                $imageUrl ="";
                $src = base_url() . 'assets/uploads/files/' . $article['imageurl'] . '_thump.jpg';
                if (@getimagesize($src)) {
                    $imageUrl = base_url() . 'assets/uploads/files/' . $article['imageurl'] . '_thump.jpg';
                } else {

                    $imageUrl = base_url() . 'images/frontpage/articledefault.jpg';
                }
                $string = strip_tags($article['currentaff_text']);
                if (strlen($string) > 200) {
                    $stringCut = substr($string, 0, 200);
                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a class="btn btn-primary" role="button" href=' . base_url() . '/currentaff/Currhome/viewarticle/' . $article['currentaff_id'] . '">Read More</a>';
                }
                ?>
             <article class="col-md-3">
                        <div class="thumbnail">
                        <img alt="<?php echo $article['currentaff_header']; ?>" src="<?php echo $imageUrl; ?>">
                        <div class="caption">
                            <h3><?php echo $article['currentaff_header']; ?></h3>
                            <p><?php echo $string ?></p>
                            
                        </div>
                    </div>
                        </article>
                

                <?php }
            ?>
            </div>
        </div>               
    </div>

</section>


