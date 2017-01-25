<div class="col-md-9">
    <div id="videocontainer">
        <section class="wrapper">
  <h1>Latest Uploads</h1>
  <div class="clr"></div>
    <ul id="videos" class="video">
       <?php foreach($videos as $video){
       ?>    
   <li class='video'><a href='http://localhost/dreamon/video/VideoHome/playVideo/<?php echo $video['video_id'] ;?>' id='tab1'><img src='http://i3.ytimg.com/vi/<?php echo $video['URL'];?>/default.jpg' height='100' width='200'/></a><h3><?php echo $video['video_header'];?></h3><p><?php echo $video['video_description'];?></p></li>
   <?php
       }
       ?>
    </ul>
  
</section>
    </div>
</div>