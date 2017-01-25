  // html demo
            $(document).ready(function () {
               var baseurl ='http://idreamias.com/';
                $('#treecontainer').on('changed.jstree', function (e, data) {
                    var i, j, r = [];
                    
                    for (i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).text);
                       
                    } 
                    var selectedNode= $('#treecontainer').jstree(true).get_selected(true);
                    var selectedId = selectedNode[0].id;
                    $.ajax({
                         url: baseurl+"download/DownloadHome/getDownloadsForTopicId/"+selectedId,
                         type: 'GET',
                          dataType: 'json', // added data type
                           success: function(res) {
                               $('#displayDownloads').html("");
                                
                              for(var i = 0; i < res.length; i++) {
                                     var obj = res[i];
                                     
                                     var colStartTag = "<td>";
                                     var colEndTag = "</td>";
                                     var url = obj['url'];
                                     var name = obj['name'];
                                     var html="";
                                     html = '<tr>'+colStartTag+name+colEndTag;
                                     html = html+ colStartTag + "<a href='"+baseurl+"download/DownloadHome/download/"+url+"'>Download</a>"+colEndTag;
                                     html= html+'</tr>';
                                      $("#displayDownloads").append(html);
                                    
  
                                     
                             }
                              
                            
                               
                               }
    });
                    
                }).jstree({
                    'core': {
                        'data': {
                            "url": baseurl+"video/topic/Topichome/getChildren",
                            "dataType": "json" // needed only if you do not supply JSON headers
                        }
                    }
                });
                
                
            });


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


