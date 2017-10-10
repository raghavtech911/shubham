<?php 
    session_start();
    error_reporting(0);
    require __DIR__.'/vendor/autoload.php';
    use phpish\shopify;
    require __DIR__.'/conf.php';
?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href='<?php echo SHOPIFY_SITE_URL."ScriptLink/jquery.dataTables.min.css"?>' >

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='<?php echo SHOPIFY_SITE_URL."ScriptLink/jquery.dataTables.min.js"?>'></script>

<script>

    $( function() {
        $( "#tabs" ).tabs();

    });

    ShopifyApp.init({
      apiKey: '<?php echo SHOPIFY_APP_API_KEY; ?>',
        shopOrigin: 'https://<?php echo $_SESSION["shop"]; ?>',
    });

</script>
    
<?php 

if(!empty($_SESSION['shop'])){
    $shop = $_SESSION['shop'];
}
else{
    $shop = $_SESSION['shop'] = $_GET['shop'];
}

if(!empty($_SESSION['oauth_token'])){
    $oauth_token = $_SESSION['oauth_token'];
}
else{
    $dir                = split("/",getcwd());
    $config_table_name  = "shopify_App_".end($dir);

    $sql    = "SELECT * FROM $config_table_name WHERE shop ='$shop' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {       
        while($row = mysqli_fetch_assoc($result)) {
            $oauth_token = $row['oauth_token'];
        }
    } 
}    

    $shopify = shopify\client($shop, SHOPIFY_APP_API_KEY , $oauth_token);   // Authentication credentials

    //  Note : This is js file which will load the proxy file to your store front end

    $app_load = SHOPIFY_SITE_URL."js/app_load_Marker_map.js";            // Script ----> "SRC"   

    // Note : app_load.js is the JS File Name. According to your file name change js file name.

    $ScriptCount = $shopify('GET /admin/script_tags/count.json');           // Get total count of scripts

    $ScriptDetails = $shopify('GET /admin/script_tags.json');               // Get details of all scripts

    if ($ScriptCount == 0) {                                                // Check count if count = 0 then load script      

    $js_scripts = $shopify('POST /admin/script_tags.json', array(),         // Add script
        array
        (
        'script_tag' => 
          array
            (
            "event" => "onload",
            "src" => $app_load,
            )
        )
      );
    }

    if ($ScriptCount > 1) {                                                 // If count > 1 then delete all scripts and add 1 script 
       
        foreach ($ScriptDetails as $key => $value) {        
                if ($ScriptDetails[$key]["src"] == $app_load){              // Check script src with our loading src. If matched then delete that script
                    $ScriptDelete = $shopify('DELETE /admin/script_tags/'.$ScriptDetails[$key]["id"].'.json');                
                }        
        }                                                               
        $js_scripts = $shopify('POST /admin/script_tags.json', array(),     // After deleting all scripts. Add Script
            array
            (
            'script_tag' => 
              array
                (
                "event" => "onload",
                "src" => $app_load,
                )
            )
          );
    }

?>

<!DOCTYPE html>
<html>

  <head>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css" />
     <!-- <link rel="stylesheet" href="style.css" /> -->
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    
    <!-- <script src="script.js"></script> -->
<style type="text/css">
    
.box-container {
    height: 100% !important;
}

.box-item {
    width: 100%;
    z-index: 1000;
}

/*.panel1, .panel2, .panel3, .panel4, .panel5, .panel6 {
    padding: 40px;
    display: none;
    z-index: 100;
}


.hh {
    padding: 40px;
    display: none;
    z-index: 100;
}*/

.green{
    background-color:lightgreen;
}

.red{
    background-color:lightgreen;
}

 /*div.ui-selectee {border: 4px solid #aaa; background-color:#44c765}
      div.ui-selecting {border:4px dotted #000; background-color:yellow;}*/

/*
.draggable-helper {
    width:120px;
    display:inline-block;
    list-style-type:none;
}*/

#container1 .btn{  
/*border-bottom:1px solid black;*/
border:1px solid black;

}

.check{
    float: left;
}

#container1 div{
    margin-bottom: 5px;
}

.active{
    background-color: #ADD8E6;
}

.newaddedclass{
    border:1px solid black;
}

div .newaddedclass{
    margin-bottom: 5px;
}

</style>

  </head>

  <body>
    <div class="container-fluid">
      <div class="row">
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="panel panel-default" style="margin-top: 20px;">
            <div class="panel-heading">
              <h1 class="panel-title"><input type="text" name="search" autocomplete="off" placeholder="Search Products" class="text-input" id="filter"><!-- <span id="filter-count"></span> -->
            </div>

            <!-- to show list of products -->
            <?php $data = $shopify('GET /admin/products.json'); ?>
            <div id="container1" class="panel-body box-container" style="overflow: scroll;">
            <?php foreach ($data as $key) { ?>
            <div id="<?php echo $key['id'];?>" itemid="<?php echo $key['id'];?>" class="btn box-item"><input id="check" class="check" type="checkbox"  ><span style="word-break:normal; white-space: normal;"><?php echo $key["title"]; ?></span></div>
            <?php  } ?>
            <!-- end showing list of products -->
            </div>
          </div>
        </div>

        <div>
            <input class="text-input2" id="filter2" style="float:right; margin-top: 15px; margin-right: 41px;" type="text" autocomplete="off" name="search" placeholder=" Search Collection"><span id="filter-count"></span>
        </div>
        <div id="divsecond">
         <!-- <button id="btnclick">click</button> -->
                <div class="col-md-9" style="margin-top: 41px; ">
                    <div class="row">
        <?php
            // To get Collection List
                $collection = $shopify('GET /admin/custom_collections.json');
                foreach ($collection as $key) {
                    // echo "<pre>";
                    // print_r($collection);
                    // echo "</pre>";          
        ?>
        <!--showing collection list-->
            <div class="col-md-4" style="min-height:150px">
                <div class="panel panel-default">
                    <div class="<?php echo $key['id']; ?> panel-heading" style="background-color:#dfedf2;">
                        <h1 class="panel-title"><strong><?php echo $key["title"];?></strong>
                        <span style="float:right;"><img src="down.png" height="12px" width="12px"></span></h1>
                    </div>
                <div style="padding: 40px; display: none; z-index: 100; height: 170px; overflow: scroll;" class="<?php echo $key['handle'];?>" id="<?php echo $key['id'];?>" class="panel-body box-container"></div>
          </div>
        </div>
 <?php } ?>       
            <!--End showing collection list-->

      </div>

      <?php

// $createCollection = array("collect"=> array("product_id"=> 151613407255, "collection_id"=> 6832848919 ));  
//       $collectionList = $shopify('POST /admin/collects.json', array(), $createCollection);
//       echo "<pre>";
//       print_r($collectionList);
//       echo '</pre>';

      
      ?>
    </div>
    </div>
    </div>
    </div>
  </body>
</html>

<!------------------------------------------------------ End HTML - Start Jquery ------------------------------------------>

<script type="text/javascript">
    $(function() {  
        var collection= <?php echo json_encode($collection); ?>;
        var product = <?php echo json_encode($data); ?>;
        var main_array = [];
       // var arr=[];
        var counter = 0;   

//----------------------------------------------------- for Product Searching --------------------------------------
    $("#filter").keyup(function() {
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(),
            count = 0;
        // Loop through the comment list
        $("#container1 div span").each(function() {
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                //$(this).fadeOut();
                // Show the list item if the phrase matches and increase the count by 1
            } else {
                //$(this).show();
                $(this).parent().prependTo("#container1");
               // $("#sapdleleitem").show();
                count++;
            }
        });
        // Update the count
        var numberItems = count;
        //  $("#filter-count").text("Number of Comments = "+count);
    });

    //--------------------------------------------- for Collection Searching--------------------------------
    $("#filter2").keyup(function() {
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(),
            count = 0;
        // Loop through the comment list
        $("#divsecond h1 strong").each(function() {
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                //$(this).fadeOut();
                $(this).closest("div").parent().fadeOut();
                //$(this).parent().fadeOut();
                // Show the list item if the phrase matches and increase the count by 1
            } else {
                //$(this).show();
                // $(this).closest("div").parent().addClass("active").show;
                $(this).closest("div").parent().show();
                //$(this).parent().closest("div").prependTo("#sapdlelicategory");
                //$(this).parent().parent().show();
                count++;
            }
        });
        // Update the count
        var numberItems = count;
        $("#filter-count").text("Number of Categories = " + count);
    });

//--------------------------------------------FUNCTIONS -------------------------------------------------------

    // function to hide color of other collections if one collection is open
    function test(panel, cat, arr) {
        $.each(arr[cat], function(key,val) {
        if ($("." + panel).is(":hidden")) {
            
          //  if ($("#container1 > .green").attr("itemid") === $("#" + cat + "> .newaddedclass").attr("id")) {

                // if collection is hidden hide the elements of Products in green color
                if ($("#container1 > #"+val).attr("id") === $("#" + cat +"> #"+val).attr("id")) {
                $("#container1 > .green").removeClass("green");
            }
        }

        //if collection is visible show the elements of Post in green color
        if ($("." + panel).is(":visible")) {
           // $.each(arr[cat], function(key,val) {
                $("#container1 > #" +val).addClass("green");
           // });
        }
    });
    }

  //---------------------------------function to delete items from arrays------------------------------

    function deleteitem (coll_id,itemid) {
        var index1 = $.inArray(itemid, main_array[coll_id]);
            if (index1 > -1) {
                  main_array[coll_id].splice(index1, 1);
                }

                     // sending ajax request to delete collect for dragged product
                     $.ajax({
                            type: "POST",
                            url: "<?php echo SHOPIFY_SITE_URL; ?>collectdel.php",
                            data: { coll_id : coll_id, prod_id : itemid }, 

                            success: function(data){
                                console.log(data);
                          }
                    });

         console.log(main_array);
    }

//----------------------------------------- To select and deselect products from multidrag---------------------------

    $('#container1 :checkbox').click(function() {
    var $this = $(this);
    // $this will contain a reference to the checkbox   
    if ($this.is(':checked')) {
        // the checkbox was checked, call the function to addClass
        $($this).closest("div").addClass("active"); 
    } else {
        // the checkbox was unchecked, call the function to removeClass
        $($this).closest("div").removeClass("active");
    }
});

//------------------------------------------------------------------------------------------------------------------

$.each(collection, function(val){
    var handle = collection[val].handle;
    var ids = collection[val].id;
    $('.'+ids).click(function() {
        
        //to make other elements hide
          // $('.'+handle).slideUp("fast", function() {
          //   console.log('hhhi');
          //    //test(handle, ids, main_array);
          // });

        $('.'+handle).slideToggle('slow', function() {
            test(handle, ids, main_array);
        });
    });
//-------------------------------------------------------------------------------
    //on hover collection panel slide down ...

    $("."+ids).droppable({
        over: function() {
            $('.'+handle).slideDown("slow");
        }
    });

    $("."+handle).droppable({
        out: function() {
            $('.'+handle).slideUp("slow");
        }
    });
});// end each loop    
//--------------------------------------------------------------------------------

    // make the products draggble
    $('.box-item').draggable({
        cursor: 'move',
         helper: "clone",
        revert: 'invalid',
        appendTo: '#divsecond',
        start: function(e, ui) {
           
         remember = $(this).html();
        var numItems = 1; 
        numItems = $('#container1 .active').length;
        if(numItems>1){
         ui.helper.html("<strong style='display:inline-block;'>Copy "+numItems+" Products </strong>");
     }else{
        ui.helper.html("<strong style='display:inline-block;'>Copy 1 Product </strong>");
     }

            ui.helper.animate({
                width: 100,
                height: 40,
            });
        },
        cursorAt: {
            left: 10,
            top: 10
        },

        stop: function(e, ui) {
        $(this).html(remember);
    }

  //       start: function(event, ui) {
  //   $(ui.helper).css('width', "35%");
  //    $(ui.helper).css('height', "20%");
  // },
  //  cursorAt: {
  //            left: 30,
  //            top: 25
  //        }

    });

//-------------------------------------- to drag multiple elements------------------------------

    $(".box-item").draggable({
        revert: 'invalid',
        helper: function(event) {
            var helperList = $('<ul class="draggable-helper">');
            if ($(this).is('.active')) {
                helperList.append($(this).siblings('.active').andSelf().clone());
            } else {
                helperList.append($(this).clone());
            }
            return helperList;
        }
    });
    
//--------------------------------------- make the container dropable and delete the dragged element-----------------------

    $("#container1").droppable({
        drop: function(event, ui) {
            //var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid = $(ui.draggable).attr("itemid");
                $.each(collection, function(val){
                     var aa = collection[val].id;
                     //console.log("this is:"+ui.draggable.parent().attr("id"));
                        if(ui.draggable.parent().attr("id") == aa){
                            var coll_id = ui.draggable.parent().attr("id");
                                ui.draggable.remove(); // to remove the dragged item
                                counter--;
                                deleteitem(coll_id,itemid); //call to function to remove the element form array 
                                   //if (counter > 0) {} else {
                                   $("#"+itemid).removeClass("green");
                               //}
                }
            });        
        }
    });

//----------------------------------------------------------------------------------------------------------------------

// to delete the product if clicked on cross button on right of product
$(document).on("click", ".cross", function(){
    // console.log(this.parentNode.id);
    var itemid = this.parentNode.id;
    //alert(itemid);
    var coll_id = this.closest("div").parentNode.id;
    // alert(coll_id);
    this.parentNode.remove();
    counter--;

     //if (counter > 0) {} else {
        $("#"+itemid).removeClass("green");
    //}
    deleteitem(coll_id,itemid);  // call to function to remove elements form array
});


//-----------------------------------Dropping and dragging back again form collections-----------------

//console.log(collection);

$.each(collection, function(val){
    var ids = collection[val].id;
    var handle = collection[val].handle;
    var temp= [];
        $("#"+ids).droppable({ 
            drop: function(event, ui) {
                var $this = $(this);
                var itemid = $(event.originalEvent.toElement).attr("itemid");
                var itemid1 = $(ui.draggable).attr("itemid");

                        if ($(ui.draggable).attr("itemid") === $("#"+ids+" > #" + itemid1).attr("id")) {
                            // ('#container1 .check').prop('checked', false);
                            alert('Can Drag One Post Only Once In One Category');
                            } else {

                                    //------------------for single product dragging into collections----------
                                        if (!ui.draggable.hasClass('active')) {
                                            tag = ui.draggable;
                                            var a = tag.clone().attr("itemid", tag.attr("itemid")).appendTo("#"+ids).draggable({
                                                cursor: 'move',
                                                helper: "clone",
                                                revert: 'invalid',
                                                // start: function(e, ui) {
                                                //     ui.helper.animate({
                                                //         width: 60,
                                                //         height: 35
                                                //  });
                                                // },
                                                // cursorAt: {
                                                //     left: 30,
                                                //     top: 17
                                                // }
                                                start: function(event, ui) {
                                                    $(ui.helper).css('width', "35%", 'height', "35%");
                                                     $(ui.helper).css('height', "20%");
                                                         }
                                                    });


                                                
                                                var cat_id = $(a).closest("div").parent().attr('id');
                                                // sending ajax request to create collect for dragged product
                                                 $.ajax({
                                                        type: "POST",
                                                        url: "<?php echo SHOPIFY_SITE_URL; ?>getcollect.php",
                                                        // data: category_idgh, 
                                                        data: { coll_id : cat_id, prod_id : itemid1 }, 

                                                        success: function(data){
                                                      }
                                                });


                             //   to remove the extra button which gets added to anothrer collection if it is dragged form one collection
                                    if($(ui.draggable).find(':button').length > 0){                                
                                          $('#'+ids+'>#'+itemid1+'>.cross').remove();
                                            }

                                counter++;

                                $('#'+ids+' input').remove(); // to remove the checkbox from dropped element
                                //$('#'+ids+'#"'+itemid+'button').remove();

                                var del = "<button id='delbtn' type='button' style='float:right;' class='cross'><img src='cross.png'  height='8px' width='8px'/></button>" ;

                                $(a).append(del);
                                $(a).addClass("newaddedclass");
                                $(a).removeClass("green");

                                $(ui.draggable).addClass("green");

                                // // to remove green color of dragged element if it is dragged from one collection to another
                                // if($(ui.draggable.hasClass("newaddedclass")) || $(a).parent().attr('class')==handle){
                                //     //alert('has class new');
                                //     //alert($(a).parent().attr('class'));
                                //         $(ui.draggable).removeClass("green");                                    
                                // }

                                $(a).attr('id', itemid);

                                var category_id =$(a).closest("div").parent().attr('id'); // get ID of current collection
                                temp.push(itemid1);
                                main_array[category_id] = temp;         
                               console.log(main_array);    
                                    
                                    //-----this is IMP-------
                                    //alert("in");
                                    //  $.each(main_array, function (i, news) {
                                    //    alert(i+":"+news);
                                    // });
                                    // ----------------------
                                }
                            }


                //----------------------------- for multiple post dragging-----------------------

                if (ui.draggable.hasClass('active')) {
        
                    $('#container1 > .active').each(function() {
                        var mulid = $(this).attr('id');  //get id of current dragged items  

                    //to check the element already existed in the collection
                        if($.inArray(mulid, main_array[ids])!== -1){
                        }else{
                        
                        //droping draged element and making it draggable again
                                var ab = $(this).clone().attr("id", $(this).attr("id")).appendTo("#"+ids).draggable({
                                cursor: 'move',
                                helper: 'clone',
                                revert: 'invalid',
                                start: function(e, ui) {
                                    ui.helper.animate({
                                        width: 70,
                                        height: 35
                                    });
                                },
                                cursorAt: {
                                    left: 35,
                                    top: 17
                                }
                                });

                                var cat_id =$(ab).closest("div").parent().attr('id');
                                $.ajax({
                                        type: "POST",
                                        url: "<?php echo SHOPIFY_SITE_URL; ?>getcollect.php",
                                        data: { coll_id : cat_id, prod_id : mulid }, 

                                        success: function(data){}
                                                });

                        
                        var del = "<button id='delbtn' type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                        $(ab).append(del);
                        counter++;
                        $(ab).addClass("newaddedclass");
                        $(".active").addClass("green");
                        $('#'+ids+' input').remove();
                        $("#container1 .active").removeClass("active");
                        $(ab).removeClass("green");
                        $(ab).removeClass("active");
                        $('.check').prop('checked', false);
                        $(ab).attr('id', itemid);
                        
                        var cal_id =$(ab).closest("div").parent().attr('id'); // get ID of current collection
                        temp.push(mulid);
                        main_array[cal_id]=temp;
                        //console.log(main_array);
                        }// end if

                        });
                    } //close active if
                //}
            }
        }); // dropable close
    }); //each loop over


console.log(main_array);

});// document function close

</script>
