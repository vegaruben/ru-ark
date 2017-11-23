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
                        <label for="productType" class="col-md-3 form-control-label">Product Type</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="productType" placeholder="Product Type" required value="<?php echo set_value('productType', $product->productType); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vendor" class="col-md-3 form-control-label">Vendor</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="vendor" placeholder="Vendor" required value="<?php echo set_value('vendor', $product->vendor); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="salePrice" class="col-md-3 form-control-label">Sale Price</label>
                        <div class="input-group col-md-9">
                            <?php echo form_dropdown_currency('salePriceCurrency', set_value('salePriceCurrency',$product->salePriceCurrency), 'class="input-group-addon" '); ?>
                            <input type="number" class="form-control" name="salePrice" placeholder="Sale Price" required value="<?php echo set_value('salePrice', $product->salePrice); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="regularPrice" class="col-md-3 form-control-label">Regular Price</label>
                        <div class="input-group  col-md-9">
                            <?php echo form_dropdown_currency('regularPriceCurrency', set_value('regularPriceCurrency',$product->regularPriceCurrency), 'class="input-group-addon" '); ?>
                            <input type="number" class="form-control" name="regularPrice" placeholder="Regular Price" required value="<?php echo set_value('regularPrice', $product->regularPrice); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="requiresShipping" value="1" <?php if($product->requiresShipping) echo 'checked';?> /> This product requires shipping
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="weightLbs" class="col-md-3 form-control-label">Weight in lbs</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="weightLbs" placeholder="Weight in lbs" required value="<?php echo set_value('regularPrice', $product->weightLbs); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="HSTariffCode" class="col-md-3 form-control-label">HS Tariff Code</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="HSTariffCode" placeholder="HS Tariff Code" required value="<?php echo set_value('HSTariffCode', $product->HSTariffCode); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="YouTubeLink" class="col-md-3 form-control-label">Youttube Link</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="YouTubeLink" placeholder="Youtube Link" required value="<?php echo set_value('YouTubeLink', $product->YouTubeLink); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-3 form-control-label">Image </label>
                        <div class="col-md-9">
                            <div>
                                <img class="imgPreview" src="<?php if(!empty($product->picture)){
                                    echo '/media/'.$this->session->userdata('userid').'/products/'.$product->picture;
                                } ;?>"  />

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Drag n drop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Basic</a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div id="dropzone" class="imgPreview" style="width:250px;height:200px;border:thin solid #222;">Drop files here to upload
                                        </div>
                                        <input type="hidden" name="picture" id="picture" value="<?php echo $product->picture;?>" />
                                    </div>
                                    <div class="tab-pane" id="profile" role="tabpanel">
                                        <div class="previewComponent">
                                            <input class="fileInput" name="userfile" type="file" ref="file" />
                                            <img style="display:none" class="imgPreview " src="<?php if(!empty($product->picture)){
                                                echo '/media/'.$this->session->userdata('userid').'/products/'.$product->picture;
                                            } ;?>"  />

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-3 form-control-label"></label>
                        <div class="col-md-9">
                            <button id="btn-save" type="submit" class="btn btn-primary">Save</button>

                            <a id="btn-cancel" class="btn btn-info" href="/products/">Cancel</a>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
