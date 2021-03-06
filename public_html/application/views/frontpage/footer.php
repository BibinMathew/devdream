<div class="uk-grid" data-uk-grid-margin style="padding-top: 5%;">
    <div class="uk-width-medium-1-2">
     <h2 class="title">Daily Quiz</h2>
        <div class="uk-panel uk-panel-box">
            
            <div id="slickQuiz">
                <h1 class="quizName"><!-- where the quiz name goes --></h1>

                <div class="quizArea">
                    <div class="quizHeader">
                        <!-- where the quiz main copy goes -->

                        <a class="sq_button startQuiz" href="#">Get Started!</a>
                    </div>

                    <!-- where the quiz gets built -->
                </div>

                <div class="quizResults">
                    <h3 class="quizScore">You Scored: <span><!-- where the quiz score goes --></span></h3>

                    <h3 class="quizLevel"><strong>Ranking:</strong> <span><!-- where the quiz ranking level goes --></span></h3>

                    <div class="quizResultsCopy">
                        <!-- where the quiz result copy goes -->
                    </div>
                </div>
            </div>                  </div>
    </div>

    <div class="uk-width-medium-1-2">
      <h2 class="title">Thought of the Day</h2>
        <div class="uk-panel uk-panel-box">
            
             <?php
                if (!empty($thoughtOfDay)) {
                   echo $thoughtOfDay[0]->tod_text;
                }
                ?>    
        </div>
    </div>
</div>
</div>
</div>
<script src="<?php echo base_url(); ?>js/Quiz/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/Quiz/slickQuiz-config.js"></script>
<script src="<?php echo base_url(); ?>js/Quiz/slickQuiz.js"></script>
<script src="<?php echo base_url(); ?>js/Quiz/master.js"></script>

</body>
</html>