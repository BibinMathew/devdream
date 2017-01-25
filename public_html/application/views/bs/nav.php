</head>


<body id="page-top" class="index">

    <!-- Navigation -->
    <?php if (isset($frontPage)) {
        ?>
        <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
            <?php
        } else {
            ?>
            <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top affix">
            <?php
        }
        ?>

            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">I Dream IAS</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="col-sm-3 col-md-3 nav navbar-nav navbar-right">
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="q">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li>
                            <a class="page-scroll" href='<?php echo base_url()?>'>Home</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="<?php echo base_url()?>video/Videohome/">Videos</a>
                        </li>
                        <li>
                            <a class="page-scroll" href='<?php echo base_url()?>article/Articlehome/'>Articles</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#team">Team</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact1">Contact</a>
                        </li>
                        <?php if(!isset($_SESSION['userData'])) {
                         ?>
                        <li> <a href="#" class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#login-modal">Login</a></p></li>
                        <?php
                          }else{
                             
                          ?>
                          <li>
                          <div class="dropdown">
                           <a class="page-scroll dropdown-toggle " data-toggle="dropdown"> Hello  <span class="caret"></span></button></a><ul class="dropdown-menu">
                                     <li><a href="<?php echo base_url() . 'authentication/User_Authentication/logout';?>">Logout</a></li>
                                        </ul>
                                        </div>
                        </li>
                        <?php
                          }
                          ?>

                    </ul>

                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
        </nav>

        <!-- Header -->
        <!-- BEGIN # MODAL LOGIN -->
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" align="center">
                        <img class="img-circle" id="img_logo" src="http://bootsnipp.com/img/logo.jpg">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </div>

                    <!-- Begin # DIV Form -->
                    <div id="div-forms">

                        <!-- Begin # Login Form -->
                        <form id="login-form">
                            <div class="modal-body">
                                <div id="div-login-msg">
                                    <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-login-msg">Type your username and password.</span>
                                </div>
                                <input id="login_username" name="user_name" class="form-control" type="text" placeholder="Username (type ERROR for error effect)" required>
                                <input id="login_password" name="password" class="form-control" type="password" placeholder="Password" required>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" id="button-login" class="btn btn-primary btn-lg btn-block">Login</button>
                                </div>
                                <div>
                                    <button id="login_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                                    <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                                </div>
                                <div class="social-buttons"> 
                                    <a  class="btn btn-block btn-social btn-bitbucket" href='<?php echo $fauthUrl ?>'><i class="fa fa-facebook"></i>Login with Facebook </a>
                                    <a  class="btn btn-block btn-social btn-bitbucket btn-google-plus" href='<?php echo $authUrl ?>'><i class="fa fa-google-plus"></i>Login with Google</a>
                                </div>

                            </div>
                        </form>
                        <!-- End # Login Form -->

                        <!-- Begin | Lost Password Form -->
                        <form id="lost-form" style="display:none;">
                            <div class="modal-body">
                                <div id="div-lost-msg">
                                    <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-lost-msg">Type your e-mail.</span>
                                </div>
                                <input id="lost_email" name="lost_email" class="form-control" type="text" placeholder="E-Mail (type ERROR for error effect)" required>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" id="lost_pass" class="btn btn-primary btn-lg btn-block">Send</button>
                                </div>
                                <div>
                                    <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                                    <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
                                </div>
                            </div>
                        </form>
                        <!-- End | Lost Password Form -->

                        <!-- Begin | Register Form -->
                        <form id="register-form" style="display:none;">
                            <div class="modal-body">
                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Register an account.</span>
                                </div>
                                <input id="register_username" name="register_username" class="form-control" type="text" placeholder="Username (type ERROR for error effect)" required>
                                <input id="register_email" name="register_email" class="form-control" type="text" placeholder="E-Mail" required>
                                <input id="register_password" name="register_password" class="form-control" type="password" placeholder="Password" required>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" id="register_submit" class="btn btn-primary btn-lg btn-block">Register</button>
                                </div>
                                <div>
                                    <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                                    <button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                                </div>

                            </div>
                        </form>
                        <!-- End | Register Form -->

                    </div>
                    <!-- End # DIV Form -->

                </div>
            </div>
        </div>
        <!-- END # MODAL LOGIN -->