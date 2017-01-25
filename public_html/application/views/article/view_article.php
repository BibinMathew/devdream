<div class="uk-grid" style="margin-top: 10px;">
    <div class="uk-width-8-10 " >
  
<article class="uk-article">
    <h1 class="uk-article-title"><?php echo $results[0]['article_heading'] ?></h1>
    <p class="uk-article-meta">Author:  <?php echo $results[0]['authorname'] ?>  Date : <?php echo $results[0]['article_createdon'] ?></p>
    <div class="imagelead">
        <img src=<?php echo base_url();?>assets/uploads/files/<?php echo $results[0]['imageurl'] ;?> ></img>
    </div>
    <div class="articledata" id="articleText"><?php echo $results[0]['article_content'] ?> </div>
</article>
        
        
    </div>
    <div class="uk-width-2-10">
         <h3 class="uk-panel-title"><i class="uk-icon-bookmark"></i> Bookmarks </h3>
        <button class="uk-button uk-button-success" type="button"  id="bookmark">Bookmark it</button>
        <a href="#modal-4" data-uk-modal>Login</a>
        
    </div>
    <div id="modal-4" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: scroll;">
       <div class="uk-modal-dialog uk-modal-dialog-small">
                  <button type="button" class="uk-modal-close uk-close"></button>
                  
               <form class="uk-panel uk-panel-box uk-form">
                    <div class="uk-form-row">
                        <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Username">
                    </div>
                    <div class="uk-form-row">
                        <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Password">
                    </div>
                    <div class="uk-form-row">
                        <a class="uk-width-1-1 uk-button uk-button-primary uk-button-large" href="#">Login</a>
                    </div>
                    <div class="uk-form-row uk-text-small">
                        <label class="uk-float-left"><input type="checkbox"> Remember Me</label>
                        <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a>
                        <div class="g-signin2" data-onsuccess="onSignIn"></div>
                    </div>
                       <button class="loginBtn loginBtn--facebook"> Login with Facebook </button>
                       <button class="loginBtn loginBtn--google"> <a href="">Login with Google </a></button>
                         
                </form>
                            </div>
                        </div>
</div>
<script>
  $(document).ready(function(){
       $("#bookmark").click(function(){
           if(window.getSelection().toString() == ""){
              var modal = UIkit.modal("#modal-4");
               modal.show();
           }else{
              alert("button"+ window.getSelection().toString());      
           }
        
    }); 
        
 });

</script>