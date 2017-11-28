<?php
$content_header = array('meta_title' => $meta_title);
$content_menu = array('menu' => $menu);
$content_footer = array('slug' => $v);

$params = $this->session->userdata('params');
if($params!=NULL)
    $params = json_decode($params);

$this->load->view('layouts/admin/_header',$content_header);
$this->load->view('layouts/admin/_menu',$content_menu);
?>
    <div class="main-content">
        <?php
        $this->load->view($v);
        ?>
    </div>
<?php
$this->load->view('layouts/admin/_footer',$content_footer);
