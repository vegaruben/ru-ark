<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 28/11/17
 * Time: 13:25
 */
?>

<div class="container">
    <div id="admin-users-box" class="mainbox col-md-12">
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title">Users</div>
            </div>
            <div class="card-body" >
                <div class="clearfix"></div>
                <br />
                <?php $this->load->view('status');?>
                <form id="frmSearch" class="form-inline pull-right" action="/admin/search-user" method="post">
                    <div class="form-group">
                        <label for="txtFilter">Filter:&nbsp;&nbsp;</label>
                        <input type="text" id="txtFilter" name="txtFilter" class="form-control" placeholder="Filter" />
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
                <table id="tblusers" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>is Active</th>
                        <th>Provider</th>
                        <th data-orderable="false">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
