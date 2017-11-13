<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="/user/forgot">Forgot password?</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <?php $this->load->view('status') ;?>
                <?php echo form_open('/user/', 'id="loginform" class="form-horizontal" role="form"');?>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>


                    <!--
                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>
                    </div>
                    -->

                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-3 controls">
                            <button type="submit" id="btn-login" class="btn btn-success">Login  </button>
                        </div>
                        <div class="col-sm-9 controls pull-right">
                            <p class="pull-right"><a id="btn-fblogin" href="/user/facebook-login" class="btn btn-primary ">Facebook</a>&nbsp;&nbsp; <a id="btn-gmaillogin" href="/user/gmail-login" class="btn btn-primary ">Gmail</a>&nbsp;&nbsp; <a id="btn-twitterlogin" href="/user/twitter-login" class="btn btn-primary">Twitter</a>&nbsp;</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Don't have an account!
                                <a href="/user/signup" >
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>



            </div>
        </div>
    </div>

</div>
