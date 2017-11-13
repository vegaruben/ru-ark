<div class="container">
    <div id="product-entry-box" class="mainbox col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title"><?php echo $meta_title;?></div>
            </div>
            <div class="panel-body" >
                <?php echo form_open('/products/entry/'.$product->id, 'encType="multipart/form-data" id="productform" class="form-horizontal" role="form"');?>
                    <?php $this->load->view('status') ;?>

                    <div class="form-group">
                        <label for="sku" class="col-md-3 control-label">SKU</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="SKU" placeholder="SKU" required value="<?php echo set_value('SKU', $product->SKU); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" placeholder="Name" required value="<?php echo set_value('name', $product->name); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" placeholder="description" required ><?php echo set_value('description', $product->description); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="urlToBuy" class="col-md-3 control-label">URL to buy </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="urlToBuy" placeholder="URL to buy" required value="<?php echo set_value('urlToBuy', $product->urlToBuy); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-md-3 control-label">Image </label>
                        <div class="col-md-9">
                            <div class="previewComponent">
                                <input class="fileInput" name="userfile" type="file" ref="file" />
                                <img class="imgPreview" src="<?php if(!empty($product->picture)){
                                    echo '/media/'.$this->session->userdata('userid').'/products/'.$product->picture;
                                } ;?>"  />

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-save" type="submit" class="btn btn-primary">Save</button>

                            <a id="btn-cancel" class="btn btn-info" href="/products/">Cancel</a>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
