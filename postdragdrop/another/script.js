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

$('.box-item').draggable({
    cursor: 'move',
    helper: "clone"
  });

// $("#category1").droppable({
// over: function(event, ui){
//         arr1.push(event.target.id);
//         }
//     });


 
  var string1 = {};
  var category1 = [] 
   var string2 = {};
  var category2 = [] 
   var string3 = {};
  var category3 = [] 
   var string4 = {};
  var category4 = [] 
   var string5 = {};
  var category5 = [] 
   var string6 = {};
  var category6 = []



  $("#container1").droppable({
    drop: function(event, ui) {
      var itemid = $(event.originalEvent.toElement).attr("itemid");
      $('.newaddedclass').each(function() {
        if ($(this).attr("itemid") === itemid) {
          $(this).appendTo("#container1");
        }
      });
    }
  });

var arr1=[];
var arr2=[];

var arr3=[];
var arr4=[];

var arr5=[];
var arr6=[];

var arr7=[];
var arr8=[];

var arr9=[];
var arr10=[];

var arr11=[];
var arr12=[];

  $("#category1").droppable({
    drop: function(event, ui) {

        $(ui.draggable).addClass("newaddedclass");
        $(ui.draggable).addClass("red");
       
       // $(ui.draggable).attr('id', 'newid');
       // console.log( event.target.id );
        

        //         arr1[i].pop(event.target.id);  
        //arr1.push(event.target.id);
        
       
        var itemid = $(event.originalEvent.toElement).attr("itemid");
        
        $('.newaddedclass').each(function() {
            if ($(this).attr("itemid") === itemid) {
                    //var draggable = ui.draggable;
                    //var id = draggable.attr("itemid");
 
                $(this).clone().appendTo("#category1");
                
               // var aa=[0,1,2,3,4,5,6,7,8,9,10];
                
                    // var employee = {
                    // "key": itemid,
                    // }
                    
                 //    for(i=0; i<=20; i++){
                 // var employee = {
                 //     "status":[[i],[itemid]]
                 //        }            
                 //     }  

                //string1.category1.push(employee);
               //  console.log(JSON.stringify(string1));
                //console.log(itemid);
           
                var type='category1';
                arr2.push(itemid);
                arr1[type]= arr2;
                console.log(arr1);
            }
        });
    }
   });



  $("#category2").droppable({
    drop: function(event, ui) {
        $(ui.draggable).addClass("newaddedclass");
          $(ui.draggable).addClass("green");
        //console.log( event.target.id );
        //arr2.push(event.target.id);

        // string2.category2 = category2;
      var itemid = $(event.originalEvent.toElement).attr("itemid");
      $('.newaddedclass').each(function() {
        if ($(this).attr("itemid") === itemid) {
          $(this).clone().appendTo("#category2");

                  //  var employee = {
                  //  key: itemid,                
         //  }
               // string2.category2.push(employee);
                   // console.log(JSON.stringify(string2));

                var type='category2';
                arr4.push(itemid);
                arr3[type]= arr4;
                console.log(arr3);
        }
      });

    }
  });



  $("#category3").droppable({
    drop: function(event, ui) {
        $(ui.draggable).addClass("newaddedclass");
          $(ui.draggable).addClass("blue");
        //console.log( event.target.id );
        
        // string3.category3 = category3;
      var itemid = $(event.originalEvent.toElement).attr("itemid");
      $('.newaddedclass').each(function() {
        if ($(this).attr("itemid") === itemid) {
          $(this).clone().appendTo("#category3");
            //         var employee = {
            //         key: itemid,              
            // }
            //     string3.category3.push(employee);
            //         console.log(JSON.stringify(string3));

                var type='category3';
                arr6.push(itemid);
                arr5[type]= arr6;
                console.log(arr5);
               }
          });
        }
  });



    $("#category4").droppable({
        drop: function(event, ui) {
            $(ui.draggable).addClass("newaddedclass");
              $(ui.draggable).addClass("pink");
            //console.log( event.target.id );
            
            //string4.category4 = category4;
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            $('.newaddedclass').each(function() {
                if ($(this).attr("itemid") === itemid) {
                    $(this).clone().appendTo("#category4");
            //         var employee = {
            //         key: itemid,
            // }
            //     string4.category4.push(employee);
            //         console.log(JSON.stringify(string4));

                    var type='category4';
                arr8.push(itemid);
                arr7[type]= arr8;
                console.log(arr7);
        }
      });
    }
  });



  $("#category5").droppable({
    drop: function(event, ui) {
        $(ui.draggable).addClass("newaddedclass");
          $(ui.draggable).addClass("dark");
        //console.log( event.target.id );
         
         // string5.category5 = category5;
      var itemid = $(event.originalEvent.toElement).attr("itemid");
      $('.newaddedclass').each(function() {
        if ($(this).attr("itemid") === itemid) {
          $(this).clone().appendTo("#category5");
            //         var employee = {
            //         key: itemid,   
            // }
            //     string5.category5.push(employee);
            //         console.log(JSON.stringify(string5));


                var type='category5';
                arr10.push(itemid);
                arr9[type]= arr10;
                console.log(arr9);
        }
      });
    }
  });



  $("#category6").droppable({
    drop: function(event, ui) {
        $(ui.draggable).addClass("newaddedclass");
          $(ui.draggable).addClass("light");
       // console.log( event.target.id );
        
        // string6.category6 = category6;
      var itemid = $(event.originalEvent.toElement).attr("itemid");
      $('.newaddedclass').each(function() {
        if ($(this).attr("itemid") === itemid) {
          $(this).clone().appendTo("#category6");
            //         var employee = {
            //         i: itemid,
            // }
            //     string6.category6.push(employee);
            //     console.log(JSON.stringify(string6));

                var type='category6';
                arr12.push(itemid);
                arr11[type]= arr12;
                console.log(arr11);
        }
      });
    }
  });


  // $("#category1").dragable({
  //       drop: function(event, ui) {
  //         //  $(ui.dragable).draggable('destroy');
  //            // $(ui.dragable).remove();
  //       }
  // });



});
