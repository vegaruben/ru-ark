<div class="container">
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 mx-auto">
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title">Profile</div>
            </div>
            <div class="card-body" >
                
                <?php $this->load->view('status') ;?>

                <div class="form-horizontal">
                    <div class="form-group row">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="Email Address" readonly value="<?php echo set_value('email', $user->email); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="firstname" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstName" placeholder="First Name" readonly value="<?php echo set_value('firstName', $user->firstName); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
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
