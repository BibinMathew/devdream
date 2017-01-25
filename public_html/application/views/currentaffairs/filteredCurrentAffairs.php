<div class="uk-width-6-10 ">
    <?php
   if(!empty($firstresults)){
       ?>
<h3 class="uk-panel-title">Current Affairs Date :<?php echo $firstresults[0]->currentaff_date; ?> </h3>
<div class="uk-accordion" data-uk-accordion>

 
  <?php
foreach($firstresults as $data) {
 

?> 
    <h3 class="uk-accordion-title"><?php echo $data->currentaff_header ; ?></h3>
    <div class="uk-accordion-content">
         <p class="uk-article-meta">Author : <?php echo $data->author ; ?></p>
         <div class="listcontent"> 
             <img src="<?php echo base_url();?>assets/uploads/files/<?php echo $data->imageurl;?>_thump.jpg" ></img>
             <div class="articlecontent"> 
          <?php
          $string = strip_tags($data->currentaff_text);

    if (strlen($string) > 500) {

    // truncate string
       $stringCut = substr($string, 0, 500);

    // make sure it ends in a word so assassinate doesn't become ass...
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href='. base_url().'/currentaff/Currhome/viewarticle/'.$data->currentaff_id.'">Read More</a>'; 
}
   echo $string; 
                  ?>
             </div></div></div>


<?php
}
?>
  <div class="uk-grid">
    <div class="uk-width-1-1 ">
        <p><?php echo $firstlinks; ?></p>
    </div>
</div>
    </div>


   <?php
    }else {
    

?>
    <h3 class="uk-accordion-title">No Current Affairs Updated for this date</h3>
    <?php 
}
?>
</div>
 
<div class="uk-width-2-10 " style="padding-left:3%;">
    <h3 class="uk-panel-title"><i class="uk-icon-calendar"></i> Older dates</h3>
    <div id="datepicker"></div>
    <div id="keywordwrap">
    <div id="keywords"></div>
    </div>
</div>
</div>

  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
<body>
 
 
