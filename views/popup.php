<?php
defined('ABSPATH') || die("You Can't Access this File Directly");
?>

       <?php
          $cl = $values['product_type'];
          global $wpdb;
          if(isset($_REQUEST['productid'])){
              $prid = sanitize_text_field($_REQUEST['productid']);
            $results12 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}rentaldata WHERE id = '".$prid."'", OBJECT );
        ?>
        <?php
            }
            else {
              $results1 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}rentaldata WHERE producttype = '".$cl."'", OBJECT );
              if(isset($_GET['location']) && isset($_GET['category']) && isset($_GET['vehiclemake']) ) {
                $GTLocation = sanitize_text_field($_GET['location']);
                $GTCategory = sanitize_text_field($_GET['category']);
                $GTVehicle = sanitize_text_field($_GET['vehiclemake']);
                $GTPassenger = sanitize_text_field($_GET['passengercount']);
                $GTNumberofguests = sanitize_text_field($_GET['numberofguests']);
                  if($cl == 'car') {
                    
                    $results12 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}rentaldata WHERE producttype = '".$cl."' && locations = '".$GTLocation."' || category = '".$GTCategory."' || vehiclemake = '".$GTVehicle."'", OBJECT );
                  }
                  else if($cl == 'ground_transportation') {
                    $results12 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}rentaldata WHERE producttype = '".$cl."' && locations = '".$GTLocation."' || category = '".$GTCategory."' || passengercount = '".$GTPassenger."'", OBJECT );
                  }
                  else {
                    $results12 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}rentaldata WHERE producttype = '".$cl."' && locations = '".$GTLocation."' || category = '".$GTCategory."' || numberofguests = '".$GTNumberofguests."'", OBJECT );
                  }
              }
              else {
                $results12 = $results1;
              }
            }
        ?>   
          <script>
            const product_type = '<?php echo esc_attr($cl) ?>';
          </script> 

    <?php
        if(isset($_REQUEST['productid'])){
          foreach ( $results12 as $key22=>$value22 ) { 
          $id = $results12[$key22]->id;           
          $featured_image3 = $results12[$key22]->featured_image;
          $slider_images3 = $results12[$key22]->slider_images;
          $productname3 = $results12[$key22]->productname;
          $producttype3 = $results12[$key22]->producttype;
          $price3 = $results12[$key22]->price;
          $hosted3 = $results12[$key22]->hosted;
          $features3 = $results12[$key22]->features;
          $reviews3 = $results12[$key22]->reviews;
          $category3 = $results12[$key22]->category;
          $locations3 = $results12[$key22]->locations;
          $numberofguests3 = $results12[$key22]->numberofguests;
          $vehiclemake3 = $results12[$key22]->vehiclemake;
          $descriptions3 = $results12[$key22]->descriptions;
          $myArray = explode(',', $slider_images3);
          $myArray2 = explode(',', $features3);
            array_pop($myArray);
            array_pop($myArray2);
          ?>
      <div id="rentalProduct" class="container">
          <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                  foreach ($myArray as $my1 => $vlu1) {
                    $vl = $my1;
                    echo "<li data-target='#myCarousel' data-slide-to='".esc_attr($vl)."'></li>";
                  }
                ?>
              </ol>
              <div class="carousel-inner">
                <?php
                    foreach ($myArray as $my => $vlu){
                      if($my==0){
                        $cl = 'active';
                      }else{
                        $cl = '';
                      }
                      echo "<div class='item sliderParentdiv ".esc_attr($cl)."' ><img id='slides' src='".esc_attr($vlu)."' style='width:100%;'></div>";
                    }
                ?>
              </div>
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              &#10094;
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
              &#10095;
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <div class="row ChRow">
            <div class="col-md-2 Chcol">
                <div class="leftheading">The <?php echo esc_attr($producttype3); ?></div>
            </div>
            <div class="col-md-6 Chcol">
                <div class="text-capitalize"><b><?php echo esc_attr($productname3);?></b></div>
                <p>Customer Reviews :<a href="#"> Be the first one to review this</a></p>
                <p>Asset # : <?php echo esc_attr($vehiclemake3)?></p>
                <p><?php echo esc_attr($locations3)?></p>
                <p><?php echo esc_attr($category3) ?> - Hosted by <?php echo esc_attr($hosted3); ?></p>
                <div class="row">
                    <div class="col-md-12">
                    <table style="width:100%;">
                    <tr>
                    <?php
                      $i = 3;
                    foreach ($myArray2 as $my => $vlu){
                    
                      
                     if($my == $i){
                        $i = $i+3;
                      echo "</tr>";
                     }
                     echo esc_attr("<th class='alllist'><li>$vlu</li></th>");

                    
                   }  ?>
                       </tr> 
                       </table>
                    </div>
          
                </div>
                <div class="row popupthankyou" id="popupthankyou">
                  <div class="col-12" style="padding-top: 2%;">
                  <h1 style="font-size: 50px;">Thanks You!</h1>
                    <h4>For Choosing <b><span class="text-primary">Us</span></b></h4>
                        
                  </div>
                  <div class="col-12" style="padding-top: 2%;">
                    <i class="fa fa-mail-bulk text-primary" style="font-size: 10rem;"></i>
                    <h5 style="padding-top: 2%;"><b> We will send to you an E-mail letter with the complete </br> information about your product Availabity.</b></h5   >
                    <button type="button" class="btn btn-outline-primary" onclick="gydt_thanks_now_hide()">Okay</button>
                  </div>
              </div>
            </div>
            <div class="col-md-4 Chcol formCol">
                <div><b><?php echo esc_attr($price3); ?> / Day</b></div>
                <form action="javascript:void(0)" method="post" id="availability_form">
                    <div><label>Trip Start</label></div>
                    <div class="form-group trip_datetime">
                      <span><input type="date" name="start_date" id="start_date" value=""></span>
                      <span><input type="time" name="starttime" id="start_time" value=""></span> 
                    </div>
                    <div><label>Trip End</label></div>
                    <div class="form-group trip_datetime">
                      <span><input type="date" name="end_date" id="start_date" value=""></span>
                      <span><input type="time" name="endtime" id="end_time" value=""><span>
                    </div>
                    <div class="form-group trip_datetime">
                      <select name="productlocation" id="product_location" value="<?php echo esc_attr($locations3)?>">
                        <option value="<?php echo esc_attr($locations3); ?>"><?php echo esc_attr($locations3); ?></option>
                      </select>
                    </div>
                    <div class="form-group trip_datetime">
                      <input type="email" name="checkavailabilityEmails" value="" id="checkavailabilityEmails" placeholder="Please Enter Your Email">
                    </div>
                    <?php wp_nonce_field('subcheck', 'cks-nonce'); ?>
                    <button type="submit" id="aformsub">Check Availabity</button>
                </form>
              </div>
          </div>
          <div class="row ChRow">
              <div class="col-md-2 Chcol">
                  <div class="leftheading">HOSTED BY </div>

              </div>
              <div class="col-md-6 Chcol">
                  <p><a href="#"><?php echo esc_attr($hosted3);?></a></p>
              </div>
              <div class="col-md-4 text-center Chcol">
                  <p style="border-bottom: 2px solid #e2e2e2; padding-bottom: 1%;">678 VIEWS   <i class="fa fa-eye" aria-hidden="true"></i></p>
                  <div style="display: flex;" id="socialfa">
                      <i class="fa fa-facebook-square" aria-hidden="true"></i>
                      <i class="fa fa-twitter" aria-hidden="true"></i>
                      <i class="fa fa-envelope" aria-hidden="true"></i>
                      <i class="fa fa-instagram" aria-hidden="true"></i>
                      <i class="fa fa-whatsapp" aria-hidden="true"></i>



                  </div>

              </div>
          </div>
          <div class="row ChRow">
              <div class="col-md-2 Chcol">
                  <div class="leftheading">DESCRIPTION</div>

              </div>
              <div class="col-md-6 Chcol">
                  <p><?php echo esc_attr($descriptions3); ?></p>
              </div>
              <div class="col-md-4 text-center Chcol">
                  <div class="mapouter">
                  <div class="gmap_canvas">
                   <iframe width='100%' height='250' id="gmap_canvas" src='https://maps.google.com/maps?q=+.<?php echo esc_attr($locations3); ?>.+&t=&z=13&ie=UTF8&iwloc=&output=embed' frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                     <br>
                     <style>.mapouter{position:relative;text-align:right;height:auto;width:100%;}</style>
                     <style>.gmap_canvas {overflow:hidden;background:none!important;height:auto;width:100%;}</style>
          
                     </div>
                      </div>
                </div>
          </div>
          <div class="row ChRow">
            <div class="col-md-2 Chcol">
                <div class="leftheading">FEATURES</div>
            </div>
            <div class="col-md-8 Chcol">
                <div class="row">
                    <div class="col-md-12 Chcolicon" style="justify-content:space-between;">
                    <table style="width:100%;">
                    <tr>
                    <?php
                      $i = 3;
                    foreach ($myArray2 as $my => $vlu){
                    
                      
                     if($my == $i){
                        $i = $i+3;
                      echo "</tr>";
                     }
                     echo esc_attr("<th class='alllist'><li>$vlu</li></th>");

                    
                   }  ?>
                       
                       </table>
                        
                       
                    </div>
                    
                </div> 
            </div>
            <div class="col-md-2 text-center Chcol">
            </div>
          </div>
          <div class="row ChRow">
              <div class="col-md-2 Chcol">
                  <div class="topreview"><b>Top reviews</b></div>
              </div>
              <div class="col-md-6 Chcol">
              </div>
              <div class="col-md-4 text-center Chcol">
                  <div class="topreview"><b>Customer reviews</b></div>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span>0.0(0)</span>
                  <p>0 global ratings</p>
                  <div class="row">
                      <div class="col-md-12">
                              <div class="myrate">
                                  <p class="ratenumber">5 star</p><p class="ratinglinesh"></p><p class="percent">0%</p>
                              </div>
                              <div class="myrate">
                                  <p class="ratenumber">4 star</p><p class="ratinglinesh-4"></p><p class="percent">0%</p>
                              </div>
                              <div class="myrate">
                                  <p class="ratenumber">3 star</p><p class="ratinglinesh-3"></p><p class="percent">0%</p>
                              </div>
                              <div class="myrate">
                                  <p class="ratenumber">2 star</p><p class="ratinglinesh-2"></p><p class="percent">0%</p>
                              </div>
                              <div class="myrate">
                                  <p class="ratenumber">1 star</p><p class="ratinglinesh-1"></p><p class="percent">0%</p>
                              </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    <?php
          }
        }
        else {
    ?>
<!-- Feature big image  -->
<div class="container-floid">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12">
          <?php
         
        foreach($results12 as $key22=>$value22  ) {
            $featured_image = $results12[$key22]->featured_image;
           
          ?>
        
        <?php 
       }
       
       ?>

          <img src="<?php echo esc_attr($featured_image) ?>" alt="Feature image" width="100%" height="400px"> 
          </div>
        
        </div>
      </div> 
    <!-- Feature big end -->
    <div id="maindiv" class="container">
     
      <div id="subdiv">
        <div class="selectdv">
          <div class="form-group row">
            <div class="cust-select with-icon col-12 col-sm-6 col-md-3">
                <i class="fa fa-bars" aria-hidden="true"></i>
                  <!-- <i class="fa fa-caret-down"></i> -->
                  <select class="form-control filterSelection" id="selLocation" name="location">
                  <option value="">Location</option>
                    <?php

                  foreach ( $results1 as $keyopt1=>$value1 ) { 
                    if($_GET['location'] != $results1[$keyopt1]->locations) {
                        echo '<option value="'.esc_attr($results1[$keyopt1]->locations).'">'.esc_attr($results1[$keyopt1]->locations).'</option>';
                    }
                    else {
                        echo '<option value="'.esc_attr($results1[$keyopt1]->locations).'" selected>'.esc_attr($results1[$keyopt1]->locations).'</option>';
                    }
                  }
                  ?>
                  </select>
              </div>
            <div class="cust-select with-icon col-12 col-sm-6 col-md-3">
              <i class="fa fa-bars" aria-hidden="true"></i>
              <!-- <i class="fa fa-caret-down"></i> -->
              <select class="form-control filterSelection" id="selCategory" name="category">
              <option value="">Category</option>
                <?php
              foreach ( $results1 as $keyopt1=>$value1 ) { 
                if($_GET['category'] != $results1[$keyopt1]->category) {             
                 
                  echo '<option value="'.esc_attr($results1[$keyopt1]->category).'">'.esc_attr($results1[$keyopt1]->category).'</option>';
                }
                else {
                  echo '<option value="'.esc_attr($results1[$keyopt1]->category).'" selected>'.esc_attr($results1[$keyopt1]->category).'</option>';
                }
              }
              ?>
              </select>
            </div>
            <div class="cust-select with-icon col-12 col-sm-6 col-md-3">
              <i class="fa fa-bars" aria-hidden="true"></i>
              <?php
                    if($cl == 'car') {
                      echo '<select class="form-control filterSelection" id="numberPersons" name="vehiclemake">';
                      echo '<option value="">Vehicle Make</option>';
                      foreach ( $results1 as $keyopt1=>$value1 ) { 
                          if($_GET['vehiclemake'] != $results1[$keyopt1]->vehiclemake) {
                            echo '<option value="'.esc_attr($results1[$keyopt1]->vehiclemake).'">'.esc_attr($results1[$keyopt1]->vehiclemake).'</option>';
                          }
                          else {
                            echo '<option value="'.esc_attr($results1[$keyopt1]->vehiclemake).'" selected>'.esc_attr($results1[$keyopt1]->vehiclemake).'</option>';
                          }
                      }
                    }
                    else if($cl == 'ground_transportation') {
                      echo '<select class="form-control filterSelection" id="numberPersons" name="passengercount">';
                      echo '<option value="">Select Passenger Count</option>';
                      foreach ( $results1 as $keyopt1=>$value1 ) { 
                        if($_GET['passengercount'] != $results1[$keyopt1]->passengercount) {
                          echo '<option value="'.esc_attr($results1[$keyopt1]->passengercount).'">'.esc_attr($results1[$keyopt1]->passengercount).'</option>';
                        }
                        else {
                          echo '<option value="'.esc_attr($results1[$keyopt1]->passengercount).'" selected>'.esc_attr($results1[$keyopt1]->passengercount).'</option>';
                        }
                      }
                    }
                    else {
                      echo '<select class="form-control filterSelection" id="numberPersons" name="numberofguests">';
                      echo '<option value="">Guests</option>';
                      foreach ( $results1 as $keyopt1=>$value1 ) { 
                        if($_GET['numberofguests'] != $results1[$keyopt1]->numberofguests) {
                          echo '<option value="'.esc_attr($results1[$keyopt1]->numberofguests).'">'.esc_attr($results1[$keyopt1]->numberofguests).'</option>';
                        }
                        else {
                          echo '<option value="'.esc_attr($results1[$keyopt1]->numberofguests).'" selected>'.esc_attr($results1[$keyopt1]->numberofguests).'</option>';
                        }
                      }
                    }
              ?>
              </select>
            </div>
            <div class="cust-select col-12 col-sm-6 col-md-3">
              <input type="submit" class="btnsearch" name="" onclick="filterItem()" value="Search">
            </div>             
          </div> 
        </div>
        <div class="topHeading">Featured Listings and Offerings</div>
      </div>
      <div id="allitems" class="row">
        <?php
        foreach ( $results12 as $key22=>$value22 ) { 
            $id = $results12[$key22]->id;           
            $hosted = $results12[$key22]->hosted;
            $productname = $results12[$key22]->productname;
            $producttype = $results12[$key22]->producttype;
            $productprice = $results12[$key22]->price;
            $descriptions = $results12[$key22]->descriptions;
            $featured_image = $results12[$key22]->featured_image;
            $reviews = $results12[$key22]->reviews;
            $locations = $results12[$key22]->locations;
            $vehicleType = $results12[$key22]->vehicleType;
            $numberofguests = $results12[$key22]->numberofguests;
            $vehiclemake = $results12[$key22]->vehiclemake;
            $slider_images = $results12[$key22]->slider_images;
          ?>
          
          
            <div id="item<?php echo  esc_attr($id) ?>" class="productCls col-12 col-md-6 col-lg-4">
                <div style="border-radius: 5px; min-height: 190px; background-size: 100% 200px; background-repeat: no-repeat; object-fit: contain; background-position: center; background-image: url(<?php echo esc_attr($featured_image); ?>);">
                    <div class="innerImg">
                      <div class="item-featuredTag"></div>
                      
                      <div class="priceTag"><?php echo esc_attr($productprice); ?></div>
                    </div>
                    
                    
                </div>
                <div class="content">
                      <strong id="productname"><?php echo  esc_attr($productname) ?></strong>
                      <span id="productlocation"><?php echo  esc_attr($locations) ?></span>
                    </div>
                    <div><a href="?productid=<?php echo esc_attr($id);?>" class="checkbtn">Check Availabity</a></div>
            </div>
            <script id='delme'>
                  var arrImg = "<?php echo esc_attr($slider_images); ?>";
                  document.getElementById('delme').remove();
            </script>
          
          <?php     
          }
          ?>
      </div>
    </div>  
  <?php 
        }
  ?>
<style>
th.alllist {
    position: relative;
    margin-right: 5%;
    font-size:1.7rem;
}
  input#start_time, input#end_time {
    border-width: 1px 1px 1px 1px;
    border-color: #e2e2e2;
    border-radius: 6px;
}
p.ratenumber {
    margin-right: 5%;
}
p.percent {
    margin-left: auto;
    margin-right: 15%;
}

div#maindiv {
    padding: 3% 8% 3% 8%;
}
.row.popupthankyou {
    justify-content: center;
    text-align: center;
    position: absolute;
    top: 0;
    border-radius: 10px;
    padding: 3%;
    background: #fff;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
#popupthankyou{
  display: none;
}
button.btn.btn-outline-primary {
    border: 1px solid #337ab7;
    color: #337ab7;
}
button.btn.btn-outline-primary:hover {
    border: 1px solid #337ab7;
    background-color:#337ab7;
    color: #fff;
}
a.left.carousel-control, a.right.carousel-control {
    background-color: #000!important;
    color: #fff!important;
    padding: 0.5%;
}
</style>
<script>
function gydt_thanks_now_hide(){
  document.getElementById('popupthankyou').style.display="none";
}

jQuery(document).ready(function(){
jQuery('.imagen[src=""]').hide();
jQuery('.imagen:not([src=""])').show();
});

jQuery("#aformsub").on("click",function(){
        var postdata = "action=subcheck&param=save_plugin&"+jQuery("#availability_form").serialize();
        
      
        jQuery.post(ajax_object,postdata,function(response){
    
        var data = jQuery.parseJSON(response);
        if (data.status == 1) {
        // window.location.href ="?page=custom-plugin2";
        document.getElementById('popupthankyou').style.display="block";
        
    
       
        console.log(data);
    }
        });
        });
</script>