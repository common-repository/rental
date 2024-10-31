<?php 
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

  ?>
<div class="container">
    <h2 class="list_of_clients"> Here is the list of your clients </h2>
    
    <?php
    global $wpdb;
    $results24 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}checkavailabity ", OBJECT );
              echo "<div class='row clrow'>";
              
              foreach($results24 as $key25=>$value26){
                  $id = $results24[$key25]->id;
                  $ClientEmailid = $results24[$key25]->ClientEmailid;
                  $productlocation = $results24[$key25]->productlocation;
                  $start_date =  $results24[$key25]->start_date;
                  $starttime = $results24[$key25]->starttime;
                  $end_date = $results24[$key25]->end_date;
                  $endtime = $results24[$key25]->endtime;
                echo "<div class='col-md-10 cldv' style='margin-top:1%; border: 1px solid #0073aa; margin-right: 8%; padding-left: 2%; padding-right:2%; display:flex; justify-content: space-between;'><p style='width:5%;'> ".esc_attr($id)." </p><p style='width:20%;'>".esc_attr($ClientEmailid)."</p><p style='width:20%;'>".esc_attr($productlocation)."</p><p style='width:20%;'> From ".esc_attr($start_date)." / ".esc_attr($starttime)."</p><p style='width:20%;'> To ".esc_attr($end_date)." / ".esc_attr($endtime)."</p><p style='cursor: pointer;' class='deleteClient' id='".esc_attr($id)."'><i class='fa fa-trash'></i></p></div>";
                echo "<script>console.log('Debug Objects: " .esc_attr($id). " - " .esc_attr($ClientEmailid). "' );</script>";
            }
                ?>
            </div>
        </div>

<style>
.deleteClient
{
    color: #0073aa;
}

</style>
<script>
jQuery(".deleteClient").on("click",function(){
    
    var sure = confirm('Are you sure, you want to delete this product!');
    
    // console.log(editid);
    if(sure){
    var postdata = "action=checkavailabitydatadelete&param=save_plugin&id="+this.id;
    // var postdata = "action=deletemyrantaldata&param=save_plugin&id="+b;
    jQuery.post(ajax_object,postdata,function(response){
    
    var data = jQuery.parseJSON(response);
    if(data.status==1){
    // console.log(response);
    window.location.reload();
    }
    });
    }
    
    });
</script>

