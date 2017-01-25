// html demo
$(document).ready(function () {
    var baseurl = 'http://idreamias.com/';
    $('#treecontainer').on('changed.jstree', function (e, data) {
        var i, j, r = [];

        for (i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).text);

        }
        var selectedNode = $('#treecontainer').jstree(true).get_selected(true);
        var selectedId = selectedNode[0].id;
        $.ajax({
            url: baseurl + "video/Videohome/getVideoByTopic/" + selectedId,
            type: 'GET',
            dataType: 'json', // added data type
            success: function (res) {
                $('#allvideos').html("");
                var heading = '<h2 class="title">' + res[0]['topic_name'] + ' Video Tutorials</h2>';
                var more = '<a class="more" href="#">more</a>';
                var liststart = '<ul class="list-unstyled video-list-thumbs row">';
                $('#allvideos').append(heading + liststart);
                for (var i = 0; i < res.length; i++) {
                    var obj = res[i];

                    var li = '<li class="col-lg-4 col-sm-4 col-xs-6"><a href=' + baseurl + "video/Videohome/playVideo/" + obj['video_id'] + ' title=' + obj['video_header'] + '><img src="http://i3.ytimg.com/vi/' + obj['url'] + '/default.jpg" alt="' + obj['video_header'] + '" class="img-responsive" height="130px" /><h2>' + obj['video_header'] + '</h2><span class="glyphicon glyphicon-play-circle"></span><span class="duration">03:15</span></a></li>'
                    $('#allvideos ul').append(li);
                }
                // $('#allvideos').append('</ul>');

            }
        });

    }).jstree({
        'core': {
            'data': {
                "url": baseurl + "video/topic/Topichome/getChildren",
                "dataType": "json" // needed only if you do not supply JSON headers
            }
        }
    });


});

$(document).ready(function () {
     var baseurl = 'http://idreamias.com/';
    $('i.glyphicon-thumbs-up').click(function () {

        if (!($(this).hasClass('disabled'))) {

      
            var $this = $(this),
                    c = $this.data('count');
            $this.addClass('disabled');
            if (!c)
                c = 0;
            var videoId = $('.likedislike').attr('id');
            $.ajax({
                url:baseurl+"video/Videohome/likeup/"+videoId,
                 success: function(response){
                     c++;
                     $this.data('count', c);
                     $('#like1-bs3').html(response);
                 }
            })
            
        }
    });
    
    $('i.glyphicon-thumbs-down').click(function () {

        if (!($(this).hasClass('disabled'))) {

      
            var $this = $(this),
                    c = $this.data('count');
            $this.addClass('disabled');
            if (!c)
                c = 0;
            var videoId = $('.likedislike').attr('id');
            $.ajax({
                url:baseurl+"video/Videohome/dislikeup/"+videoId,
                 success: function(response){
                     c++;
                     $this.data('count', c);
                     $('#dislike1-bs3').html(response);
                 }
            })
            
        }
    });
});


$( document ).ready(function() {
     //custom button for homepage
     $( ".share-btn" ).click(function(e) {
          $('.networks-5').not($(this).next( ".networks-5" )).each(function(){
             $(this).removeClass("active");
         });
         $(this).next( ".networks-5" ).toggleClass( "active" );
    });   
});
 

