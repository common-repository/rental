<?php
   defined('ABSPATH') || die("NA BETA GALAT BAAT ACHHE BACHHE AISA NHI KRTE");
   
   
   if(isset($_REQUEST['editid'])){
     ?>
<style type="text/css">
   #update_data {
   display: block;
   }
   .all_popup_txt{
   display: none;
   }
body {
    background: #f0f0f1;
 }
 i.fa.fa-times {
    position: inherit;
         }

</style>
<?php
   }
   ?>
<div class="wrap">
<div id="all_popups_dv">
   <div class="all_popup_txt">
      <table>
         <tr class="trdvfst">
            <th>Name</th>
            <th>Type</th>
            <th>Shortcode</th>
            <th>Edit</th>
            <th>Delete</th>
         </tr>
         <?php
            global $wpdb;
            $results12 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}rentaldata ", OBJECT );
            
               foreach ( $results12 as $key22=>$value22 ) { 
                  
                   $id = $results12[$key22]->id;           
                   $featured_image = $results12[$key22]->featured_image;
                   $slider_images = $results12[$key22]->slider_images;
                   $productname = $results12[$key22]->productname;
                   $producttype = $results12[$key22]->producttype;
                   $price = $results12[$key22]->price;
                   $hosted = $results12[$key22]->hosted;
                   $features = $results12[$key22]->features;
                   $reviews = $results12[$key22]->reviews;
                   $category = $results12[$key22]->category;
                   $locations = $results12[$key22]->locations;
                   $numberofguests = $results12[$key22]->numberofguests;
                   $vehiclemake = $results12[$key22]->vehiclemake;
                   $descriptions = $results12[$key22]->descriptions;
                   
                   ?>
         <tr>
            <td><?php echo esc_attr($productname); ?></td>
            <td><?php echo esc_attr($producttype); ?></td>
            <td style="cursor: pointer;"><input id="copyshotcode"  onclick="Clicktocopy()" type="text" value="[rental-code product_type=<?php echo esc_attr($producttype); ?>]" style="cursor: pointer; width:50%;"></td>
            <td id="editdatascnd<?php echo esc_attr($id); ?>"><a href="?page=all-rental&editid=<?php echo esc_attr($id); ?>"  class="editanchrscnd"><i class="fa fa-edit"></i></a></td>
            <td id="deletedata">
               <!-- <i class="fa fa-close closepop" id="<?php// echo $id ?>">Delete</i> -->
               <p class="closepop" id="<?php echo esc_attr($id); ?>"><i class="fa fa-trash"></i></p>
            </td>
         </tr>
         <?php
            }
            
            
                ?> 
   </div>
   </table>
</div>
<div id="mainupdtdatadv">
   <form action="javascript:void(0)" method="post" id="rentaldataupdte">
      <div id="update_data">
         <?php
            global $wpdb;
            
            $edtid = sanitize_text_field($_REQUEST['editid']);
            
               $results123 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}rentaldata WHERE id = '".$edtid."'" , OBJECT );
                  
                  
                  foreach ( $results123 as $key223=>$value223 ) { 
                      
                    $id = $results123[$key223]->id;           
                    $featured_image2 = $results123[$key223]->featured_image;
                    $slider_images2 = $results123[$key223]->slider_images;
                    $productname2 = $results123[$key223]->productname;
                    $producttype2 = $results123[$key223]->producttype;
                    $price2 = $results123[$key223]->price;
                    $hosted2 = $results123[$key223]->hosted;
                    $features2 = $results123[$key223]->features;
                    $reviews2 = $results123[$key223]->reviews;
                    $category2 = $results123[$key223]->category;
                    $locations2 = $results123[$key223]->locations;
                    $numberofguests2 = $results123[$key223]->numberofguests;
                    $vehiclemake2 = $results123[$key223]->vehiclemake;
                    $descriptions2 = $results123[$key223]->descriptions;
                    $sliderImgsArr = explode(',', $slider_images2);
                    $featureArr = explode(',', $features2);
                      ?>
                     <script>
                        sliderString = "<?php echo esc_attr($slider_images2) ?>";
                        sliderImgArr = sliderString.split(",");
                        featureString = "<?php echo esc_attr($features2) ?>";
                        featureArr = featureString.split(",");
                     </script>
         <div class="popedttxtnewdata">
            <div class="nextandupdate">
               
            </div>
            <div id="rentalpluginmain">
               <div class="tabs">
                  <div onclick="rentalTabs(this)" name="photosTab" class="active">Photos</div>
                  <div onclick="rentalTabs(this)" name="informationTab">Information</div>
                  <div onclick="rentalTabs(this)" name="featuredTab">Features</div>
                  <div onclick="rentalTabs(this)" name="descriptionTab" id="DescriptionTab">Discription</div>
               </div>
               <div class="content">
                  <div class="contentchild">
                        <div id="photosTab" class="tabContent">
                           <div class="slider mt-2">
                              <label for="sliderImg" class="alllabels">Product images for slider</label>
                              <div id="selImages" class="showImg">
                              <?php
                                 for($i=0; $i < sizeof($sliderImgsArr); $i++) {
                              ?>
                                 <div class="imgwrap">
                                    <img src="<?php echo esc_attr($sliderImgsArr[$i]); ?>" width="180"><i class="fa fa-times removeicon" onclick="removeImg(this,<?php echo esc_attr($i); ?>)" aria-hidden="true"></i>
                                 </div>
                              <?php
                                 }
                              ?>
                              </div>
                              <input required name="sb-image" id="sb-image" type="button" class="imgBtn sb-image" value="+"/>
                              <input type="hidden" id="sliderImg" name="sliderImg" value="<?php  echo esc_attr($slider_images2); ?>"/>
                           </div>
                           <div class="featured mb-1" style="margin-top:2%;">
                              <label for="featuredImg" class="alllabels">Featured image</label>
                              <div id="selFeaturedImage" class="showImg">
                                 <div class="imgwrap">
                                    <img src="<?php echo esc_attr($featured_image2); ?>" width="180"><i class="fa fa-times removeicon" onclick="removeFeaturedImg()" aria-hidden="true"></i>
                                 </div>
                              </div>
                              <input required name="featured-image" id="featured-image" type="button" class="imgBtn featured-image" value="+"/>
                              <input type="hidden" id="featuredImg" name="featuredImg" value="<?php echo esc_attr($featured_image2); ?>" />
                           </div>
                        </div>
                        <div id="informationTab" class="hideCls tabContent">
                           <div class="rantalcol">
                              <div class="categorynamedv">
                                 <label for="myproductname" class="alllabels">Product name</label>
                                 <input type="text" name="myproductname" class="catogoryname Rtlinput" id="product_name" placeholder="Product Name" value="<?php echo esc_attr($productname2); ?>">
                              </div>
                              <div class="pricedv">
                                 <label for="myprice" class="alllabels">Price</label>
                                 <input type="text" name="myprice" class="product_price Rtlinput" id="price" placeholder="Product Price" value="<?php echo  esc_attr($price2);?>" >
                              </div>
                              <div class="Hosteddv">
                                 <label for="myhosted" class="alllabels">Hosted By</label>
                                 <input type="text" name="myhosted" class="Hosted Rtlinput" placeholder="Hosted by" value="<?php echo esc_attr($hosted2); ?>">
                              </div>
                           </div>
                           <div class="rantalcol">
                              <div class="categorydv">
                                 <label for="myproducttype" class="alllabels">Product type</label>
                                 <select name="myproducttype" class="catogory Rtlinput" id="product_type" value="<?php echo esc_attr($producttype2); ?>">
                                    <option value="car">Car</option>
                                    <option value="home" >Home</option>
                                    <option value="yatch">Yatch</option>
                                    <option value="ground_transportation">Ground Transportation</option>
                                 </select>
                              </div>
                              <div class="Topreviewsdv">
                                 <label for="reviews" class="alllabels">Reviews</label>
                                 <input type="text" name="reviews" class="myreviews Rtlinput" placeholder="Top reviews" value="<?php echo esc_attr($reviews2); ?>">
                              </div>
                              <div class="category_item">
                                 <label for="mycategory" class="alllabels">Category</label>
                                 <input type="text" name="mycategory" class="city Rtlinput" placeholder="Category" value="<?php echo esc_attr($category2s); ?>"> 
                              </div>
                           </div>
                           <div class="rantalcol">
                              <div class="location_items">
                                 <label for="mylocation" class="alllabels">Location</label>
                                 <input type="text" name="mylocation" class="vehicleType Rtlinput" placeholder="Location_items" value="<?php echo esc_attr($locations2);  ?>">
                              </div>
                              <div class="guests_items">
                                 <label for="mynumberofguests" class="alllabels">Total number of guests</label>
                                 <input type="text" name="mynumberofguests" class="numberofguest Rtlinput" placeholder="Guests" value="<?php echo esc_attr($numberofguests2); ?>">
                              </div>
                              <div class="vehicle-item"> 
                                 <label for="myvehiclemake" class="alllabels">Id of product</label> 
                                 <input type="text" name="myvehiclemake" class="vehiclemake Rtlinput" placeholder="Vehicle" value="<?php echo esc_attr($vehiclemake2); ?>">
                              </div>
                           </div>
                        </div>
                        <?php     
                           }?>
                        <div id="featuredTab" class="hideCls tabContent">
                           <div class="fdv">
                              <div class="Featuresdv">
                                 <label for="myfeatures" class="alllabels">Features</label> 
                                 <input type="text" name="myfeatures" id="featureInp" placeholder="Add Features"/>
                                 <input type="hidden" id="hiddenFeatures" name="productfeatures" value="<?php echo esc_attr($features2); ?>"/>
                                 <span onclick="addFeatures()" class="addBtn">Add</span>
                                 <ul id="featuresList">
                                 <?php
                                    for($j=0; $j < sizeof($featureArr); $j++) {
                                 ?>
                                 <li><?php echo esc_attr($featureArr[$j]); ?><i class="fa fa-times removeicon" onclick="removeFeature(this,<?php echo esc_attr($j) ?>)" aria-hidden="true"></i></li>
                                 <?php
                                    }
                                 ?>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div id="descriptionTab" class="hideCls tabContent">
                           <label for="mydescription" class="alllabels">Description</label> 
                           <textarea name="mydescription" class="description"><?php echo esc_attr($descriptions2); ?> </textarea>
                        </div>
                        <div class="nextandupdate">
                           <button id="nextitem">Next</button>
                        </div>
                     </div>
                  
                  </div>
               </div>
            </div>
            <div class="nextandupdate">
               <input type="hidden" name="id" value="<?php echo esc_attr($id) ?>">
               <?php wp_nonce_field('editdata', 'rdm-nonce'); ?>
               <button type="button" class="udtedtacls">Update</button>
            </div>
         </div>
      </div>
   </form>
   <div id="popshortcde">
     <div id="shortcodedv">
      <i class="fa fa-times" onclick="hideShortCde()"></i>
      <h1 id="shrtcdehding">Congratulations</h1>
     <div id="shortcdedata">
      <h2 class="shrtcdetxt">[rental-code product_type=<span id="sc_product_type"></span>]</h2>
     </div>  
    </div>
   </div>
</div>
<script>
   function Clicktocopy() {
  var copyText = document.getElementById("copyshotcode");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
}

jQuery(function() {
    jQuery('#nextitem').click(function(){
    
        jQuery('.tabs > .active').next('div').trigger('click');
         if(jQuery('.description').is(':visible')){
        }
      });
   });

   jQuery(".udtedtacls").on("click",function(){

// var firstid = this.id;

// var mainid = jQuery("#"+firstid).closest('form').attr('id');

var postdata = "action=editdata&param=save_plugin&"+jQuery("#rentaldataupdte").serialize();
        jQuery.post(ajax_object,postdata,function(response){
            var data = jQuery.parseJSON(response);
            if(data.status==1){
                // var mainid = data['id'];                    
                // window.location.href ="?page=all-popups";
                window.location.reload();
                // console.log(response);
            document.getElementById('sc_product_type').innerText = document.getElementById('product_type').value;
            document.getElementById('shortcodedv').style.display="block";
        }
        });
});
</script>
