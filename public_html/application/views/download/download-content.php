<div class="uk-width-7-10">
<h1>Recent Downloads</h1>

<table id="newspaper-a" summary = "RWD List to Table">
  <tr>
    <th>Description</th>
    <th>Downloads</th>
    
  </tr>
  
 <tbody id="displayDownloads">
  <?php
  if(!empty($results)){
  foreach($results as $row){
      
  ?>
  
  <tr>
    <td ><?php echo $row['name']; ?></td>
    <td ><a href="<?php echo base_url().'download/DownloadHome/download/'.$row['url']; ?>">Download</a></td>
    
  </tr>
  <?php
  }}
    ?>
  <tbody>
</table>
     
</div>
</div>
</div>
