<?php 
global $wpdb;
$all_product = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * from ". product_table() ." ORDER by id DESC",""
    )
);

// $all_product2 = $wpdb->get_results(
//     $wpdb->prepare(
//         "SELECT * from ". product_table() ." ORDER by id DESC",""
//     ),ARRAY_A
// );
// echo "<pre>";
// print_r($all_product2);
// echo "</pre>";
// foreach ($all_product as $value) {
//     // code...
//     echo $value->id;
// }


?>



<div class="container pt-5 px-5">
  <div class="alert alert-success">
    <h3>Product List</h3>
  </div>
<table id="booking-table" class="display" >
    <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php    
        if(count($all_product) > 0){
            $i = 1;
     foreach ($all_product as $value) {  ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value->product_name; ?></td>
            <td><?php echo $value->prod_desc ?></td>
            <td><img src="<?php echo  $value->prod_image; ?>" alt="" style="width:100px; height:100px;"></td>
            <td>$ <?php echo  $value->prod_price."."."00"; ?></td>
            <?php $one = $value->id; ?>
            <td>
                <a class="btn btn-info" href="<?php echo "http://localhost/wordpress/wp-admin/admin.php?page=update-booking&id=$one"; ?>" target="_blank">Edit</a>
                <a class="btn btn-danger mt-2" href="javascript:void(0)">Delete</a>
            </td>
        </tr>
    <?php 
}
     } ?>
    </tbody>
</table>
</table>
</div>

<button id="btn">Click Here</button>

