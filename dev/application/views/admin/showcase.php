<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 27/11/17
 * Time: 19:21
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php $this->load->view('status');?>
        </div>
    </div>
</div>
<?php if($featured!=NULL): ?>
    <?php //var_dump($featured);?>
<div class="tier1-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 justify-content-center align-items-center">

                <iframe src="<?php echo htmlspecialchars($featured->YouTubeLink, ENT_QUOTES, 'UTF-8');?>" width="640" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;padding: 0 47px;left:0" allowfullscreen></iframe>

            </div>
            <div class="col-md-6 justify-content-center align-items-center">
                <div class="tier1-txt">
                   <?php echo htmlspecialchars($featured->description, ENT_QUOTES, 'UTF-8');?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<?php if($products!=NULL):?>
<div class="container">
    <?php
    $evenOdd = 'odd';
    $postChunks = array_chunk($products, 3); // 4 is used to have 4 items in a row
    foreach ($postChunks as $posts):?>
        <?php
        if($evenOdd=='odd'){
            $evenOdd = 'even';
        }else{
            $evenOdd = 'odd';
        }
        ?>
        <div class="row tier2">
            <?php foreach ($posts as $post):?>
                <div class="col-md">
                    <div class="row">

                        <div class="col-md-6">
                            <img src="<?php if(!empty($post->picture)){
                                echo '/media/'.$post->ownerId.'/products/'.$post->picture;
                            } ;?>"  class="img-fluid" />
                        </div>
                        <div class="col-md-6">
                            <?php echo htmlspecialchars($post->description, ENT_QUOTES, 'UTF-8');?>
                        </div>

                    </div>
                </div>
            <?php endforeach;?>
        </div>
    <?php endforeach;?>
</div>
<?php endif;?>
