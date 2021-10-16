<?php 
/* 
Template Name: Front end book Page layout
*/

get_header();

?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-success" style="background-color:yellow;">
				<h3>Online web Courses</h3>
			</div>

			<?php
                 echo do_shortcode("[book_page]");
			 ?>
		</div>
	</div>
</div>


<?php 

get_footer();

?>