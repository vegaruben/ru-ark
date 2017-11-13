<div class="container">
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="/user/" >Sign In</a></div>
            </div>
            <div class="panel-body" >
                <?php echo form_open('/user/signup','id="signupform" class="form-horizontal" role="form"');?>

                    <?php $this->load->view('status') ;?>


                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="Email Address" required value="<?php echo set_value('email', $user->email); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstName" placeholder="First Name" required value="<?php echo set_value('firstName', $user->firstName); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="lastName" placeholder="Last Name" required value="<?php echo set_value('lastName', $user->lastName); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" placeholder="Password" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                            <span style="margin-left:8px;">or</span>
                        </div>
                    </div>

                    <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">

                        <div class="col-md-offset-3 col-md-9">
                            <p class="pull-right"><a id="btn-fblogin" href="/user/facebook-login" class="btn btn-primary ">Facebook</a>&nbsp;&nbsp; <a id="btn-gmaillogin" href="/user/gmail-login" class="btn btn-primary ">Gmail</a>&nbsp;&nbsp; <a id="btn-twitterlogin" href="/user/twitter-login" class="btn btn-primary">Twitter</a>&nbsp;</p>
                        </div>

                    </div>



                <?php echo form_close();?>
            </div>
        </div>




    </div>
</div>
