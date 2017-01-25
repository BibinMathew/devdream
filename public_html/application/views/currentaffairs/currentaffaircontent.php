<div class="uk-width-6-10 ">
<?php if(!empty($firstresults)){
     $date = date_create($firstresults[0]->currentaff_date);
?>
<h3 class="uk-panel-title">Current Affairs Date :<?php echo  date_format($date, ' l jS F Y'); ?> </h3>
<div class="uk-accordion" data-uk-accordion>

 
<?php

foreach($firstresults as $row) {
 

?> 
    
     <h3 class="uk-accordion-title"><?php echo $row->currentaff_header ; ?></h3>
     
     <div class="uk-accordion-content">
         <p class="uk-article-meta">Author : <?php echo $row->author ; ?></p>
         <div class="listcontent"> 
             <img src="<?php echo base_url();?>assets/uploads/files/<?php echo $row->imageurl;?>_thump.jpg" ></img>
             <div class="articlecontent"> 
          <?php
          $string = strip_tags($row->currentaff_text);

    if (strlen($string) > 500) {

    // truncate string
       $stringCut = substr($string, 0, 500);

    // make sure it ends in a word so assassinate doesn't become ass...
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href='. base_url().'/currentaff/Currhome/viewarticle/'.$row->currentaff_id.'">Read More</a>'; 
    echo $string; 
}else {
   echo $secondRow->currentaff_text ;
   $url = base_url().'/currentaff/Currhome/viewarticle/'.$row->currentaff_id;
   
   ?>
   <a class="uk-button" href="<?php echo $url; ?>" title="Read More">Read More</a>     
   <?php
   }
            ?>
             </div></div>
    </div>

<?php
}
?>
</div>
<?php
}
?>

   <?php
if(!empty($secondresults)){
 $date = date_create($secondresults[0]->currentaff_date);
    ?>
  
<h3 class="uk-panel-title"><i class="uk-icon-newspaper-o"></i>Current Affairs Date :<?php echo date_format($date, ' l jS F Y'); ?></h3>
<div class="uk-accordion" data-uk-accordion>

 
 <?php
foreach($secondresults as $secondRow) {
 

?> 
    
     <h3 class="uk-accordion-title"><?php echo $secondRow->currentaff_header ; ?></h3>
     
    <div class="uk-accordion-content">
         <p class="uk-article-meta">Author : <?php echo $secondRow->author ; ?></p>
         <div class="listcontent"> 
             <img src="<?php echo base_url();?>assets/uploads/files/<?php echo $secondRow->imageurl;?>_thump.jpg" ></img><div class="articlecontent"> 
          <?php
          $string = strip_tags($secondRow->currentaff_text);

    if (strlen($string) > 500) {

    // truncate string
       $stringCut = substr($string, 0, 500);

    // make sure it ends in a word so assassinate doesn't become ass...
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href='. base_url().'/currentaff/Currhome/viewarticle/'.$secondRow->currentaff_id.'">Read More</a>'; 
    echo $string; 
}else {
   echo $secondRow->currentaff_text ;
   $url = base_url().'/currentaff/Currhome/viewarticle/'.$secondRow->currentaff_id;
   
   ?>
   <a class="uk-button" href="<?php echo $url; ?>" title="Read More">Read More</a>     
   <?php
   }
            ?>
             </div></div>
    </div>
	
<?php
}
?>
</div>
<?php
}
?>
 <div class="uk-grid">
    <div class="uk-width-1-1 ">
        <p><?php echo $firstlinks; ?></p>
    </div>
</div>
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
 
 
