<div class="container">
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Profile</div>
            </div>
            <div class="panel-body" >
                
                <?php $this->load->view('status') ;?>

                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="Email Address" readonly value="<?php echo set_value('email', $user->email); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstName" placeholder="First Name" readonly value="<?php echo set_value('firstName', $user->firstName); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="lastName" placeholder="Last Name" readonly value="<?php echo set_value('lastName', $user->lastName); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
