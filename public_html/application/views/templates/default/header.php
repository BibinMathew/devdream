<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Topics Home</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?php echo base_url(); ?>css/template/default/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo base_url(); ?>css/template/default/css/styles.css" rel="stylesheet">
                <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
                 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jstree/dist/themes/default/style.min.css">
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
        <script src= "<?php echo base_url(); ?>assets/jstree/dist/jstree.min.js"></script>
      
         <script>
            // html demo
            $(document).ready(function () {
               
                $('#treecontainer').on('changed.jstree', function (e, data) {
                    var i, j, r = [];
                    
                    for (i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).text);
                       
                    } 
                    var selectedNode= $('#treecontainer').jstree(true).get_selected(true);
                    var selectedId = selectedNode[0].id;
                    $.ajax({
                         url: "http://localhost/dreamon/video/VideoHome/getVideoByTopic/"+selectedId,
                         type: 'GET',
                          dataType: 'json', // added data type
                           success: function(res) {
                               $('#videos').html("");
                               for(var i = 0; i < res.length; i++) {
                                     var obj = res[i];
                                     var li= "<li class='video'><a href='http://localhost/dreamon/video/VideoHome/playVideo/"+obj['video_id']+"' id='tab1'><img src='http://i3.ytimg.com/vi/"+obj['URL']+"/default.jpg' height='100' width='200'/></a><h3>"+obj['video_header']+"</h3><p>"+obj['video_description']+"</p></li>";
                                     $('#videos').append(li);
                             }
                            
                               
                               }
    });
                    $('#event_result').html('Selected: ' + r.join(', '));
                }).jstree({
                    'core': {
                        'data': {
                            "url": "http://localhost/dreamon/video/topic/TopicHome/getChildren",
                            "dataType": "json" // needed only if you do not supply JSON headers
                        }
                    }
                });
                
                
            });



        </script>
	</head>
	<body>

<header class="navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="http://localhost/dreamon/" class="navbar-brand">Home</a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a href="http://localhost/dreamon/video/VideoHome">Videos</a>
        </li>
        <li>
          <a href="#">Edit</a>
        </li>
        <li>
          <a href="#">Visualize</a>
        </li>
        <li>
          <a href="#">Prototype</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

<!-- Begin Body -->
<div class="container">
	<div class="row">