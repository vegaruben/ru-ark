<div class="statusbox">
<?php if ($this->session->flashdata('success')): ?>	
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('success'); ?>
	</div>	
<?php endif; ?> 
<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger">
		<?php echo $this->session->flashdata('error'); ?>
	</div>	
<?php endif; ?> 
</div>
<script type="text/javascript">
	var error_fields = '<?php 
	if($this->session->flashdata('errorfields'))
		echo $this->session->flashdata('errorfields');?>';
</script>

