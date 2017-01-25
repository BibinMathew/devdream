<h3 class="tm-article-subtitle">Search Results</h3>
<?php $imageUrl = base_url() . 'images/frontpage/articledefault.jpg';
?>

<div class=" search-results">
    <ul class="uk-tab" data-uk-tab>
        <li <?php if ($type=='N') { ?>class="uk-active" <?php } ?>><a href="<?php echo base_url() ?>search/SearchResults/allResults">All Results</a>
        <li  <?php if ($type=='V') { ?>class="uk-active" <?php } ?>><a href="<?php echo base_url() ?>/search/SearchResults/Videos">Videos</a></li>
        <li <?php if ($type=='A') { ?>class="uk-active" <?php } ?>><a href="<?php echo base_url() ?>search/SearchResults/Articles">Articles</a></li>
         <li <?php if ($type=='C') { ?>class="uk-active" <?php } ?>><a href="<?php echo base_url() ?>search/SearchResults/CurrentAffairs">Current Affairs</a></li>
    </ul>                 

    <?php
    foreach ($articles as $article) {
        ?>
        <article class="uk-grid">
            <div class="uk-width-1-3">
                <div class="uk-grid uk-grid-collapse margin-right">
                    <div class="uk-width-1-2"><div class="uk-panel uk-panel-box ">
                            <a href="#" title="Lorem ipsum" class="thumbnail">
                                <?php
                                if ($article->article_type == 'V') {
                                    ?>
                                    <img src='http://i3.ytimg.com/vi/<?php echo $article->URL; ?>/default.jpg' alt="Lorem ipsum" />
                                    <?php
                                } else {
                                     ?>
                                    <img src="<?php echo $article->image;?>" alt="<?php echo $article->article_header ?>" />
                                    <?php
                            }
                            ?>
                        </a></div></div>
                <div class="uk-width-1-2 " ><div class="uk-panel uk-panel-box "><ul class="meta-search">
                            <li><i class="uk-icon-calendar"></i> <span><?php echo $article->article_date; ?></span></li>

                            <li><i class="uk-icon-tags"></i>
                                <?php
                                if ($article->article_type == 'V') {
                                    ?>
                                <span>Video</span>
                                 <?php
                                } else {
                                    ?>
                                    <span>Article</span>
                                    <?php
                                } ?>
                        </li></ul>
                        </ul>    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-2-3"><div class="uk-panel">
                <h3><?php echo $article->article_header; ?></h3>
                <p><?php echo $article->article_description; ?>
                </p></div>
        </div>
    </article>
    
   <?php
    }
    ?>

</div>
</div>



</div>    