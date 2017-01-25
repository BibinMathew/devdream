// Agency Theme JavaScript

$(document).ready(function($) {
    "use strict"; // Start of use strict
   // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });
    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });
    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){ 
            $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    });

}); // End of use strict

$(document).ready(function($) {
   $('#contactForm').submit(function(){
      var email = $('#contactemail').val();
      var message= $('#contactmessage').val();
      
      var name = $('#contactname').val();
      var datastring = $('#contactForm').serialize();
      $.ajax({
        type: "POST",
        url: "http://idreamias.com/Mainpage/contactus",
        data:datastring,
        success:function(data) {
         $('#submitContactform').val('Thank you for your Feedback')  ;
         
         }
        });
        
     });
   });  
