<div class="container">
    <div id="product-entry-box" class="mainbox col-md-12">
        <div class="card panel-info">
            <div class="card-header">
                <div class="card-title"><?php echo $meta_title;?></div>
            </div>
            <div class="card-body" >
                <?php echo form_open('/products/entry/'.$product->id, 'encType="multipart/form-data" id="productform" class="form-horizontal" role="form"');?>
                    <?php $this->load->view('status') ;?>

                    <div class="form-group row">
                        <label for="sku" class="col-md-3 form-control-label">SKU</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="SKU" placeholder="SKU" required value="<?php echo set_value('SKU', $product->SKU); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-3 form-control-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" placeholder="Name" required value="<?php echo set_value('name', $product->name); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-3 form-control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" placeholder="description" required ><?php echo set_value('description', $product->description); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="urlToBuy" class="col-md-3 form-control-label">URL to buy </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="urlToBuy" placeholder="URL to buy" required value="<?php echo set_value('urlToBuy', $product->urlToBuy); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-3 form-control-label">Image </label>
                        <div class="col-md-9">
                            <div class="previewComponent">
                                <input class="fileInput" name="userfile" type="file" ref="file" />
                                <img class="imgPreview" src="<?php if(!empty($product->picture)){
                                    echo '/media/'.$this->session->userdata('userid').'/products/'.$product->picture;
                                } ;?>"  />

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
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
