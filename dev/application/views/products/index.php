<style>

</style>
<div class="container">
    <div id="product-box" class="mainbox col-md-12">
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title">Products</div>
            </div>
            <div class="card-body" >
                <div class="toolbar">
                    <a href="/products/entry" class="btn btn-success" >Add</a>
                </div>
                <div class="clearfix"></div>
                <br />
                <?php $this->load->view('status');?>
                <form id="frmSearch" class="form-inline pull-right" actions="/product" method="post">
                    <div class="form-group row">
                        <label for="txtFilter">Filter</label>
                        <input type="text" id="txtFilter" name="txtFilter" class="form-control" placeholder="Filter" />
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
                <table id="tblproducts" class='table table-striped table-bordered' width="100%">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
