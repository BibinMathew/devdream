<div class="uk-width-7-10">
    <!--ul id="videos" class="video">
       <?php foreach($videos as $video){
       ?>    
   <li class='video'><a href='http://idreamias.com/video/Videohome/playVideo/<?php echo $video['video_id'] ;?>' id='tab1'><img src='http://i3.ytimg.com/vi/<?php echo $video['URL'];?>/default.jpg' height='100' width='200'/></a><h3><?php echo $video['video_header'];?></h3><p><?php echo $video['video_description'];?></p></li>
   <?php
       }
       ?>
    </ul-->
    <h2 class="title">Latest Tutorials</h2>
    <a class="more" href="#">more</a>
    <ul style='padding-top: 10px;padding-right: 10px;'>
       <?php foreach($videos as $video){
       ?>
        <li style='display: inline-block;padding:10px; width:20%; '>  <div class="uk-thumbnail ">
                <img src='http://i3.ytimg.com/vi/<?php echo $video['URL'];?>/default.jpg' alt='<?php echo $video['video_header'];?>' align="middle" style='padding: 20px;'>
              <div class="uk-thumbnail-caption"><?php echo $video['video_header'];?></div>
           </div>
        </li>
        <?php
       }
       ?>
    </ul>
    
    <h2 class="title">History Tutorials</h2>
    <a class="more" href="#">more</a>
    <ul style='padding-top: 10px;padding-right: 10px;'>
       <?php foreach($videos as $video){
       ?>
        <li style='display: inline-block;padding:10px; width:20%; '>  <div class="uk-thumbnail ">
                <img src='http://i3.ytimg.com/vi/<?php echo $video['URL'];?>/default.jpg' alt='<?php echo $video['video_header'];?>' align="middle" style='padding: 20px;'>
              <div class="uk-thumbnail-caption"><?php echo $video['video_header'];?></div>
           </div>
        </li>
        <?php
       }
       ?>
    </ul>
    <h2 class="title">Geography Tutorials</h2>
    <a class="more" href="#">more</a>
    <ul style='padding-top: 10px;padding-right: 10px;'>
       <?php foreach($videos as $video){
       ?>
        <li style='display: inline-block;padding:10px; width:20%; '>  <div class="uk-thumbnail ">
                <img src='http://i3.ytimg.com/vi/<?php echo $video['URL'];?>/default.jpg' alt='<?php echo $video['video_header'];?>' align="middle" style='padding: 20px;'>
              <div class="uk-thumbnail-caption"><?php echo $video['video_header'];?></div>
           </div>
        </li>
        <?php
       }
       ?>
    </ul>
</div>
</div>
</div>

