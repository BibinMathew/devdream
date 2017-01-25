<section id="singlepage">
    <div class="container">

        <div class="row">
            <h1><?php echo $videodetails[0]['video_header']; ?></h1>
            <p class="by-author"><small>published on <?php echo $videodetails[0]['created_on']; ?> </small></p>
        </div>
        <div class="row">
            <div class="col-md-7 col-lg-7">

                <div class="featured-article">
                    <div class="video-wrapper">
                        <div class="video-container">
                            <iframe  width="800" height="500" src="//www.youtube.com/embed/<?php echo $videodetails[0]['URL']?>?rel=0&amp;hd=1" frameborder="0" allowfullscreen></iframe>


                        </div>
                        <!-- /video -->
                        <div class="panel-footer">
                            <span class="pull-right">
                                <i style="padding-right:10px;"class="glyphicon glyphicon-eye-open"><div id="some" ><?php echo $videodetails[0]['viewcount']; ?></div></i>
                                <div class="likedislike" id ="<?php echo $videodetails[0]['video_id']; ?>">
                                    <i id="like1" class="glyphicon glyphicon-thumbs-up"></i> <div id="like1-bs3"><?php echo $videodetails[0]['likecount']; ?></div>
                                    <i id="dislike1" class="glyphicon glyphicon-thumbs-down"></i> <div id="dislike1-bs3"><?php echo $videodetails[0]['dislikecount']; ?></div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="share-button sharer" style="display: block;">
    <button type="button" class="btn btn-success share-btn">Share</button>
    <div class="social top center networks-5 ">
        <!-- Facebook Share Button -->
        <?php 
        $str = preg_replace('/[^A-Za-z]/', '', $videodetails[0]['video_description']);
        ?>
        <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=http://idreamias.com/video/Videohome/playVideo/<?php echo $videodetails[0]['video_id']; ?>&title='<?php echo $videodetails[0]['video_header']; ?>'&image='http://i3.ytimg.com/vi/<?php echo $videodetails[0]['URL']; ?>/default.jpg'&summary='<?php echo $str ?>' " ><i class="fa fa-facebook"></i></a> 
        
        <!-- Google Plus Share Button -->
        <a class="fbtn share gplus" href="https://plus.google.com/share?url=url"><i class="fa fa-google-plus"></i></a> 
        
      
    </div>
</div>
                    <!--div class="block-title">
                        <h2><?php echo $videodetails[0]['video_description']; ?></h2>
                        <p class="by-author"><small>By Jhon Doe</small></p>
                    </div-->
                </div>
                <!-- /.featured-article -->
            </div>
            <div class="col-md-5 col-lg-5">
                <ul class="media-list main-list">
                    <?php foreach ($relatedVideos as $row) {
                        ?>
                        <li class="media">
                            <a class="pull-left" href="<?php echo base_url() ?>/video/Videohome/playVideo/<?php echo $row['video_id']?>">
                                <img src='http://i3.ytimg.com/vi/<?php echo $row['URL']; ?>/default.jpg' alt='<?php echo $row['video_header']; ?>' class="img-responsive" height="150px" />
                                <!--img class="media-object" src="http://placehold.it/150x90" alt="..."-->
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $row['video_header']; ?></h4>
                                <p class="by-author">published on <?php echo $videodetails[0]['created_on']; ?></p>
                            </div>
                        </li>
                        <?php
                    }
                    ?>

                    <!--li class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/150x90" alt="...">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                            <p class="by-author">By Jhon Doe</p>
                        </div>
                    </li>
                    <li class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/150x90" alt="...">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                            <p class="by-author">By Jhon Doe</p>
                        </div>
                    </li-->
                </ul>
            </div>
            <div class="col-md-9 col-lg-9">
                <?php echo $videodetails[0]['video_description']; ?>
            </div>

            <div class="col-md-3 col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;"><strong>Most Viewed Videos</strong></div>
                    <div class="panel-body">
                        <div class="list-group list-cust">
                            <?php foreach ($mostviewed as $row) {
                                ?>
                                <a href="<?php echo base_url() . '/video/Videohome/playVideo/' . $row['video_id'] ?>" class="list-group-item"><?php echo $row['video_header']; ?></a>
                                <?php
                            }
                            ?>
                        </div> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-lg-9">
                <div id="disqus_thread"></div>
            </div>
        </div>
    </div>

</section>

<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/**/
/*
var disqus_config = function () {
this.page.url = "http://localhost/newapp/video/Videohome/playVideo/<?php echo $videodetails[0]['video_id']?>";  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = "DreamVideo-<?php echo $videodetails[0]['video_id']; ?> ";// Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '//idreamias.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    
