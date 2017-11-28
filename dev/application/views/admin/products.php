<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 28/11/17
 * Time: 15:05
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 28/11/17
 * Time: 13:25
 */
?>

<div class="container">
    <div id="admin-products-box" class="mainbox col-md-12">
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title">Products</div>
            </div>
            <div class="card-body" >
                <div class="clearfix"></div>
                <br />
                <?php $this->load->view('status');?>
                <form id="frmSearch" class="form-inline pull-right" action="/admin/search-product" method="post">
                    <div class="form-group">
                        <label for="txtFilter">Filter:&nbsp;&nbsp;</label>
                        <input type="text" id="txtFilter" name="txtFilter" class="form-control" placeholder="Filter" />
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
                <table id="tblproducts" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Sale price</th>
                        <th>Regular price</th>
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

