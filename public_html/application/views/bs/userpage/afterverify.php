<section id='content'>
   
        <div class="container">
  <div class="row">
    <div class="span12">
      <div class="hero-unit center">
          <?php  if ($this->session->has_userdata('verify_msg')){
              
         ?>
          <h1>Thank you  </h1>
          <br />
          <p> You have completed the registration process . Do checkout the latest tutorials uploaded.</p>
          <br />
          <p> Best of Luck </p>
          <?php
           } else { ?>
          <h1>Error  </h1>
          <br />
          <p> There is some error with the verification process. Let us know through and email .<a href="mailto:emailus@idreamias.com?Subject=Registration Error !" target="_top">Send Mail</a></p>
          <br />
          <p> Sorry for the trouble ! </p>
          <?php
           } ?>
          
          <a href="<?php echo base_url()?>" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Take Me Home</a>
        </div>
        <br />
      <div class="thumbnail">
        <center><h2>Recent Content :</h2></center>
      </div>
        <br />
    </div>
  </div>
        </div>
</section>