
<div class="container" style="font-family:'bebasregular';font-size:18px;margin-top:20px;min-height:600px;">

    <ul class="uk-breadcrumb">
        <li><a href="http://idreamias.com">Home</a></li>
        <li class="uk-active"><a href="">Reset Password</a></li>

    </ul>


    <div class="row">
        <div class="uk-container-center" style="font-family:'bebasregular';font-size:18px;margin-top:20px;">


            <div class="uk-grid">
                <div class="uk-width-1-4">
                </div>
                <div class="uk-width-2-4">
                    <img class="uk-margin-bottom" width="140" height="120" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTQwcHgiIGhlaWdodD0iMTIwcHgiIHZpZXdCb3g9Ii0yOS41IDI3NS41IDE0MCAxMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgLTI5LjUgMjc1LjUgMTQwIDEyMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0tNi4zMzMsMjk4LjY1NHY3My42OTFoOTMuNjY3di03My42OTFILTYuMzMzeiBNNzkuNzg4LDM2NC4zNTVIMS42NTZ2LTU3LjcwOWg3OC4xMzJWMzY0LjM1NXoiLz4NCgk8cG9seWdvbiBmaWxsPSIjRDhEOEQ4IiBwb2ludHM9IjUuODYsMzU4LjE0MSAyMS45NjIsMzQxLjIxNiAyNy45OTUsMzQzLjgyNyA0Ny4wMzIsMzIzLjU2MSA1NC41MjQsMzMyLjUyMyA1Ny45MDUsMzMwLjQ4IA0KCQk3Ni4yMDMsMzU4LjE0MSAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMjQuNDYyIiBjeT0iMzIxLjMyMSIgcj0iNy4wMzQiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                    <?php
                    $attributes = array('class' => 'uk-panel uk-panel-box uk-form', 'id' => 'myform');
                    echo form_open('authentication/User_Authentication/newPasswordform');
                    ?>
                    <?php
                    if (isset($error_message)) {
                        echo '<div class="uk-alert uk-alert-danger text-center">' . $error_message . '</div>';
                    }
                     if (isset($success_message)) {
                        echo '<div class="uk-alert uk-alert-success text-center">' . $success_message . '</div>';
                    }
                    if (!empty(validation_errors())) { ?>
                        <h3>Whoops! There was an error:</h3>
                        <?php
                        echo '<div class="uk-alert uk-alert-danger text-center">' . validation_errors() . '</div>';
                    }
                    ?>
                    <div class="uk-form-row">
                        <input class="uk-width-1-1 uk-form-large" type="password"  name="Pass" placeholder="Enter Password">
                    </div>
                   <div class="uk-form-row">
                        <input class="uk-width-1-1 uk-form-large" type="password"  name="CPass" placeholder="Confirm Password">
                    </div>
                    <div class="uk-form-row">
                        <input type="submit"  value="Reset Password" class="uk-width-1-3 uk-button uk-button-primary uk-button-medium" name="submit" />
                    </div>
                    <?php if(isset($code)) echo form_hidden('code', $code) ; ?>
                    <?php echo form_close(); ?>
                </div>
                <div class="uk-width-1-4">
                </div>
            </div>
        </div>

    </div>
</div>
</div>