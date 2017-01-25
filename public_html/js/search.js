/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    
    var baseurl='';
    
    $.ajax({
        url:'/newapp/util/Utils/getBaseUrl',
        complete: function (response) {
            baseurl = response.responseText;
        },
        error: function () {
            $('#output').html('Bummer: there was an error!');
        },
    });
    /*$('#searchstring').keydown(function(event) {
        if (event.keyCode == 13) {
          // document.forms.myform.submit();
          var value =  $('#searchstring').val();
           location.href =baseurl+"/search/SearchResults/search/"+value;
           
         
            return false;
         }
   
});*/
});