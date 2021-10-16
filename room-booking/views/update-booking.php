<?php 
$id = $_GET['id'];
// echo $id;
// die("id is here");
global $wpdb;
$one_product = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * from ". product_table() ." WHERE id = $id", ""
    )
);

$only_one = $one_product[0];
// print_r($only_one);

?>


<div class="container mt-5 px-5">
	<div class="alert alert-success">
		<h3>Update Product</h3>
	</div>

	<div id="notify_bar">
	</div>

	<form action="javascript:void(0)" class="form-group" id="formupdateprod">
			<input type="hidden" class="form-control" name="prod_id" value="<?php echo $only_one->id; ?>" required>

		<div class="form-group">
			<label for="">Product Name</label>
			<input type="text" class="form-control" name="prod_name" id="prod_name" value="<?php echo $only_one->product_name; ?>" required>
		</div>
		<div class="form-group">

		<label for="">Product Description</label>
		<textarea  id="prod_desc" cols="30" rows="10" class="form-control" name="prod_desc" required><?php echo 
		$only_one->prod_desc; ?></textarea>
		</div>

	<!-- 	<div class="form-group mt-4">

		<label for="">Product Image</label> -->
		<!-- input type="file" class="form-control" name="prod_image"> -->
	<!-- 	<button class="alert alert-success">Upload Image</button>
		<img src="<?php //echo $only_one->prod_image; ?>" alt="" style="width:100px; height:100px;">
		</div> -->

		<div class="form-group mt-4">

		<label for="">Product Image</label>
		<!-- input type="file" class="form-control" name="prod_image"> -->
		<!-- <button class="alert alert-success">Upload Image</button> -->
		<input type="button" class="alert alert-success" id="btn-upload" value="Upload Image">
		<span id="show_image"></span>
		<input type="hidden" id="image_name" name="image_name" value="">

		<img src="<?php echo $only_one->prod_image; ?>" alt="" style="width:100px; height:100px;">

		</div>



		<div class="form-group">

		<label for="">Product Price</label>
		<input type="number" class="form-control" id="prod_price" name="prod_price" value="<?php echo $only_one->prod_price; ?>" required>
		</div>
		<button class="alert alert-success mt-5">Update Product</button>
		lorem100
	</form>
</div>