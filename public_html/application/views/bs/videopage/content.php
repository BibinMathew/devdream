<div class="col-md-9">
    
        <div id="allvideos">

            <h2 class="title">Latest Video Tutorials</h2>
            <a class="more" href="#">more</a>
            <ul class="list-unstyled video-list-thumbs row">
                <?php foreach ($latest as $video) {
                    ?>
                    <li class="col-lg-3 col-sm-4 col-xs-6">
                        <a href="<?php echo base_url().'/video/Videohome/playVideo/'.$video['video_id']; ?>" title='<?php echo $video['video_header']; ?>'>
                            <img src='http://i3.ytimg.com/vi/<?php echo $video['URL']; ?>/default.jpg' alt='<?php echo $video['video_header']; ?>' class="img-responsive" height="130px" />
                            <h2><?php echo $video['video_header']; ?></h2>
                            <span class="glyphicon glyphicon-play-circle"></span>
                            <span class="duration">03:15</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <?php
            if (isset($top)) {
                foreach ($top as $key => $value) {
                    ?>
                    <h2 class="title"><?php echo $key; ?> Video Tutorials</h2>
                    <a class="more" href="#">more</a>
                    <ul class="list-unstyled video-list-thumbs row">
                        <?php foreach ($value as $video) {
                            ?>
                            <li class="col-lg-3 col-sm-4 col-xs-6">
                                <a href="<?php echo base_url().'/video/Videohome/playVideo/'.$video->video_id; ?>" title='<?php echo $video->video_header ?>'>
                                    <img src='http://i3.ytimg.com/vi/<?php echo $video->URL; ?>/default.jpg' alt='<?php echo $video->video_header ; ?>' class="img-responsive" height="130px" />
                                    <h2><?php echo $video->video_header; ?></h2>
                                    <span class="glyphicon glyphicon-play-circle"></span>
                                    <span class="duration">03:15</span>
                                </a>
                            </li>

                            <?php
                         
                        }
                        ?>
                    </ul>
                    <?php
                }
            }
            ?>
        </div>  
    
</div>
</div>
</section>