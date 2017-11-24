<div class="container">
    <div id="dashboard-box" style="margin-top:50px" class="mainbox col-md-12">
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title">Dashboard</div>
            </div>
            <div class="card-body" >
                <div class="col-md-6">
                    <h2>Recent Products</h2>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="80">SKU</th>
                            <th width="150">Name</th>
                            <th width="200">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($recent_products->totalrecords==0):?>
                            <tr><td colspan="3">You don't have any products, please <a href="/products/entry">add</a></td></tr>
                        <?php else:?>
                            <?php foreach ($recent_products->data as $product): ?>
                                <tr>
                                    <td><?php echo $product['SKU'];?></td>
                                    <td><?php echo $product['name'];?></td>
                                    <td><?php echo $product['description'];?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                    <p><a href="/products">All products</a></p>

                </div>
                <div class="col-md-6">

                </div>

            </div>
        </div>




    </div>
</div>
<div aria-hidden="true" aria-labelledby="welcomeDlgLabel" class="modal fade" id="welcomeDlg" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="welcomeDlgLabel">Welcome</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="msg"></p>
            </div>
        </div>
    </div>
</div>