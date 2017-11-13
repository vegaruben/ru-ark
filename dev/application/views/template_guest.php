<?php
$content_header = array('meta_title' => $meta_title);
$content_menu = array('menu' => $menu);
$content_footer = array('slug' => $v);

$this->load->view('layouts/_header',$content_header);
$this->load->view('layouts/_menu',$content_menu);
?>
<div class="main-content">
<?php
$this->load->view($v);
?>
</div>
<?php
$this->load->view('layouts/_footer',$content_footer);
