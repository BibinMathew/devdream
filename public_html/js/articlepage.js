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
            url: baseurl + "article/Articlehome/getArticlebyTopic/" + selectedId,
            type: 'GET',
            dataType: 'json', // added data type
            success: function (res) {
                $('#allarticles').html("");
                var heading = '<h2 class="title">' + res[0]['topic_name'] + ' Articles</h2>';
                var liststart = ' <div class="listarticle">';
                $('#allarticles').append(heading + liststart);
                for (var i = 0; i < res.length; i++) {
                    var obj = res[i];

                    var article = "<article class='col-md-4'><div class='thumbnail'><img alt='' src='"+ obj['imageurl']+"'><div class='caption'><h3>"+ obj['article_heading']+"</h3><p> "+ obj['article_content'] +"</p></div></div></article>"
                    $('#allarticles  .listarticle').append(article);
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




