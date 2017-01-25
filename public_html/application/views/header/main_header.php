 <?php
 $loggedIn = false;
 $username = "";
if (isset($_SESSION['userData'])){
    $loggedIn = true;
   if(isset($_SESSION['userData'])){
      $userData  = $_SESSION['userData'];
      $username= $userData['first_name'];
      }
      }
     
?>
 <body> 
     
          <div class="uk-container uk-container-center uk-margin-large-bottom"> 
           
              <div data-uk-sticky="{top:-200, animation: 'uk-animation-slide-top'}" style="background: #fff; border-bottom:2px solid #CF0000;">
                <div id="menu-row">
                    <div id="menu-logo">
                        <img src="<?php echo base_url(); ?>/images/logo.png"/>
                    </div>
                    <div class=" uk-navbar uk-navbar-flip" style="font-family: 'Fira-Sans-Semibold', sans-serif; height:35px;top:6px;background:#fff;">
                                   <div class="uk-navbar-content">
                                    <ul class="uk-navbar-nav">
                                    
                                      <?php 
                                        if($loggedIn){
                                        ?>
                                        <li class="uk-parent"  style="padding-top:10px;">
                                        <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                    <button class="uk-button"><a href="" class="tw"><i class="uk-icon-small  uk-icon-user"></i><?php echo " Welcome, ".$username; ?></a><i class="uk-icon-caret-down"></i></button>
                                    <div class="uk-dropdown uk-dropdown-bottom" aria-hidden="true" tabindex="">
                                        <ul class="uk-nav uk-nav-dropdown">
                                            <li><a href="<?php echo base_url() . 'authentication/User_Authentication/logout';?>">Logout</a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                            
                                        </li>
                                        <?php
                                          }
                                          
                                          ?>
                                          
                                        <li style="padding-top:10px;"><a href="https://twitter.com/The_Hindu" class="tw" target="_blank"><i class="uk-icon-small uk-icon-facebook"></i></a></li>
                                        <li style="padding-top:10px;"><a href="https://twitter.com/The_Hindu" class="tw" target="_blank"><i class="uk-icon-small uk-icon-twitter"></i></a></li>
                                        <li style="padding-top:10px;"><a href="https://www.linkedin.com/company/the-hindu" class="in" target="_blank"><i class="uk-icon-small uk-icon-linkedin"></i></a></li>
                                        <li style="padding-top:10px;"><a href="https://instagram.com/the_hindu/?ref=badge" class="ins" target="_blank"><i class="uk-icon-small uk-icon-instagram"></i></a></li>
                                        <li style="padding-top:10px;">
                                        <?php
                                        $attributes = array('name' => 'myform','class'=>'uk-search' , 'id'=>'searchform');
                                         echo form_open('search/SearchResults/getAllResults',$attributes); 
                                        ?>
                                         <input  name="search" placeholder="search" class="uk-search-field"  />
                                         
                                          </form>
                                        <?php echo form_close(); ?>
                                        </li>
                                        
                                    </ul>
    
                                   </div>


                </div>
            </div>
            </div>
            
         
     <div style="clear: both;"></div>
       
   
           
            
            