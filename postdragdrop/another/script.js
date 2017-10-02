$(function() {



    function test(arr){
        if ($(".panel2").is(":hidden")) {
                if ($("#container1 > .green").attr("itemid") == $("#category2 > .newaddedclass").attr("id")) {
                    $("#container1 > .green").removeClass("green");
                }
            }
            //if category is visible show the elements of Post in green color
            if ($(".panel2").is(":visible")) {
                jQuery.each(arr, function(val) {
                    $("#container1 > #" + arr[val]).addClass("green");
                });
            }
    }

    $('.flip1').click(function() {

        //to make other elements hide
        $('.panel2').slideUp("fast",function(){
            test(arr4);
        });
        $('.panel3').slideUp("fast",function(){
            
        });
        $('.panel4').slideUp("fast");
        $('.panel5').slideUp("fast");
        $('.panel6').slideUp("fast");

        $('.panel1').slideToggle('slow', function() {
            //if category is hidden don't show the elements of Post in green color
            if ($(this).is(":hidden")) {
                if ($("#container1 > .green").attr("itemid") == $("#category1 > .newaddedclass").attr("id")) {
                    $("#container1 > .green").removeClass("green");
                }
            }
            //if category is visible show the elements of Post in green color
            if ($(this).is(":visible")) {
                jQuery.each(arr2, function(val) {
                    $("#container1 > #" + arr2[val]).addClass("green");
                });
            }
        });
    });

    $('.flip2').click(function() {
        $('.panel1').slideUp("fast");
        $('.panel3').slideUp("fast");
        $('.panel4').slideUp("fast");
        $('.panel5').slideUp("fast");
        $('.panel6').slideUp("fast");
        $('.panel2').slideToggle('slow', function() {
              //if category is hidden don't show the elements of Post in green color
             if ($(this).is(":hidden")) {
                if ($("#container1 > .green").attr("itemid") == $("#category2 > .newaddedclass").attr("id")) {
                    $("#container1 > .green").removeClass("green");
                }
            }
            //if category is visible show the elements of Post in green color
            if ($(this).is(":visible")) {
                jQuery.each(arr4, function(val) {
                    $("#container1 > #" + arr4[val]).addClass("green");
                });
            }
        });
    });

    $('.flip3').click(function() {
        $('.panel1').slideUp("fast");
        $('.panel2').slideUp("fast");
        $('.panel4').slideUp("fast");
        $('.panel5').slideUp("fast");
        $('.panel6').slideUp("fast");
        $('.panel3').slideToggle('slow',function(){
              //if category is hidden don't show the elements of Post in green color
            if ($(this).is(":hidden")) {
                if ($("#container1 > .green").attr("itemid") == $("#category3 > .newaddedclass").attr("id")) {
                    $("#container1 > .green").removeClass("green");
                }
            }
            //if category is visible show the elements of Post in green color
            if ($(this).is(":visible")) {
                jQuery.each(arr6, function(val) {
                    $("#container1 > #" + arr6[val]).addClass("green");
                });
            }
        });
    });

    $('.flip4').click(function() {
        $('.panel1').slideUp("fast");
        $('.panel2').slideUp("fast");
        $('.panel3').slideUp("fast");
        $('.panel5').slideUp("fast");
        $('.panel6').slideUp("fast");
        $('.panel4').slideToggle('slow',function(){
              //if category is hidden don't show the elements of Post in green color
            if ($(this).is(":hidden")) {
                if ($("#container1 > .green").attr("itemid") == $("#category4 > .newaddedclass").attr("id")) {
                    $("#container1 > .green").removeClass("green");
                }
            }
            //if category is visible show the elements of Post in green color
            if ($(this).is(":visible")) {
                jQuery.each(arr8, function(val) {
                    $("#container1 > #" + arr8[val]).addClass("green");
                });
            }
        });
    });

    $('.flip5').click(function() {
        $('.panel1').slideUp("fast");
        $('.panel2').slideUp("fast");
        $('.panel3').slideUp("fast");
        $('.panel4').slideUp("fast");
        $('.panel6').slideUp("fast");
        $('.panel5').slideToggle('slow',function(){
              //if category is hidden don't show the elements of Post in green color
            if ($(this).is(":hidden")) {
                if ($("#container1 > .green").attr("itemid") == $("#category5 > .newaddedclass").attr("id")) {
                    $("#container1 > .green").removeClass("green");
                }
            }
            //if category is visible show the elements of Post in green color
            if ($(this).is(":visible")) {
                jQuery.each(arr10, function(val) {
                    $("#container1 > #" + arr10[val]).addClass("green");
                });
            }
        });
    });

    $('.flip6').click(function() {
            $('.panel1').slideUp("fast");
            $('.panel2').slideUp("fast");
            $('.panel3').slideUp("fast");
            $('.panel4').slideUp("fast");
            $('.panel5').slideUp("fast");
        $('.panel6').slideToggle('slow',function(){
              //if category is hidden don't show the elements of Post in green colors
            if ($(this).is(":hidden")) {
                if ($("#container1 > .green").attr("itemid") == $("#category6 > .newaddedclass").attr("id")) {
                    $("#container1 > .green").removeClass("green");
                }
            }
            //if category is visible show the elements of Post in green color
            if ($(this).is(":visible")) {
                jQuery.each(arr12, function(val) {
                    $("#container1 > #" + arr12[val]).addClass("green");
                });
            }
        });
    });

    var arr0 = []; //big array
    var arr1 = [];
    var arr2 = [];
    var arr3 = [];
    var arr4 = [];
    var arr5 = [];
    var arr6 = [];
    var arr7 = [];
    var arr8 = [];
    var arr9 = [];
    var arr10 = [];
    var arr11 = [];
    var arr12 = [];
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