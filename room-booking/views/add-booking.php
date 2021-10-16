<?php  wp_enqueue_media(); ?>

<div class="container mt-5 px-5">
	<div class="alert alert-success">
		<h3>Add Product</h3>
	</div>
	<div id="notify_bar">
	</div>	
	<form action="javascript:void(0)" class="form-group" id="formaddprod">
		<div class="form-group">
			<label for="">Product Name</label>
			<input type="text" class="form-control" name="prod_name" id="prod_name" required>
		</div>
		<div class="form-group">

		<label for="">Product Description</label>
		<textarea name="prod_desc" cols="30" rows="10" class="form-control" id="prod_desc" name="prod_desc" required></textarea>
		</div>
		<div class="form-group mt-4">

		<label for="">Product Image</label>
		<!-- input type="file" class="form-control" name="prod_image"> -->
		<!-- <button class="alert alert-success">Upload Image</button> -->
		<input type="button" class="alert alert-success" id="btn-upload" value="Upload Image">
		<span id="show_image"></span>
		<input type="hidden" id="image_name" name="image_name" value="">
		</div>
		
		<div class="form-group">

		<label for="">Product Price</label>
		<input type="number" class="form-control" name="prod_price" id="prod_price" required>
		</div>
		<button class="alert alert-success mt-5">Add Product</button>
		
	</form>
</div>