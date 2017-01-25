
<div class="container" style="font-family:'bebasregular';font-size:18px;margin-top:20px;">

<ul class="uk-breadcrumb">
    <li><a href="http://idreamias.com">Home</a></li>
    <li class="uk-active"><a href="">User Registration</a></li>
    
</ul>


<div class="row">
        <div class="uk-container-center" style="font-family:'bebasregular';font-size:18px;margin-top:20px;">
       
          
          <div class="uk-grid">
            <div class="uk-width-1-4">
            </div>
            <div class="uk-width-2-4">
                <?php $attributes = array("name" => "registrationform","class"=>"uk-form uk-form-horizontal" );
                echo form_open("authentication/CustomUser/register", $attributes);?>
                 <legend style="font-size:23px">User Registration Form</legend>
                 <fieldset data-uk-margin>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="name">First Name</label>
                    <div class="uk-form-controls">
                    <input  name="fname" placeholder="" type="text" value="<?php echo set_value('fname'); ?>" />
                    <span class="uk-form-danger"><?php echo form_error('fname'); ?></span>
                    </div>
                    
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="name">Last Name</label>
                    <div class="uk-form-controls">
                    <input name="lname" placeholder="" type="text" value="<?php echo set_value('lname'); ?>" />
                    <span class="uk-form-danger"><?php echo form_error('lname'); ?></span>
                    </div>
                    
                </div>
                
                <div class="uk-form-row">
                    <label class="uk-form-label"  for="email">Email ID</label>
                    <div class="uk-form-controls">
                    <input  name="email" placeholder="" class="uk-form-width-medium" type="text" value="<?php echo set_value('email'); ?>" />
                    <span class="uk-form-danger"><?php echo form_error('email'); ?></span>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label  class="uk-form-label" for="subject">Password</label>
                    <div class="uk-form-controls">
                    <input name="password" placeholder="" type="password" />
                    <span class="uk-form-danger"><?php echo form_error('password'); ?></span>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label  class="uk-form-label" for="subject">Confirm Password</label>
                    <div class="uk-form-controls">
                    <input  name="cpassword" placeholder="" type="password" />
                    <span class="uk-form-danger"><?php echo form_error('cpassword'); ?></span>
                    </div>
                </div>

                <div class="uk-form-row">
                    <button name="submit" type="submit" class="uk-button">Signup</button>
                    <button name="cancel" type="reset" class="uk-button">Cancel</button>
                </div>
                <?php echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
                <?php echo $this->session->flashdata('verify_msg'); ?>
                </fieldset>
            </form>
            </div>
            <div class="uk-width-1-4">
            </div>
            </div>
        </div>
    
</div>
</div>
</div>