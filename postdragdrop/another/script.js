$(function() {

// function to hide color of other categories if one category is open
    function test(panel, cat, arr){
        if ($("."+panel).is(":hidden")) {
                if ($("#container1 > .green").attr("itemid") == $("#"+cat +"> .newaddedclass").attr("id")) {
                    $("#container1 > .green").removeClass("green");
                }
            }
            //if category is visible show the elements of Post in green color
            if ($("."+panel).is(":visible")) {
                jQuery.each(arr, function(val) {
                    $("#container1 > #" + arr[val]).addClass("green");
                });
            }
    }
////////////////////////////////////////////////////////////////////////////

    $('.flip1').click(function() {

        //to make other elements hide
        $('.panel2').slideUp("fast",function(){
            test('panel2','category2',arr4);
        });
        $('.panel3').slideUp("fast",function(){
            test('panel3','category3',arr6);
        });
        $('.panel4').slideUp("fast",function(){
            test('panel4','category4',arr8);
        });
        $('.panel5').slideUp("fast",function(){
            test('panel5','category5',arr10);
        });
        $('.panel6').slideUp("fast",function(){
            test('panel6','category6',arr12);
        });


        $('.panel1').slideToggle('slow', function() {
            test('panel1','category1',arr2);
         });
    });

    ///////////////////////////////////////////////////////

    $('.flip2').click(function() {
        $('.panel1').slideUp("fast",function(){
            test('panel1','category1',arr2);
        });
        $('.panel3').slideUp("fast",function(){
            test('panel3','category3',arr6);
        });
        $('.panel4').slideUp("fast",function(){
            test('panel4','category4',arr8);
        });
        $('.panel5').slideUp("fast",function(){
            test('panel5','category5',arr10);
        });
        $('.panel6').slideUp("fast",function(){
            test('panel6','category6',arr12);
        });

        $('.panel2').slideToggle('slow', function() {
            test('panel2','category2',arr4);
        });
    });
//////////////////////////////////////////////////////////

    $('.flip3').click(function() {
        $('.panel1').slideUp("fast",function(){
            test('panel1','category1',arr2);
        });
        $('.panel2').slideUp("fast",function(){
            test('panel2','category2',arr4);
        });
        $('.panel4').slideUp("fast",function(){
            test('panel4','category4',arr8);
        });
        $('.panel5').slideUp("fast",function(){
            test('panel5','category5',arr10);
        });
        $('.panel6').slideUp("fast",function(){
            test('panel6','category6',arr12);
        });
        $('.panel3').slideToggle('slow',function(){
            test('panel3','category3',arr6);
        });
    });
/////////////////////////////////////////////////////
    $('.flip4').click(function() {
        $('.panel1').slideUp("fast",function(){
            test('panel1','category1',arr2);
        });
        $('.panel2').slideUp("fast",function(){
            test('panel2','category2',arr4);
        });
        $('.panel3').slideUp("fast",function(){
            test('panel3','category3',arr6);
        });
        $('.panel5').slideUp("fast",function(){
            test('panel5','category5',arr10);
        });
        $('.panel6').slideUp("fast",function(){
            test('panel6','category6',arr12);
        });
        $('.panel4').slideToggle('slow',function(){
            test('panel4','category4',arr8);
        });
    });
////////////////////////////////////////////////////////////    

    $('.flip5').click(function() {
        $('.panel1').slideUp("fast",function(){
            test('panel1','category1',arr2);
        });
        $('.panel2').slideUp("fast",function(){
            test('panel2','category2',arr4);
        });
        $('.panel3').slideUp("fast",function(){
            test('panel3','category3',arr6);
        });
        $('.panel4').slideUp("fast",function(){
            test('panel4','category4',arr8);
        });
        $('.panel6').slideUp("fast",function(){
            test('panel6','category6',arr12);
        });
        $('.panel5').slideToggle('slow',function(){
            test('panel5','category5',arr10);
        });
    });
////////////////////////////////////////////////////////
    $('.flip6').click(function() {
            $('.panel1').slideUp("fast",function(){
            test('panel1','category1',arr2);
        });
            $('.panel2').slideUp("fast",function(){
            test('panel2','category2',arr4);
        });
            $('.panel3').slideUp("fast",function(){
            test('panel3','category3',arr6);
        });
            $('.panel4').slideUp("fast",function(){
            test('panel4','category4',arr8);
        });
            $('.panel5').slideUp("fast",function(){
            test('panel5','category5',arr10);
        });
        $('.panel6').slideToggle('slow',function(){
            test('panel6','category6',arr12);
        });
    });
 ///////////////////////////////////////////////////////////////////////////////////

 //on hover dropable item slide down ...
 
$(".flip1").droppable({
        over: function(){
            $('.panel1').slideDown("slow");
        }
    });   

$(".flip2").droppable({
        over: function(){
            $('.panel2').slideDown("slow");
        }
    });   

$(".flip3").droppable({
        over: function(){
            $('.panel3').slideDown("slow");
        }
    });   

$(".flip4").droppable({
        over: function(){
            $('.panel4').slideDown("slow");
        }
    });   

$(".flip5").droppable({
        over: function(){
            $('.panel5').slideDown("slow");
        }
    });   

$(".flip6").droppable({
        over: function(){
            $('.panel6').slideDown("slow");
        }
    });   
/////////////////////////////////////////////////////////////////

    var arr0 = []; //big array
    var arr1 = []; var arr2 = []; var arr3 = []; var arr4 = []; var arr5 = []; var arr6 = []; var arr7 = []; var arr8 = []; var arr9 = [];
    var arr10 = []; var arr11 = []; var arr12 = [];
    var counter = 0;

    $('.box-item').draggable({
        cursor: 'move',
        helper: "clone",
        revert: 'invalid'
    });


    $("#container1").droppable({
        drop: function(event, ui) {
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            if (ui.draggable.remove()) {
                counter -= 1;
            } // to remove the dragged item
            var k = ui.draggable.attr("itemid");
            if (counter > 0) {} else {
                //if($(".box-item").attr("itemid")== k ){
                $(".box-item").removeClass("green"); // to remove the green background
            }

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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $("#category1").droppable({
        drop: function(event, ui) {

            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");            

            if ($(ui.draggable).attr("itemid") === $("#category1 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                // alert('in else');
                tag = ui.draggable;
                var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category1").draggable({
                    cursor: 'move',
                    helper: "clone",
                    revert: 'invalid'
                });
                counter += 1;

                $(a).addClass("newaddedclass");
                $(a).removeClass("green");
                $(ui.draggable).addClass("green");

                $(a).attr('id', itemid);

                var type = 'category1';
                arr2.push(itemid);
                arr1[type] = arr2;
            }
        }
    });
    arr0.push(arr1);
    //  console.log(arr0);


    $("#category2").droppable({
        drop: function(event, ui) {
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
            if ($(ui.draggable).attr("itemid") === $("#category2 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                tag = ui.draggable;
                var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category2").draggable({
                    cursor: 'move',
                    helper: "clone",
                    revert: 'invalid'
                });
                counter += 1;
                $(a).addClass("newaddedclass");
                $(a).removeClass("green");
                $(ui.draggable).addClass("green");
                $(a).attr('id', itemid);
                var type = 'category2';
                arr4.push(itemid);
                arr3[type] = arr4;
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
            if ($(ui.draggable).attr("itemid") === $("#category3 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                tag = ui.draggable;
                var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category3").draggable({
                    cursor: 'move',
                    helper: "clone",
                    revert: 'invalid'
                });
                counter += 1;
                $(a).addClass("newaddedclass");
                $(a).removeClass("green");
                $(ui.draggable).addClass("green");
                $(a).attr('id', itemid);

                var type = 'category3';
                arr6.push(itemid);
                arr5[type] = arr6;
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
            if ($(ui.draggable).attr("itemid") === $("#category4 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
               
                tag = ui.draggable;
                var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category4").draggable({
                    cursor: 'move',
                    helper: "clone",
                    revert: 'invalid'
                });
                counter += 1;
                $(a).addClass("newaddedclass");
                $(a).removeClass("green");
                $(ui.draggable).addClass("green");
                $(a).attr('id', itemid);
               
                var type = 'category4';
                arr8.push(itemid);
                arr7[type] = arr8;
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
            if ($(ui.draggable).attr("itemid") === $("#category5 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                tag = ui.draggable;
                var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category5").draggable({
                    cursor: 'move',
                    helper: "clone",
                    revert: 'invalid'
                });
                counter += 1;
                $(a).addClass("newaddedclass");
                $(a).removeClass("green");
                $(ui.draggable).addClass("green");
                $(a).attr('id', itemid);

                var type = 'category5';
                arr10.push(itemid);
                arr9[type] = arr10;
            }
        }
    });
    arr0.push(arr9);

    $("#category6").droppable({
        drop: function(event, ui) {
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
            if ($(ui.draggable).attr("itemid") === $("#category6 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                tag = ui.draggable;
                var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category6").draggable({
                    cursor: 'move',
                    helper: "clone",
                    revert: 'invalid'
                });
                counter += 1;
                $(a).addClass("newaddedclass");
                $(a).removeClass("green");
                $(ui.draggable).addClass("green");
                $(a).attr('id', itemid);

                var type = 'category6';
                arr12.push(itemid);
                arr11[type] = arr12;
            }
        }
    });
    arr0.push(arr11);
    console.log(arr0);
    //console.log(arr0.toString());

});