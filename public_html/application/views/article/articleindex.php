<div class="uk-grid" style="margin-top: 10px;">
<div class="uk-width-7-10 ">
<?php if(!empty($results)){
  
    
?>
<h3 class="uk-panel-title">All Articles </h3>
<div class="uk-accordion" data-uk-accordion>

 
<?php

foreach($results as $row) {
 

?> 
    
     <h3 class="uk-accordion-title"><?php echo $row->article_heading ; ?></h3>
     
     <div class="uk-accordion-content">
         
         <div class="listcontent"> 
             <img src="<?php echo base_url();?>assets/uploads/files/<?php echo $row->imageurl;?>_thump.jpg" ></img>
             <div class="articlecontent"> 
          <?php
          $string = strip_tags($row->article_content);

    if (strlen($string) > 500) {

    // truncate string
       $stringCut = substr($string, 0, 500);

    // make sure it ends in a word so assassinate doesn't become ass...
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href='. base_url().'/article/Articlehome/showArticle/'.$row->article_id.'">Read More</a>'; 
}
   echo $string; 
                  ?>
             </div></div>
    </div>

<?php
}}
?>
</div>
</div>
<div class="uk-width-3-10 ">
    <h3 class="uk-panel-title"> Most Read Articles </h3>
    <ul class="uk-list uk-list-striped">
<?php if(!empty($results)){
  foreach($results as $row) {
    
?>
        <li> <a href= '<?php echo base_url().'/article/ArticleHome/showArticle/'.$row->article_id;?>'><?php echo $row->article_heading ; ?> </li>
 <?php
}}
?>      
    </ul>
</div>