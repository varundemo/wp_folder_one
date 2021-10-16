<?php 
global $wpdb;
$all_product = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * from ". product_table() ." ORDER by id DESC",""
    )
);



?>


<div class="row">
  <?php 
  foreach($all_product as $product){
    ?>
<div class="col-sm-4">`
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $product->prod_image; ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $product->product_name; ?></h5>
    <p class="card-text"><?php echo wp_trim_words( $product->prod_desc, 20 ); ?></p>
    <a href="#" class="btn btn-primary">Rs. <?php echo $product->prod_price; ?></a>
  </div>
</div>
</div>

<?php 
}
?>

</div>