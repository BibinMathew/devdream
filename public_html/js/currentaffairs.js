  // html demo
            $(document).ready(function () {
               var baseurl = 'http://localhost/newapp';
                
                $('#treecontainer').on('changed.jstree', function (e, data) {
                    var i, j, r = [];
                    
                    for (i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).text);
                       
                    } 
                    var selectedNode= $('#treecontainer').jstree(true).get_selected(true);
                    var selectedId = selectedNode[0].id;
                    window.location.href = baseurl+"/currentaffairs/CurrentAffairsHome/getCurrentAffairsByTopic/"+selectedId;
                    
                }).jstree({
                    'core': {
                        'data': {
                            "url": baseurl+"/currentaffairs/Topichome/getChildren",
                            "dataType": "json" // needed only if you do not supply JSON headers
                        }
                    }
                });
                
                
            });


