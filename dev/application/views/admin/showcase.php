<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 27/11/17
 * Time: 19:21
 */
function getYoutubeID($url){
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
    return $matches[1];
}
function getBackgroundImage($product){
    if(!empty($product->YouTubeLink)){
        $ret = 'https://img.youtube.com/vi/'.getYoutubeID($product->YouTubeLink).'/0.jpg';
        return $ret;
    }else{
        return '/media/'.$product->ownerId.'/products/'.$product->picture;
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php $this->load->view('status');?>
        </div>
    </div>
</div>
<?php if($featured!=NULL): ?>
<?php
    $youtubeId = getYoutubeID($featured->YouTubeLink);
?>
<div class="tier1-bg" style="background: url('<?php echo getBackgroundImage($featured); ?>') center;background-repeat: no-repeat;background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 justify-content-center align-items-center">

                <iframe src="https://www.youtube.com/embed/<?php echo $youtubeId;?>" width="640" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;padding: 0 47px;left:0" allowfullscreen></iframe>

            </div>
            <div class="col-md-6 justify-content-center align-items-center">
                <div class="tier1-txt">
                    <h2><?php echo htmlspecialchars($featured->name, ENT_QUOTES, 'UTF-8');?></h2>
                    <p><?php echo htmlspecialchars($featured->description, ENT_QUOTES, 'UTF-8');?></p>
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
    $postChunks = array_chunk($products, 3); // 3 is used to have 3 items in a row
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
        <?php break; ?>
    <?php endforeach;?>

    <?php
    if(count($products)>4):?>
        <?php
        $products = array_slice($products,4);
        $evenOdd = 'odd';
        $i = 0;
        $postChunks = array_chunk($products, 4); // 3 is used to have 3 items in a row
        foreach ($postChunks as $posts):?>
            <div class="row tier3 tier3-type1">
                <?php foreach ($posts as $post):?>
                    <?php
                    if($evenOdd=='odd'){
                        $evenOdd = 'even';
                    }else{
                        $evenOdd = 'odd';
                    }
                    ?>
                    <div class="col-6 col-lg-3">
                        <?php if($evenOdd=='odd'):?>
                            <div class="spotimg spot<?php echo $i++;?>" style="background-image:url(<?php if(!empty($post->picture)){
                                echo '/media/'.$post->ownerId.'/products/'.$post->picture;
                            } ;?>);">

                            </div>
                            <div>
                                <?php echo htmlspecialchars($post->description, ENT_QUOTES, 'UTF-8');?>
                            </div>
                        <?php else:?>
                            <div>
                                <?php echo htmlspecialchars($post->description, ENT_QUOTES, 'UTF-8');?>
                            </div>
                            <div class="spotimg spot5" style="background-image:url(<?php if(!empty($post->picture)){
                                echo '/media/'.$post->ownerId.'/products/'.$post->picture;
                            } ;?>);">

                            </div>
                        <?php endif;?>
                        <div class="overlay">
                            <div class="text">
                                <?php echo htmlspecialchars($post->name, ENT_QUOTES, 'UTF-8');?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <?php break; ?>
        <?php endforeach;?>
    <?php endif;?>


</div>
<?php endif;?>
