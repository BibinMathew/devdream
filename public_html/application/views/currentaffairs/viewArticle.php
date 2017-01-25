<div class="uk-grid">
    <div class="uk-width-8-10 ">
  
<article class="uk-article">
    <h1 class="uk-article-title"><?php echo $results[0]['currentaff_header'] ?></h1>
    <?php
       $date = date_create($results[0]['currentaff_date']);
     ?>
    <p class="uk-article-meta">Author:  <?php echo $results[0]['authorname'] ?>  Date : <?php echo date_format($date, ' l jS F Y'); ?></p>
    <div class="imagelead">
        <img src=<?php echo base_url();?>assets/uploads/files/<?php echo $results[0]['imageurl'] ;?> ></img>
    </div>
    <div class="articledata"><?php echo $results[0]['currentaff_text'] ?> </div>
</article>
<div id="disqus_thread"></div>
    </div>
</div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/**/
/*
var disqus_config = function () {
this.page.url = "http://localhost/dreamon/currentaff/Currhome/viewarticle/<?php echo $results[0]['currentaff_id']; ?>";  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = "DreamCurrentAffairs-<?php echo $results[0]['currentaff_id']; ?> ";// Replace PAGE_IDENTIFIER with your page's unique identifier variable
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