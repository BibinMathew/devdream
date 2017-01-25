       	 <div class="uk-grid" style="margin-top: 10px;" data-uk-grid-margin>
                <div class="uk-width-medium-1-1">

                  <div class="uk-vertical-align uk-text-center" style="background: url('images/background1.jpg') 50% 0 no-repeat; height: 600px">
                    <div class="uk-vertical-align-middle uk-width-1-2">
                            <h1 class="uk-heading-large" style="color: white; font-family: 'Montserrat', sans-serif;">I Dream IAS</h1>
                            <p class="uk-text-large"  style="color: white;font-family: 'Karla', sans-serif;">The most comprehensive library for Civil Services Preparation.</p>
                            <p>
                                <a id = 'startnow' class="uk-button uk-button-primary uk-button-large " href="#">Start Today</a>
                               
                            </p>
                        </div>
                  </div>
                </div>
                </div>

                 <div class="components" >
                 <h2 class="title">Latest Video Tutorials</h2>
                 <a class="more" href="#">more</a>
                 <div class="uk-grid" data-uk-grid-margin style="padding:10px;">
                   <ul>
       <?php foreach($videos as $video){
       ?>
        <li >  <div class="uk-thumbnail " style="text-align:center">
                <img src='http://i3.ytimg.com/vi/<?php echo $video['URL'];?>/default.jpg' alt='<?php echo $video['video_header'];?>' align="middle" >
              <div class="uk-thumbnail-caption" style="font-family: 'bebasregular';font-size: 16px;"><?php echo $video['video_header'];?></div>
           </div>
        </li>
        <?php
       }
       ?>
    </ul>
                 </div>

            <div class="components" >
            <h2 class="title">Latest Articles</h2>
                 <a class="more" href="#">more</a>
                 <div class="uk-grid" data-uk-grid-margin style="padding:10px;">
                   <ul>
       <?php foreach($articles as $article){
       ?>
        <li >  <div class="uk-thumbnail ">
                <?php 
                   $src =base_url().'assets/uploads/files/'.$article['imageurl'].'_thump.jpg';
                    if (@getimagesize($src)) {
                        $imageUrl = base_url().'assets/uploads/files/'.$article['imageurl'].'_thump.jpg';
                    
                } else{
                   
                     $imageUrl = base_url().'images/frontpage/articledefault.jpg';
                }?>
                
                <img src="<?php echo $imageUrl?>" alt='<?php echo $article['currentaff_header'];?>' align="middle" style='padding: 0px;'>
              <div class="uk-thumbnail-caption" style="font-family: 'bebasregular';font-size: 16px;"><?php echo $article['currentaff_header'];?></div>
           </div>
        </li>
        <?php
       }
       ?>
    </ul>
                 </div>
            </div>