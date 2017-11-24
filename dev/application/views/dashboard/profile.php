<div class="container">
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 mx-auto">
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title">Profile</div>
            </div>
            <div class="card-body" >
                <?php echo form_open("/dashboard/profile", 'id="signupform" class="form-horizontal" role="form" '); ?>

                    <?php $this->load->view('status') ;?>

                    <div class="form-group row">
                        <label for="email" class="col-md-3 form-control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="Email Address" required value="<?php echo set_value('email', $user->email); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="firstname" class="col-md-3 form-control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstName" placeholder="First Name" required value="<?php echo set_value('firstName', $user->firstName); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastname" class="col-md-3 form-control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="lastName" placeholder="Last Name" required value="<?php echo set_value('lastName', $user->lastName); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="paypalEmail" class="col-md-3 form-control-label">Paypal Account</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="paypalEmail" placeholder="Paypal Account" required value="<?php echo set_value('paypalEmail', $user->paypalEmail); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Save</button>
                        </div>
                    </div>
                    <?php echo form_hidden('id', $user->id); ?>
                <?php echo form_close();?>
            </div>
        </div>
        <div class="mt-md-4"></div>
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title">Update Password</div>
            </div>
            <div class="card-body" >
                <?php echo form_open("/user/update-password", 'id="reset-password-form" class="form-horizontal" role="form" '); ?>

                <div class="statusbox">
                    <?php if ($this->session->flashdata('success2')): ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success2'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error2')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error2'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <script type="text/javascript">
                    var error_fields = '<?php
                        if($this->session->flashdata('errorfields2'))
                            echo $this->session->flashdata('errorfields2');?>';
                </script>


                <div class="form-group row">
                    <label for="password" class="col-md-3 form-control-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" required name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new-password" class="col-md-3 form-control-label">New Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" required name="newPassword" placeholder="New Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new-password2" class="col-md-3 form-control-label">Re-enter New Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" required name="newPassword2" placeholder="Re-enter New Password">
                    </div>
                </div>
                <div class="form-group row">
                    <!-- Button -->
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Save</button>
                    </div>
                </div>
                <?php echo form_hidden('userId', $user->id); ?>
                <?php echo form_close();?>
            </div>
        </div>



    </div>
</div>
