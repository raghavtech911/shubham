$(document).ready(function() {
 
/* on hover slidedown */
$('.flip1').mouseover(function(){
        $('.panel1').slideDown('slow');
    });

$('.flip2').mouseover(function(){
        $('.panel2').slideDown('slow');
    });

$('.flip3').mouseover(function(){
        $('.panel3').slideDown('slow');
    });

$('.flip4').mouseover(function(){
        $('.panel4').slideDown('slow');
    });

$('.flip5').mouseover(function(){
        $('.panel5').slideDown('slow');
    });
$('.flip6').mouseover(function(){
        $('.panel6').slideDown('slow');
    });


/* on click slideup */
$('.flip1').click(function(){
        $('.panel1').slideUp('slow');
    });
$('.flip2').click(function(){
        $('.panel2').slideUp('slow');
    });
$('.flip3').click(function(){
        $('.panel3').slideUp('slow');
    });
$('.flip4').click(function(){
        $('.panel4').slideUp('slow');
    });
$('.flip5').click(function(){
        $('.panel5').slideUp('slow');
    });
$('.flip6').click(function(){
        $('.panel6').slideUp('slow');
    });
     

/* make element dragable */ 
  // $('.box-item').draggable({
  //    helper: "clone"
  // });

// $("#category1").droppable({
// over: function(event, ui){
//         arr1.push(event.target.id);
//         }
//     });


  // var string1 = {};
  // var category1 = [] 
  //  var string2 = {};
  // var category2 = [] 
  //  var string3 = {};
  // var category3 = [] 
  //  var string4 = {};
  // var category4 = [] 
  //  var string5 = {};
  // var category5 = [] 
  //  var string6 = {};
  // var category6 = []

var arr0=[]; var arr1=[]; var arr2=[]; var arr3=[]; var arr4=[]; var arr5=[]; var arr6=[]; var arr7=[]; var arr8=[]; var arr9=[]; 
var arr10=[]; var arr11=[]; var arr12=[]; 


$('.box-item').draggable({
    cursor: 'move',
    helper: "clone",
    revert: 'invalid'
  });

var counter = 0;

  $("#container1").droppable({
    drop: function(event, ui) {
      var itemid = $(event.originalEvent.toElement).attr("itemid");
            if(ui.draggable.remove()){
                counter-=1;
            } // to remove the dragged item
            var k =ui.draggable.attr("itemid");
            if(counter>0){}else{
            //if($(".box-item").attr("itemid")== k ){
            $(".box-item").removeClass("green"); // to remove the green background
            
           }

           //}
           //remove the element form array 
            arr2.pop(itemid);
            arr4.pop(itemid);
            arr6.pop(itemid);
            arr8.pop(itemid);
            arr10.pop(itemid);
            arr12.pop(itemid);
            console.log(arr0);
    }
  });


  $("#category1").droppable({
    drop: function(event, ui) {
        
        var itemid = $(event.originalEvent.toElement).attr("itemid");
       // alert(itemid);
        var itemid1 = $(ui.draggable).attr("itemid");
       // alert(itemid1); 
        //alert($("#"+itemid1).attr("id"));
        // if($(this).children(".box-item").attr("id") == itemid1) {
        // alert("cancel");    //Instead want to cancel dragging of item
        //     return false;
        //   //  location.reload();
        //  }else{            

            if($(ui.draggable).attr("itemid") === $("#category1 > #"+itemid1).attr("id")){
                alert('Can Drag One Post Only Once In One Category');
            }
                else{
                   // alert('in else');
                    tag=ui.draggable;
                    var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category1" ).draggable({ cursor: 'move', 
                            helper: "clone", revert: 'invalid'});
                        counter+=1;

                    $(a).addClass("newaddedclass");
                    $(a).removeClass("green");
                    $(ui.draggable).addClass("green");
                    
                    $(a).attr('id',itemid);

                
                    // var employee = {
                    // "key": itemid,
                    // }

                //string1.category1.push(employee);
               //  console.log(JSON.stringify(string1));
                //console.log(itemid);
           
                var type='category1';
                arr2.push(itemid);
                arr1[type]= arr2; 
            }
    }
   });
  arr0.push(arr1);
//  console.log(arr0);


  $("#category2").droppable({
        drop: function(event, ui) {
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
            if($(ui.draggable).attr("itemid") === $("#category2 > #"+itemid1).attr("id")){
                alert('Can Drag One Post Only Once In One Category');
            }
                else{
            tag=ui.draggable;
            var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category2" ).draggable({cursor: 'move',
                    helper: "clone", revert: 'invalid'});
            counter+=1;
            $(a).addClass("newaddedclass");
            $(a).removeClass("green");
            $(ui.draggable).addClass("green");
            $(a).attr('id',itemid);
            var type='category2';
            arr4.push(itemid);
            arr3[type]= arr4;
            // console.log(arr3);
        }
    }
});
   arr0.push(arr3);
//  console.log(arr0);


  $("#category3").droppable({
    drop: function(event, ui) {
        //console.log( event.target.id );
        
        // string3.category3 = category3;
      var itemid = $(event.originalEvent.toElement).attr("itemid");
       var itemid1 = $(ui.draggable).attr("itemid");
        if($(ui.draggable).attr("itemid") === $("#category3 > #"+itemid1).attr("id")){
                alert('Can Drag One Post Only Once In One Category');
            }
                else{
                // if($(ui.draggable).attr('copy-'+"itemid") === $("#"+itemid1).attr('copy-'+itemid)){
                  //      alert('same element');
                    //}
      //$('.newaddedclass').each(function() {
       // if ($(this).attr("itemid") === itemid) {
        //  $(this).clone().appendTo("#category3");
           tag=ui.draggable;
                    var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category3" ).draggable({ cursor: 'move',
                            helper: "clone", revert: 'invalid' });
                    counter+=1;
            $(a).addClass("newaddedclass");
                $(a).removeClass("green");
            $(ui.draggable).addClass("green");
            $(a).attr('id',itemid);
            //         var employee = {
            //         key: itemid,              
            // }
            //     string3.category3.push(employee);
            //         console.log(JSON.stringify(string3));

                var type='category3';
                arr6.push(itemid);
                arr5[type]= arr6;
                //console.log(arr5);
               }
           }
        //   });
        // }
  });
  arr0.push(arr5);



    $("#category4").droppable({
        drop: function(event, ui) {
            
            //console.log( event.target.id );
            
            //string4.category4 = category4;
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
        if($(ui.draggable).attr("itemid") === $("#category4 > #"+itemid1).attr("id")){
                alert('Can Drag One Post Only Once In One Category');
            }
                else{
           // $('.newaddedclass').each(function() {
             //   if ($(this).attr("itemid") === itemid) {
               //     $(this).clone().appendTo("#category4");

                    tag=ui.draggable;
                    var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category4" ).draggable({ cursor: 'move', 
                            helper: "clone", revert: 'invalid' });
                    counter+=1;
                    $(a).addClass("newaddedclass");
                        $(a).removeClass("green");
                    $(ui.draggable).addClass("green");
                        $(a).attr('id',itemid);
            //         var employee = {
            //         key: itemid,
            // }
            //     string4.category4.push(employee);
            //         console.log(JSON.stringify(string4));

                    var type='category4';
                    arr8.push(itemid);
                    arr7[type]= arr8;
        }
    }
    //   });
    // }
  });
    arr0.push(arr7);

  $("#category5").droppable({
    drop: function(event, ui) {
        
      var itemid = $(event.originalEvent.toElement).attr("itemid");
      var itemid1 = $(ui.draggable).attr("itemid");
        if($(ui.draggable).attr("itemid") === $("#category5 > #"+itemid1).attr("id")){
                alert('Can Drag One Post Only Once In One Category');
            }
                else{
      tag=ui.draggable;
                    var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category5" ).draggable({ cursor: 'move',
                            helper: "clone", revert: 'invalid' });
                    counter+=1;
                    $(a).addClass("newaddedclass");
                        $(a).removeClass("green");
                     $(ui.draggable).addClass("green");
                         $(a).attr('id',itemid);

                var type='category5';
                arr10.push(itemid);
                arr9[type]= arr10;
        }
    }
  });
  arr0.push(arr9);


  $("#category6").droppable({
    drop: function(event, ui) {
        var itemid = $(event.originalEvent.toElement).attr("itemid");
        var itemid1 = $(ui.draggable).attr("itemid");
        if($(ui.draggable).attr("itemid") === $("#category6 > #"+itemid1).attr("id")){
                alert('Can Drag One Post Only Once In One Category');
            }
                else{
        tag=ui.draggable;
        var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category6" ).draggable({ cursor: 'move',
                helper: "clone", revert: 'invalid' });
        counter+=1;
        $(a).addClass("newaddedclass");
            $(a).removeClass("green");
        $(ui.draggable).addClass("green");
            $(a).attr('id',itemid);

                var type='category6';
                arr12.push(itemid);
                arr11[type]= arr12;
        }
    }
  });
  arr0.push(arr11);
  console.log(arr0);
  //console.log(arr0.toString());

});
