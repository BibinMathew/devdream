<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
 
<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
 
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
thead{
    color:black;
}
</style>
</head>
<body>
<!-- Beginning header -->
    <div>
        <a href='<?php echo  base_url()?>video/Videohome/manage'>Videos</a> | 
        <a href='<?php echo  base_url()?>video/topic/Topichome/manage'>Topics</a> |
        <a href='<?php echo  base_url()?>video/tag/Taghome/manage'>Tags</a> |
        <a href='<?php echo  base_url()?>currentaff/Currhome/manage'>Current Affairs</a> |
        <a href='<?php echo  base_url()?>currentaff/Topichome/manage'>Current Affairs Topic</a> |
        
      
 
    </div>
<!-- End of header-->
    <div style='height:20px;'></div>  
    <div>
<?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->
<div>Footer</div></div>
<!-- End of Footer -->
</body>
</html>