<div class="clear"> </div>
<div class="content">
    <div class="inner-page">
        <div class="searchbar">
					<div class="search-left">
						<p>Latest Video Form IdreamIAS</p>
					</div>
					<div class="search-right">
						<form>
							<input type="text"><input type="submit" value="" />
						</form>
					</div>
					<div class="clear"> </div>
				</div>
        <div class="title">
            <h3><?php echo $videodetails[0]['video_header']; ?></h3>
            <ul>
                <li><h4>By:</h4></li>
                <li><a href="#">Author</a></li>
                <li><a href="#"><img src="<?php echo base_url(); ?>images/sub.png" title="subscribe" />subscribe</a></li>
            </ul>
        </div>
        <div class="video-inner">
            <div class="videoWrapper">
                <!-- Copy & Pasted from YouTube -->
                <iframe width="560" height="349" src="http://www.youtube.com/embed/<?php echo $videodetails[0]['URL']; ?>?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="viwes">
            <div class="view-links">
                <ul>
                    <li><h4>Share on:</h4></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>images/f1.png" title="facebook" /></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>images/t1.png" title="Twitter" /></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>images/s1.png" title="Google+" /></a></li>
                </ul>
                <ul class="comment1">
                    <li><a href="#">Comment(1)</a></li>
                    <li><a href="#"><img src="images/re.png" title="report" /><span>Report</span></a></li>
                </ul>
            </div>
            <div class="views-count">
                <p><span>2,500</span> Views</p>
            </div>
            <div class="clear"> </div>
        </div>
        <div class="clear"> </div>
        <div class="video-details">
            <ul>
                <li><p>Uploaded on <a href="#">June 21, 2013</a> by <a href="#">Lorem</a></p></li>
                <li><span><?php echo $videodetails[0]['video_description']; ?></span></li>
            </ul>
            <ul class="other-links">
                <li><a href="#">youtube.com/videos-tube</a></li>
                <li><a href="#">facebook.com/videos-tube</a></li>
                <li><a href="#">Twitter.com/videos-tube</a></li>
            </ul>
        </div>
        <div class="clear"> </div>
        <div class="tags">
            <ul>
                <li><h3>Tags:</h3></li><?php foreach($videodetails['Tags'] as $tags){
                 ?>
                <li><a href=""><?php echo $tags ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div id="disqus_thread"></div>
                            
        
        <div class="clear"> </div>
        <div class="related-videos">
            <h6>Related-Videos</h6>
            <div class="grids">
                <div class="grid">
                    <h3>Consectetur adipisicing elit</h3>
                    <a href="#"><img src="<?php echo base_url(); ?>images/g3.jpg" title="video-name"></a>
                    <div class="time">
                        <span>2:30</span>
                    </div>
                    <div class="grid-info">
                        <div class="video-share">
                            <ul>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/likes.png" title="links"></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/link.png" title="Link"></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/views.png" title="Views"></a></li>
                            </ul>
                        </div>
                        <div class="video-watch">
                            <a href="#">Watch Now</a>
                        </div>
                        <div class="clear"> </div>
                        <div class="lables">
                            <p>Labels:<a href="#">Lorem</a></p>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <h3>Consectetur adipisicing elit</h3>
                    <a href="#"><img src="<?php echo base_url(); ?>images/g5.jpg" title="video-name"></a>
                    <div class="time">
                        <span>5:10</span>
                    </div>
                    <div class="grid-info">
                        <div class="video-share">
                            <ul>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/likes.png" title="links"></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/link.png" title="Link"></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/views.png" title="Views"></a></li>
                            </ul>
                        </div>
                        <div class="video-watch">
                            <a href="#">Watch Now</a>
                        </div>
                        <div class="clear"> </div>
                        <div class="lables">
                            <p>Labels:<a href="#">Lorem</a></p>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <h3>Consectetur adipisicing elit</h3>
                    <a href="#"><img src="<?php echo base_url(); ?>images/g4.jpg" title="video-name"></a>
                    <div class="time">
                        <span>2:00</span>
                    </div>
                    <div class="grid-info">
                        <div class="video-share">
                            <ul>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/likes.png" title="links"></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/link.png" title="Link"></a></li>
                                <li><a href="#"><img src="<?php echo base_url(); ?>images/views.png" title="Views"></a></li>
                            </ul>
                        </div>
                        <div class="video-watch">
                            <a href="#">Watch Now</a>
                        </div>
                        <div class="clear"> </div>
                        <div class="lables">
                            <p>Labels:<a href="#">Lorem</a></p>
                        </div>
                    </div>
                    <div id="disqus_thread"></div>
                </div>
            </div>
        </div>
        <div class="clear"> </div>
    </div>


</div>
</div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/**/
/*
var disqus_config = function () {
this.page.url = "http://idreamias.com/video/Videohome/playVideo/<?php echo $videodetails[0]['video_id']?>";  // Replace PAGE_URL with your page's canonical URL variable
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
    