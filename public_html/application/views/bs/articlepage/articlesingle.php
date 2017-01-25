<section id="singlepage">
    <div class="container">
        <div class="row">
            <h1><?php echo $result['article_heading']; ?></h1>
            <p class="by-author"><small>Author:  <?php echo $result['authorname'] ?>  Date : <?php echo $result['article_createdon'] ?></small></p>
        </div>
         <div class="row">
            <div class="col-md-12 col-lg-12">

                <div class="featured-article">
                    <div class="video-wrapper">
                        <div class="image-container">
                            <img src="<?php echo $result['imageurl']?>"/>


                        </div>
                        </div>
                   </div>
                
    </div>
             </div>  
             
             <div class='articlebottom'>
                 <div class="row">
                  <div class="col-md-9 col-lg-9">
                      <?php echo $result['article_content'] ?>
                  </div>
                 <div class="col-md-3 col-lg-3">
                   <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;"><strong>Related Articles</strong></div>
                    <div class="panel-body">
                        <div class="list-group list-cust">
                            <?php foreach ($related as $row) {
                                ?>
                                <a href="<?php echo base_url() . '/article/Articlehome/showArticle/' . $row['article_id'] ?>" class="list-group-item"><?php echo $row['article_heading']; ?></a>
                                <?php
                            }
                            ?>
                        </div> </div>
                </div>
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
this.page.url = "http://localhost/newapp/video/Videohome/playVideo/<?php echo $result['article_id'];?>";  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = "DreamVideo-<?php echo $result['article_id']; ?> ";// Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
    
