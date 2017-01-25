<div class="col-md-9">
    
        <div id="allarticles">

            <h2 class="title">Latest Articles</h2>
            
           <div class="listarticle">
               <div class="row">
                <?php foreach ($latest as $row) {
                    ?>
                    <article class="col-md-4">
                        <div class="thumbnail">
                        <img alt="..." src='<?php echo $row['imageurl'] ?>'>
                        <div class="caption">
                            <h3><?php echo $row['article_heading']; ?></h3>
                            <p><?php echo $row['article_content'] ?></p>
                            
                        </div>
                    </div>
                        </article>
                    <!--figure class="col-lg-12">
                        <a href=""><img class="img img-responsive article-img" src='<?php echo $row['imageurl'] ?>'></a>
                        <figcaption class="article-caption"><span class="article-title"><a href=""><?php echo $row['article_heading']; ?></a></span>
                        </figcaption>
                    </figure>

                    <div class="article-intro col-lg-12" style="padding-top: 10px;">
                        <strong><?php echo $row['article_content'] ?></strong>
                    </div-->
                
                    <?php
                }
                ?>
                   </div> 
                    <?php
                if (isset($top)) {
                foreach ($top as $key => $value) {
                    ?>
                   <div class="row">
                    <h2 class="title"><?php echo $key; ?> Articles</h2>
                  
                   
                        <?php foreach ($value as $row) {
                            ?>
                          <article class="col-md-4">
                              <div class="thumbnail">
                                 <img alt="..." src='<?php echo $row['imageurl'] ?>'>
                                 <div class="caption">
                                 <h3><?php echo $row['article_heading']; ?></h3>
                                 <p><?php echo $row['article_content']; ?></p>
                            
                        </div>
                    </div>
                        </article>

                            <?php
                         
                        }
                   ?>
                   </div>
                    <?php
                }
            }
            ?>
            </div>

            
    
</div>
</div>
</section>