<div class="container">
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 mx-auto">
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title">Reset Password</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="/user/" >Login</a></div>
            </div>
            <div class="card-body" >
                <?php echo form_open('/user/forgot','id="signupform" class="form-horizontal" role="form"');?>

                <?php $this->load->view('status') ;?>


                <div class="form-group row">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="username" placeholder="Email Address" required value="<?php echo set_value('email', $user->username); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <!-- Button -->
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Reset</button>
                    </div>
                </div>


                <?php echo form_close();?>
            </div>
        </div>




    </div>
</div>
