<?php

// get_header();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
  *{
    margin: 0;
    padding: 0;
  }
    .nightPrice {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: normal;
    justify-content: space-between;
    align-items: center;
}


.subPrice {
    border-bottom: 1px solid #cacaca;
    padding-bottom: 10px;
    padding-left: 10px;
    padding-right: 10px;
}
.subPrice p:first-child, .TotalPricebox p:first-child {
    font-weight: 600;
}
.subPrice p, .TotalPricebox p {
    margin-bottom: 0;
}
.currencySymbol {
    display: flex;
    align-items: center;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: normal;
    justify-content: normal;
    align-items: center;
}
.montserrat-semibold {
    font-family: 'montserratsemibold' !important;
}
.pro_Booking_Icon {
    background: #51a4c6;
    padding: 6px 12px;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    color: #fff;
    width: 20.33%;
    font-size: 12px;
    justify-content: center;
}
.changeDetails {
    padding-top: 5px;
    padding-bottom: 25px;
    border-top: 1px solid #cacaca;
}
.property_Booking_Discount_Wrapper a {
    text-transform: capitalize;
    color: #0FA3C5;
    font-size: 14px;
    padding-left: 10px;
}
.p-0 {
    padding: 0!important;
}
p {
    display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}

a {
    outline: none !important;
    text-decoration: none !important;
}
.montserrat-semibold {
    font-family: 'montserratsemibold' !important;
}
.remainingWrapper .TotalPricebox:first-child {
    background: #51a4c6;
}
.remainingWrapper .TotalPricebox:first-child p {
    color: #fff;
}
.TotalPricebox {
    border-bottom: 1px solid #cacaca;
    padding: 12px 10px;
}
.subPrice p:first-child, .TotalPricebox p:first-child {
    font-weight: 600;
}
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <?php

print_r($_POST);

// $date1 = "2007-03-24";
// $date2 = "2009-06-26";

// $diff = abs(strtotime($date2) - strtotime($date1));

// echo "Diffrence: ".$diff."<hr>";

// $years = floor($diff / (365*60*60*24));
// $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
// $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

// printf("%d years, %d months, %d days\n", $years, $months, $days);

echo "<hr> Start date:".$_POST['scheckIn'];
echo "<hr> End date:".$_POST['scheckOut'];

// $date1=date_create("2021-09-13");
$date1=date_create($_POST['scheckIn']);
// $date2=date_create("2021-10-11");
$date2=date_create($_POST['scheckOut']);
$diff=date_diff($date1,$date2);
// echo "<hr>".$diff;
echo "<pre>";
print_r($diff);
echo "</pre>";
$totaldays =$diff->days;


?>
    </div>
	<div class="col-md-4 property_Booking_Discount_Wrapper pr-0">
  <div class="prop_booking_Inner_Wrapper ">
    <div class="property_Booking_DiscountBox text-center">
        <h1 class="property_Booking_Discount_Title">Apartment Ruzica I</h1>
        <hr>
        <div class="bedroom_Wrapper">
            <p class="montserrat-regular">
                <span class="pro_Booking_Icon"><img alt="bed" class="sepImage" src="https://eos-croatia.com/wp-content/themes/eos-croatia/assets/img/bath.svg">1</span>
                <span class="pro_Booking_Icon"><img alt="bed" class="sepImage" src="https://eos-croatia.com/wp-content/themes/eos-croatia/assets/img/bed.svg">5</span>
                <span class="pro_Booking_Icon"><img alt="bed" class="sepImage" src="https://eos-croatia.com/wp-content/themes/eos-croatia/assets/img/person.svg">5</span>
            </p>
        </div>
        <div class="datesWrapper row">
            <div class="col-md-6">
                <div class="dateItem">
                    <div class="calIcon">
                    <img src="https://eos-croatia.com/wp-content/themes/eos-croatia/assets/img/calendar.svg" alt="Apartment Ruzica I">
                    </div>
                
                    <div class="dateData">
                        <p>Check In</p>
                        <p class="checkinDate"><?php echo $_POST['scheckIn']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dateItem">
                    <div class="calIcon">
                    <img src="https://eos-croatia.com/wp-content/themes/eos-croatia/assets/img/calendar.svg" alt="Apartment Ruzica I">
                    </div>
                    <div class="dateData">
                        <p>Check Out</p>
                        <p class="checkoutDate"><?php echo $_POST['scheckOut']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="changeDetails text-center"><a href="https://eos-croatia.com/property/ruzica-i/" class="p-0">change details</a></div>  -->
        <div class="changeDetails text-center"><a href="http://localhost/wordpress/booking-page/" class="p-0">change details</a></div>
        <div class="perNightnew"><div class="subPrice nightPrice">
        <p><?php echo $totaldays;  ?> Nights</p>
        <p class="currencySymbol">
            <span class="montserrat-semibold currencyUnit">€</span>
            <span class="avgNighta"><?php echo $_POST['p_totalPrice']; ?></span>
        </p>
    </div></div>
        <div class="perNight d-none"><div class="subPrice nightPrice">
        <p><?php ?> Nights</p>
        <p class="currencySymbol">
            <span class="smallText">Avg/Night</span>
            <span class="montserrat-semibold currencyUnit">€</span>
            <span class="avgNight">202</span>
        </p>
    </div></div>
        <div class="priceWrapper">
            <div class="subPrice nightPrice">
                <p>Discount:</p>
                <p class="discountPost d-none"><?php echo $_POST['p_discountPrice']; ?></p>
                <p class="currencySymbol">
                    <span class="montserrat-semibold currencyUnit">€</span>
                    <span class="discountPrice"><?php echo ceil($_POST['p_discountPrice']); ?></span>
                </p>
            </div>
            <div class="hasInsurance d-none subPrice">
                <p>Insurance:</p>
                <p class="InsuranceAmount"></p>
            </div>
        </div>
        <div class="TotalPricebox">
            <div class="subPrice nightPrice">

            <p>Total:</p>
            <p class="currencySymbol">
                <span class="montserrat-semibold currencyUnit">€</span> 
                <span class="TotalPricePost d-none"><?php echo ceil($_POST['p_totalPrice']); ?></span>
                <span id="sndTotal" class="TotalPrice totalConvert" data-actualtotal="<?php echo $_POST['p_totalPrice']; ?>"><?php echo ceil($_POST['p_totalPrice']); ?></span>
                <span class="d-none oldTotal" data-oldtotal="5,<?php ceil($_POST['p_totalPrice']); ?>"></span>
                <span class="d-none addonoldtotal" data-addonoldtotal="<?php ceil($_POST['p_totalPrice']); ?>"></span>
            </p>
          </div>
        </div>
                                    <div class="remainingWrapper ">
                    <div class="TotalPricebox advanceBox nightPrice">
                        <p>Advance Payment (<span class="downpercentage">100</span>%):</p>
                        <p class="currencySymbol">
                            <span class="montserrat-semibold currencyUnit">€</span>
                            <span class="d-none advancePost"><?php echo $_POST['p_totalPrice']; ?></span>
                            <span class="TotalPriceside advanceTotal"><?php echo ceil($_POST['p_totalPrice']); ?></span>
                        </p>
                    </div>
                    <div class="TotalPricebox f12 dueDateBox">
                        <p>Due Date: <span class="blue"><?php echo $_POST['scheckIn']; ?></span></p>
                        
                    </div></div>
                                </div>
                                <div class="propDesc">  <div class="descTop">
  </div>
  <div class="descbottom">
  <h3>VERIFIED RENTAL OWNER</h3>
  <ul class="propDescpoint">
  <li><i class="fa fa-check"></i><span class="black">Documentation provided.</span></li>
  <li><i class="fa fa-check"></i><span>Personally checked and verified property.</span></li>
  <li><i class="fa fa-check"></i><span>transfers and excursions assistance.</span></li>
  <li><i class="fa fa-check"></i><span>Our customer service is open 7 days a week.</span></li>
  </ul>
  </div></div>
                            </div>
                        </div>
                        </div>
                        </div>
	
</body>
</html>

<!-- <script>
	const date1 = new Date('9-13-2021');
	console.log("data one:"+date1);
const date2 = new Date('10-11-2021');
	console.log("data two:"+date2);

const diffTime = Math.abs(date2 - date1);
	console.log("diffTime:"+diffTime);

const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
console.log(diffTime + " milliseconds");
console.log(diffDays + " days");
</script> -->