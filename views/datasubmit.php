
<?php
defined('ABSPATH') || die("NA BETA NA GALAT BAAT ACHHE BACHHE AISA NHI KRTE");

?>
<style>

   
body {
    background: #f0f0f1;
 }

</style>
<form action="javascript:void(0)" method="post" id="rentalform">
   
   <div id="rentalpluginmain">
      <div class="tabs">
         <div onclick="rentalTabs(this)" name="photosTab" class="active">Photos</div>
         <div onclick="rentalTabs(this)" name="informationTab">Information</div>
         <div onclick="rentalTabs(this)" name="featuredTab">Features</div>
         <div onclick="rentalTabs(this)" name="descriptionTab" id="Discriptiontab">Discription</div>
      </div>
      <div class="content">
      
         <div id="photosTab" class="tabContent">
            <div class="slider mt-2">
                  <label for="sliderImg" class="alllabels">Product images for slider</label>
                  <div id="selImages" class="showImg"></div>
                  <input required name="sb-image" id="sb-image" type="button" class="imgBtn sb-image" value="+"/>
                  <input type="hidden" id="sliderImg" name="sliderImg" value=""/>
            </div>

            <div class="featured mb-1" style="margin-top:2%;">
                  <label for="featuredImg" class="alllabels">Featured image</label>
                  <div id="selFeaturedImage" class="showImg"></div>
                  <input required name="featured-image" id="featured-image" type="button" class="imgBtn featured-image" value="+"/>
                  <input type="hidden" id="featuredImg" name="featuredImg" value="" />

            </div>

         </div>
         <div id="informationTab" class="hideCls tabContent">  
            <div class="rantalcol">
               <div class="categorynamedv">
               <label for="productname" class="alllabels">Product name</label>
               <input type="text" name="productname" class="catogoryname Rtlinput" id="product_name" placeholder="Product Name" value="">
               </div>
               <div class="pricedv">
               <label for="price" class="alllabels">Price</label>
               <input type="text" name="price" class="product_price Rtlinput" id="price" placeholder="Product Price" value="" >
               </div>
               <div class="Hosteddv">
               <label for="hosted" class="alllabels">hosted by</label>
               <input type="text" name="hosted" class="Hosted Rtlinput" placeholder="Hosted by" value="">
               </div>
            </div>

            <div class="rantalcol">
            <div class="categorydv">
            <label for="producttype" class="alllabels">Product type</label>
            <select name="producttype" class="catogory Rtlinput" id="product_type" value="">
               <option value="car">Car</option>
               <option value="home" >Home</option>
               <option value="yatch">Yatch</option>
               <option value="ground_transportation">Ground Transportation</option>
            </select>
            </div>
            <div class="Topreviewsdv">
            <label for="reviews" class="alllabels">Reviews</label>
            <input type="text" name="reviews" class="reviews Rtlinput" placeholder="Top reviews" value="">
            </div>
            <div class="category_item">
            <label for="category" class="alllabels">Category</label>
            <input type="text" name="category" class="city Rtlinput" placeholder="Category" value=""> 
            </div>

            </div>
            <div class="rantalcol">
            <div class="location_items">
            <label for="location" class="alllabels">Location</label>
            <input type="text" name="location" class="vehicleType Rtlinput" placeholder="Location Of Product" value="">
            </div> 
            <div class="guests_items">
            <label for="numberofguests" class="alllabels">Total number of guest</label>
            <input type="text" name="numberofguests" class="numberofguest Rtlinput" placeholder="Total number of Guests" value="">
            </div>
            <div class="vehicle-item">
            <label for="vehiclemake" class="alllabels">Id Of Product</label>  
            <input type="text" name="vehiclemake" class="vehiclemake Rtlinput" placeholder="Id of product" value="">
            </div>
         
            </div>
         </div>
      
         <div id="featuredTab" class="hideCls tabContent">
            <label for="features" class="alllabels">Features</label>
            <input type="text" name="features" id="featureInp" placeholder="Add Features"/>
            <input type="hidden" id="hiddenFeatures" name="productfeatures" value=""/>
            <span onclick="addFeatures()" class="addBtn">Add</span>
            <ul id="featuresList"></ul>
         </div>

         <div id="descriptionTab" class="hideCls tabContent">
            <div class="rantaldiscoldis">
            <label for="description" class="alllabels">Description</label>
            <textarea name="description" class="description">Description</textarea>
            <div class="btndv"></div>
         </div> 

   
         </div>
         <div class="nextandupdate">
               <button id="nextitem" type="button">Next</button>
         </div>
         
         </div>
   
   </div>
   <div class="nextandupdate" style="">
   
      <?php wp_nonce_field('addingdata', 'submit-nonce'); ?>
      <button  type="button" class="submitdata">Submit</button>
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
   <script>
      
jQuery(function() {
    jQuery('#nextitem').click(function(){
    
        jQuery('.tabs > .active').next('div').trigger('click');
         if(jQuery('.description').is(':visible')){
        }
      });


  
   });
   </script>




