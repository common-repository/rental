var featureArr = [];
var sliderImgArr = [];

function addFeatures() {
    var inpField = document.getElementById('featureInp');
    if(inpField.value != '') {
        var li = document.createElement('LI');
        var cross = document.createElement('I');    
        cross.classList = 'fa fa-times removeicon';
        cross.setAttribute('onclick','removeFeature(this,'+featureArr.length+')');
        li.innerHTML = inpField.value;
        li.appendChild(cross);
        document.getElementById('featuresList').appendChild(li);
        featureArr.push(inpField.value);
        document.getElementById('hiddenFeatures').value = featureArr.toString();
        inpField.value = '';
    }
    else {
        alert('Please write a feature name.');
    }
}

function removeFeature(ele, index) {
    ele.parentElement.remove();
    featureArr.splice(index,1);
    document.getElementById('hiddenFeatures').value = featureArr.toString();
}

function removeImg(ele, index) {
    ele.parentElement.remove();
    sliderImgArr.splice(index,1);
    document.getElementById('sliderImg').value = sliderImgArr.toString();
}

function removeFeaturedImg() {
    document.getElementById('selFeaturedImage').innerHTML = '';
    document.getElementById('featuredImg').value = '';
}


  function rentalTabs(ele) {
        var contentTabs = document.getElementsByClassName('tabContent');
        document.getElementsByClassName('active')[0].classList.remove('active');
        ele.classList.add('active');
        for(var kite = 0; kite < contentTabs.length; kite++) {
            if(contentTabs[kite].id != ele.getAttribute('name')) {
                contentTabs[kite].classList.add('hideCls');
            }
            else {
                contentTabs[kite].classList.remove('hideCls');
            }
        }

    }

   
  
    
    function filterItem() {
            var location = document.getElementById('selLocation').value;
            var category = document.getElementById('selCategory').value;
            var numberPersons = document.getElementById('numberPersons').value;
            var numberPersonVal = product_type == 'car' ? 'vehiclemake' : product_type == 'ground_transportation' ? 'passengers' : 'guests';
            window.location.href = '?location='+location+'&category='+category + '&' + numberPersonVal + '=' + numberPersons;
    }

    // carousel script

    jQuery(function() {

        if (screen.width < 601) {
            jQuery('.sb-image').val("File");
            jQuery('.featured-image').val("File");
        } 
        else if (screen.width > 601) {
            jQuery('.sb-image').val("+");
            jQuery('.featured-image').val("+");
        }
        
        
                 // opening wp media files
                 jQuery("#sb-image").on("click",function(){
                    var images = wp.media({
                    title: "Choose a file…",
                    multiple: true
                    }).open().on("select",function(e){
                        var uploadedImages = images.state().get("selection");
                        var selectedImages = uploadedImages.toJSON();
                        jQuery.each(selectedImages,function(index,image){
                        var div = document.createElement('DIV');
                        div.className ="imgwrap";
                        var cross = document.createElement('I');
                        cross.classList = 'fa fa-times removeicon';
                        cross.setAttribute('onclick','removeImg(this,'+sliderImgArr.length+')');
                        var img = document.createElement('IMG');
                        img.src = image.url;
                        img.width = '180';
                        div.append(img);
                        div.append(cross);
                        document.getElementById('selImages').append(div);
                        sliderImgArr.push(image.url);
                        });    
                        jQuery('input[name="sliderImg"]').val(sliderImgArr.toString());
                        });
                });
     
                jQuery("#featured-image").on("click",function(){
                    var featuredImg = '';
                    var images = wp.media({
                    title: "Choose a file…",
                    multiple: false
                    }).open().on("select",function(e){
                    var uploadedImages = images.state().get("selection");
                    var selectedImages = uploadedImages.toJSON();
                    jQuery.each(selectedImages,function(index,image){
                    var div = document.createElement('DIV');
                    div.className ="imgwrap";
                    var cross = document.createElement('I');
                    cross.classList = 'fa fa-times removeicon';
                    cross.setAttribute('onclick','removeFeaturedImg()');
                    var img = document.createElement('IMG');
                    img.src = image.url;
                    img.width = '180';
                    div.append(img);
                    div.append(cross);
                    document.getElementById('selFeaturedImage').innerHTML = '';
                    document.getElementById('selFeaturedImage').append(div);
                    featuredImg = image.url;
                    });        
                    jQuery('input[name="featuredImg"]').val(featuredImg);
                    });
                });
    //endjquery
    });
    
    // carousel script

    // popup script start
        
    
    function hideShortCde(){
        document.getElementById('shortcodedv').style.display='none';
        // window.location.reload();
    }

    jQuery(function(){
    
        jQuery(".submitdata").on("click",function(){
            var postdata = "action=addingdata&param=save_plugin&"+jQuery("#rentalform").serialize();
            
            jQuery.post(ajax_object,postdata,function(response){
              console.log(response);
            var data = jQuery.parseJSON(response);
            
            if (data.status == 1) {
            // window.location.href ="?page=custom-plugin2";
            // window.location.reload();
            document.getElementById('sc_product_type').innerText = document.getElementById('product_type').value;
            document.getElementById('shortcodedv').style.display="block";
            }
            });
        
            });
    
    
    // edit 
    
   
    
    
    
    
    
    //delete start
    
    
    jQuery(".closepop").on("click",function(){
    
    var sure = confirm('Are you sure, you want to delete this product!');
    
    // console.log(editid);
    if(sure){
    var postdata = "action=deletemyrantaldata&param=save_plugin&id="+this.id;
    // var postdata = "action=deletemyrantaldata&param=save_plugin&id="+b;
    jQuery.post(ajax_object,postdata,function(response){
    
    var data = jQuery.parseJSON(response);
    if(data.status==1){
    // console.log(response);
    window.location.reload();check
    }
    });
    }
    
    });

    
    
    //delete end

  // filling the check Availabity

   
    
    });
