<?php
$menuitems = [
    'dashboard' => 'Dashboard',
    'products' => 'Products'
];
?>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><img src="/assets/img/logo-funnlz.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php foreach ($menuitems as $slugx=>$labelx):?>
                    <li class="<?php if($slug==$slugx) echo 'active';?> nav-item"><a class="nav-link" href="/<?php echo $slugx;?>"><?php echo $labelx;?></a></li>
                <?php endforeach;?>
            </ul>
            <div class="pull-right">
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> Hello <?php echo $this->session->userdata('displayName'); ?> ! <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="/dashboard/profile">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="/user/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
