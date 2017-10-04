$(function() {

    $('.mulselect').draggable();

    //////////////////////////// for Post Searching
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
                $(this).parent().prependTo("#sapdleleitem");
               // $("#sapdleleitem").show();
                count++;
            }
        });

        // Update the count
        var numberItems = count;
        //  $("#filter-count").text("Number of Comments = "+count);
    });

    //////////////////////// for Category Searching
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


    // function to hide color of other categories if one category is open
    function test(panel, cat, arr) {
        if ($("." + panel).is(":hidden")) {
            if ($("#container1 > .green").attr("itemid") == $("#" + cat + "> .newaddedclass").attr("id")) {
                $("#container1 > .green").removeClass("green");
            }
        }
        //if category is visible show the elements of Post in green color
        if ($("." + panel).is(":visible")) {
            jQuery.each(arr, function(val) {
                $("#container1 > #" + arr[val]).addClass("green");
            });
        }
    }

////////////////function to delete items from arrays
    function deleteitem (itemid) {
         var index1 = arr2.indexOf(itemid);
            if (index1 > -1) {
                arr2.splice(index1, 1);
            }
            main_array[category1] = arr2;

        var index2 = arr4.indexOf(itemid);
            if (index2 > -1) {
                arr4.splice(index2, 1);
            }
            main_array[category2] = arr4;

        var index3 = arr6.indexOf(itemid);
            if (index3 > -1) {
                arr6.splice(index3, 1);
            }
            // alert(arr6);
            main_array[category3] = arr6;

        var index4 = arr8.indexOf(itemid);
            if (index4 > -1) {
                arr8.splice(index4, 1);
            }
            // alert(arr8);
            main_array[category4] = arr8;

        var index5 = arr10.indexOf(itemid);
            if (index5 > -1) {
                arr10.splice(index5, 1);
            }
            // alert(arr10);
            main_array[category5] = arr10;

        var index6 = arr12.indexOf(itemid);
            if (index6 > -1) {
                arr12.splice(index6, 1);
            }
            // alert(arr12);
            main_array[category6] = arr12;

            console.log(main_array);
    }

    ////////////////////////////////////////////////////////////////////////////

    $('.flip1').click(function() {

        //to make other elements hide
        $('.panel2').slideUp("fast", function() {
            test('panel2', 'category2', arr4);
        });
        $('.panel3').slideUp("fast", function() {
            test('panel3', 'category3', arr6);
        });
        $('.panel4').slideUp("fast", function() {
            test('panel4', 'category4', arr8);
        });
        $('.panel5').slideUp("fast", function() {
            test('panel5', 'category5', arr10);
        });
        $('.panel6').slideUp("fast", function() {
            test('panel6', 'category6', arr12);
        });


        $('.panel1').slideToggle('slow', function() {
            test('panel1', 'category1', arr2);
        });
    });

    ///////////////////////////////////////////////////////

    $('.flip2').click(function() {
        $('.panel1').slideUp("fast", function() {
            test('panel1', 'category1', arr2);
        });
        $('.panel3').slideUp("fast", function() {
            test('panel3', 'category3', arr6);
        });
        $('.panel4').slideUp("fast", function() {
            test('panel4', 'category4', arr8);
        });
        $('.panel5').slideUp("fast", function() {
            test('panel5', 'category5', arr10);
        });
        $('.panel6').slideUp("fast", function() {
            test('panel6', 'category6', arr12);
        });

        $('.panel2').slideToggle('slow', function() {
            test('panel2', 'category2', arr4);
        });
    });
    //////////////////////////////////////////////////////////

    $('.flip3').click(function() {
        $('.panel1').slideUp("fast", function() {
            test('panel1', 'category1', arr2);
        });
        $('.panel2').slideUp("fast", function() {
            test('panel2', 'category2', arr4);
        });
        $('.panel4').slideUp("fast", function() {
            test('panel4', 'category4', arr8);
        });
        $('.panel5').slideUp("fast", function() {
            test('panel5', 'category5', arr10);
        });
        $('.panel6').slideUp("fast", function() {
            test('panel6', 'category6', arr12);
        });
        $('.panel3').slideToggle('slow', function() {
            test('panel3', 'category3', arr6);
        });
    });
    /////////////////////////////////////////////////////
    $('.flip4').click(function() {
        $('.panel1').slideUp("fast", function() {
            test('panel1', 'category1', arr2);
        });
        $('.panel2').slideUp("fast", function() {
            test('panel2', 'category2', arr4);
        });
        $('.panel3').slideUp("fast", function() {
            test('panel3', 'category3', arr6);
        });
        $('.panel5').slideUp("fast", function() {
            test('panel5', 'category5', arr10);
        });
        $('.panel6').slideUp("fast", function() {
            test('panel6', 'category6', arr12);
        });
        $('.panel4').slideToggle('slow', function() {
            test('panel4', 'category4', arr8);
        });
    });
    ////////////////////////////////////////////////////////////    

    $('.flip5').click(function() {
        $('.panel1').slideUp("fast", function() {
            test('panel1', 'category1', arr2);
        });
        $('.panel2').slideUp("fast", function() {
            test('panel2', 'category2', arr4);
        });
        $('.panel3').slideUp("fast", function() {
            test('panel3', 'category3', arr6);
        });
        $('.panel4').slideUp("fast", function() {
            test('panel4', 'category4', arr8);
        });
        $('.panel6').slideUp("fast", function() {
            test('panel6', 'category6', arr12);
        });
        $('.panel5').slideToggle('slow', function() {
            test('panel5', 'category5', arr10);
        });
    });
    ////////////////////////////////////////////////////////
    $('.flip6').click(function() {
        $('.panel1').slideUp("fast", function() {
            test('panel1', 'category1', arr2);
        });
        $('.panel2').slideUp("fast", function() {
            test('panel2', 'category2', arr4);
        });
        $('.panel3').slideUp("fast", function() {
            test('panel3', 'category3', arr6);
        });
        $('.panel4').slideUp("fast", function() {
            test('panel4', 'category4', arr8);
        });
        $('.panel5').slideUp("fast", function() {
            test('panel5', 'category5', arr10);
        });
        $('.panel6').slideToggle('slow', function() {
            test('panel6', 'category6', arr12);
        });
    });
    ///////////////////////////////////////////////////////////////////////////////////

    //on hover dropable item slide down ...

    $(".flip1").droppable({
        over: function() {
            $('.panel1').slideDown("slow");
        }
    });

    $(".flip2").droppable({
        over: function() {
            $('.panel2').slideDown("slow");
        }
    });

    $(".flip3").droppable({
        over: function() {
            $('.panel3').slideDown("slow");
        }
    });

    $(".flip4").droppable({
        over: function() {
            $('.panel4').slideDown("slow");
        }
    });


    $(".flip5").droppable({
        over: function() {
            $('.panel5').slideDown("slow");
        }
    });

    $(".flip6").droppable({
        over: function() {
            $('.panel6').slideDown("slow");
        }
    });

    ////////////////////////////////////////
    $(".panel1").droppable({
        out: function() {
            //$('.panel1').slideUp(2000);
        }
    });

    $(".panel2").droppable({
        out: function() {
           // $('.panel2').slideUp(2000);
        }
    });
    $(".panel3").droppable({
        out: function() {
           // $('.panel3').slideUp(2000);
        }
    });
    $(".panel4").droppable({
        out: function() {
            //$('.panel4').slideUp(2000);
        }
    });
    $(".panel5").droppable({
        out: function() {
           // $('.panel5').slideUp(2000);
        }
    });
    $(".panel6").droppable({
        out: function() {
           // $('.panel6').slideUp(2000);
        }
    });
    /////////////////////////////////////////////////////////////////

    var main_array = []; //big array
    var arr2 = [];
    var arr4 = [];
    var arr6 = [];
    var arr8 = [];
    var arr10 = [];
    var arr12 = [];
    var counter = 0;

    $('.box-item').draggable({
        cursor: 'move',
        helper: "clone",
        revert: 'invalid',
        start: function(e, ui) {
            ui.helper.animate({
                width: 60,
                height: 35
            });
        },
        cursorAt: {
            left: 30,
            top: 25
        }
    });

    ///////////////// to drag multiple elements
    //$("#container1 > div").draggable({
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

    /////////////////////////////////////////

    $("#container1").droppable({
        drop: function(event, ui) {
            var itemid = $(event.originalEvent.toElement).attr("itemid");
              if(ui.draggable.parent().attr("id")=="category1" || ui.draggable.parent().attr("id")=="category2" ||
                ui.draggable.parent().attr("id")=="category3" || ui.draggable.parent().attr("id")=="category4" ||
                ui.draggable.parent().attr("id")=="category5" || ui.draggable.parent().attr("id")=="category6"){ 
            if (ui.draggable.remove()) {
                counter -= 1; // to count number
            } // to remove the dragged item
        }else{
            alert("don't dragin itself");
        }
            var k = ui.draggable.attr("itemid");
            if (counter > 0) {} else {
                //if($(".box-item").attr("itemid")== k ){
                $(".box-item#"+itemid).removeClass("green"); // to remove the green background
            }

             deleteitem(itemid);//call to function to remove the element form array 
            
        }
    });
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // $("#category1").droppable({
    //     drop: function(event, ui) {

    //         var itemid = $(event.originalEvent.toElement).attr("itemid");
    //         var itemid1 = $(ui.draggable).attr("itemid");            

    //         if ($(ui.draggable).attr("itemid") === $("#category1 > #" + itemid1).attr("id")) {
    //             alert('Can Drag One Post Only Once In One Category');
    //         } else {
    //             // alert('in else');
    //             tag = ui.draggable;
    //             var a = tag.clone().attr("itemid",tag.attr("itemid")).appendTo("#category1").draggable({
    //                 cursor: 'move',
    //                 helper: "clone",
    //                 revert: 'invalid',
    //                   start: function (e, ui) {
    //                     ui.helper.animate({
    //                     width: 60,
    //                     height: 35
    //                     });
    //                 },
    //                     cursorAt: {left:30, top:25}
    //             });
    //             counter += 1;

    //             $(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
    //             $(a).addClass("newaddedclass");
    //             $(a).removeClass("green");
    //             $(ui.draggable).addClass("green");

    //             $(a).attr('id', itemid);

    //             // var type = 'category1';
    //             // arr2.push(itemid);
    //             // arr1[type] = arr2;

    //             arr2.push(itemid);
    //             main_array['category1']=arr2;
    //         }
    //     }
    // });
    //main_array.push(arr1);
    //  console.log(main_array);


$(document).on("click", ".cross", function(){
    console.log(this.parentNode.id);
    var itemid = this.parentNode.id;
    this.parentNode.remove();

    $(".box-item#"+itemid).removeClass("green");

    deleteitem(itemid);  // call to function to remove elements form array

});


////////////////////Dropping and dragging back again form category1
    $("#category1").droppable({
       // accept: '#divsecond:not(#category1)',
        drop: function(event, ui) {
            //console.log('dropped');
            var $this = $(this);
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");

            if ($(ui.draggable).attr("itemid") === $("#category1 > #" + itemid1).attr("id")) {
                // ('#container1 .check').prop('checked', false);
                alert('Can Drag One Post Only Once In One Category');

            } else {
                // alert('in else');

                ///////for single post dragging
                if (!ui.draggable.hasClass('active')) {
                    tag = ui.draggable;
                    var a = tag.clone().attr("itemid", tag.attr("itemid")).appendTo("#category1").draggable({
                        cursor: 'move',
                        helper: "clone",
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                    counter += 1;
                    $('#category1 input').remove();
                    var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                    $(a).addClass("newaddedclass");
                    $(a).removeClass("green");
                    // //new added
                    // $(a).removeClass("btn");
                    $(ui.draggable).addClass("green");
                    $(a).attr('id', itemid);
                    arr2.push(itemid1);
                }



                ///// for multiple post dragging
                if (ui.draggable.hasClass('active')) {
                   // console.log('active');
                    //ui.draggable.removeClass('active');
                    $('#container1 > .active').each(function() {
                        //console.log($(this).attr('id'));
                        var mulid = $(this).attr('id');
                        tag = ui.draggable;
                        //droping draged element and making it draggable again
                        var ab = $(this).clone().attr("id", $(this).attr("id")).appendTo("#category1").draggable({
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
                            left: 30,
                            top: 25
                        }
                    });
                        //$(this).remove();
                        var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(ab).append(del);
                        //$(ab).append("<img id='cross' style='float:right' src='cross.png' height='13px' width='13px'/>");
                        $(ab).addClass("newaddedclass");
                        $(".active").addClass("green");
                        $('#category1 input').remove();
                        $("#container1 .active").removeClass("active");
                        $(ab).removeClass("green");
                        $(ab).removeClass("active");
                        $('.check').prop('checked', false);

                        $(ab).attr('id', itemid);
                        arr2.push(mulid);
                    });
                }

                // arr2.push(itemid);

                main_array['category1'] = arr2;
            }
        }
    });


////////////////////Dropping and dragging back again form category2
    $("#category2").droppable({
        drop: function(event, ui) {
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
            if ($(ui.draggable).attr("itemid") === $("#category2 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                ///////for single post dragging
                if (!ui.draggable.hasClass('active')) {
                    tag = ui.draggable;
                    // var a = tag.clone().attr("itemid", "copy-" + tag.attr("itemid")).appendTo("#category2").draggable({
                    //     cursor: 'move',
                    //     helper: "clone",
                    //     revert: 'invalid'
                    // });

                    //droping draged element and making it draggable again
                    var a = tag.clone().attr("itemid", tag.attr("itemid")).appendTo("#category2").draggable({
                        cursor: 'move',
                        helper: "clone",
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                    counter += 1;
                    // $(a).addClass("newaddedclass");
                    // $(a).removeClass("green");
                    // $(ui.draggable).addClass("green");
                    $('#category2 input').remove();
                    var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                    //$(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                    $(a).addClass("newaddedclass");
                    $(a).removeClass("green");
                    $(ui.draggable).addClass("green");
                    $(a).attr('id', itemid);
                    arr4.push(itemid1);
                }

                ///// for multiple post dragging
                if (ui.draggable.hasClass('active')) {
                    //console.log('active');
                    $('#container1 > .active').each(function() {
                        // console.log($(this).attr('id'));
                        var mulid = $(this).attr('id');
                        tag = ui.draggable;
                        //droping draged element and making it draggable again
                        var ab = $(this).clone().attr("id", $(this).attr("id")).appendTo("#category2").draggable({
                        cursor: 'move',
                        helper: 'clone',
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                        //$(this).remove();
                         var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(ab).append(del);
                        //$(ab).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                        $(ab).addClass("newaddedclass");
                        $(".active").addClass("green");
                        $('#category2 input').remove();
                        $("#container1 .active").removeClass("active");
                        $(ab).removeClass("green");
                        $(ab).removeClass("active");
                        $('.check').prop('checked', false);

                        $(ab).attr('id', itemid);
                        arr4.push(mulid);
                    });
                }

                //arr4.push(itemid);
                main_array['category2'] = arr4;
            }
        }
    });
    //main_array.push(arr3);
    //  console.log(main_array);

////////////////////Dropping and dragging back again form category3
    $("#category3").droppable({
        drop: function(event, ui) {
            //console.log( event.target.id );

            // string3.category3 = category3;
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
            if ($(ui.draggable).attr("itemid") === $("#category3 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                if (!ui.draggable.hasClass('active')) {
                    tag = ui.draggable;
                    //droping draged element and making it draggable again
                    var a = tag.clone().attr("itemid", tag.attr("itemid")).appendTo("#category3").draggable({
                        cursor: 'move',
                        helper: "clone",
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                    counter += 1;

                    $('#category3 input').remove();
                    var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                    //$(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                    $(a).addClass("newaddedclass");
                    $(a).removeClass("green");
                    $(ui.draggable).addClass("green");
                    $(a).attr('id', itemid);
                    arr6.push(itemid1);
                }

                ///// for multiple post dragging
                if (ui.draggable.hasClass('active')) {
                    //console.log('active');
                    $('#container1 > .active').each(function() {
                        // console.log($(this).attr('id'));
                        var mulid = $(this).attr('id');
                        tag = ui.draggable;
                        //droping draged element and making it draggable again
                        var a = $(this).clone().attr("id", $(this).attr("id")).appendTo("#category3").draggable({
                        cursor: 'move',
                        helper: 'clone',
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                        //$(this).remove();
                         var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                        //$(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                        $(a).addClass("newaddedclass");
                        $(".active").addClass("green");
                        $('#category3 input').remove();
                        $("#container1 .active").removeClass("active");
                        $(a).removeClass("green");
                        $(a).removeClass("active");
                        $('.check').prop('checked', false);

                        $(a).attr('id', itemid);
                        arr6.push(mulid);
                    });
                }

                // arr6.push(itemid);
                main_array['category3'] = arr6;
            }
        }
    });
    // main_array.push(arr5);

////////////////////Dropping and dragging back again form category4
    $("#category4").droppable({
        drop: function(event, ui) {

            //console.log( event.target.id );

            //string4.category4 = category4;
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
            if ($(ui.draggable).attr("itemid") === $("#category4 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                if (!ui.draggable.hasClass('active')) {
                    tag = ui.draggable;
                    var a = tag.clone().attr("itemid", tag.attr("itemid")).appendTo("#category4").draggable({
                        cursor: 'move',
                        helper: "clone",
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                    counter += 1;

                    $('#category4 input').remove();
                    var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                    // $(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                    $(a).addClass("newaddedclass");
                    $(a).removeClass("green");
                    $(ui.draggable).addClass("green");
                    $(a).attr('id', itemid);
                    arr8.push(itemid1);
                }

                ///// for multiple post dragging
                if (ui.draggable.hasClass('active')) {
                    //console.log('active');
                    $('#container1 > .active').each(function() {
                        // console.log($(this).attr('id'));
                        var mulid = $(this).attr('id');
                        tag = ui.draggable;
                        //droping draged element and making it draggable again
                        var a = $(this).clone().attr("id", $(this).attr("id")).appendTo("#category4").draggable({
                        cursor: 'move',
                        helper: 'clone',
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                        //$(this).remove();
                         var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                        //$(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                        $(a).addClass("newaddedclass");
                        $(".active").addClass("green");
                        $('#category4 input').remove();
                        $("#container1 .active").removeClass("active");
                        $(a).removeClass("green");
                        $(a).removeClass("active");
                        $('.check').prop('checked', false);

                        $(a).attr('id', itemid);
                        arr8.push(mulid);
                    });
                }

                // arr8.push(itemid);
                main_array['category4'] = arr8;
            }
        }
        //   });
        // }
    });
    //main_array.push(arr7);


////////////////////Dropping and dragging back again form category5
    $("#category5").droppable({
        drop: function(event, ui) {

            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
            if ($(ui.draggable).attr("itemid") === $("#category5 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                if (!ui.draggable.hasClass('active')) {
                    tag = ui.draggable;
                    //droping draged element and making it draggable again
                    var a = tag.clone().attr("itemid", tag.attr("itemid")).appendTo("#category5").draggable({
                        cursor: 'move',
                        helper: "clone",
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                    counter += 1;
                    $('#category5 input').remove();
                    var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                    // $(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                    $(a).addClass("newaddedclass");
                    $(a).removeClass("green");
                    $(ui.draggable).addClass("green");
                    $(a).attr('id', itemid);
                    arr10.push(itemid1);
                }

                ///// for multiple post dragging
                if (ui.draggable.hasClass('active')) {
                    //console.log('active');
                    $('#container1 > .active').each(function() {
                        // console.log($(this).attr('id'));
                        var mulid = $(this).attr('id');
                        tag = ui.draggable;
                        //droping draged element and making it draggable again
                        var a = $(this).clone().attr("id", $(this).attr("id")).appendTo("#category5").draggable({
                        cursor: 'move',
                        helper: 'clone',
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                        //$(this).remove();
                         var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                        //$(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                        $(a).addClass("newaddedclass");
                        $(".active").addClass("green");
                        $('#category5 input').remove();
                        $("#container1 .active").removeClass("active");
                        $(a).removeClass("green");
                        $(a).removeClass("active");
                        $('.check').prop('checked', false);

                        $(a).attr('id', itemid);
                        arr10.push(mulid);
                    });
                }

                // arr10.push(itemid);
                main_array['category5'] = arr10;
            }
        }
    });
    //    main_array.push(arr9);

////////////////////Dropping and dragging back again form category6
    $("#category6").droppable({
        drop: function(event, ui) {
            var itemid = $(event.originalEvent.toElement).attr("itemid");
            var itemid1 = $(ui.draggable).attr("itemid");
            if ($(ui.draggable).attr("itemid") === $("#category6 > #" + itemid1).attr("id")) {
                alert('Can Drag One Post Only Once In One Category');
            } else {
                if (!ui.draggable.hasClass('active')) {
                    tag = ui.draggable;
                    //droping draged element and making it draggable again
                    var a = tag.clone().attr("itemid", tag.attr("itemid")).appendTo("#category6").draggable({
                        cursor: 'move',
                        helper: "clone",
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                    counter += 1;
                    $('#category6 input').remove();
                    var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                    // $(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                    $(a).addClass("newaddedclass");
                    $(a).removeClass("green");
                    $(ui.draggable).addClass("green");
                    $(a).attr('id', itemid);
                    arr12.push(itemid1);
                }
       
                ///// for multiple post dragging
                if (ui.draggable.hasClass('active')) {
                    //console.log('active');
                    $('#container1 > .active').each(function() {
                        // console.log($(this).attr('id'));
                        var mulid = $(this).attr('id');
                        tag = ui.draggable;
                        var a = $(this).clone().attr("id", $(this).attr("id")).appendTo("#category6").draggable({
                        cursor: 'move',
                        helper: 'clone',
                        revert: 'invalid',
                        start: function(e, ui) {
                            ui.helper.animate({
                                width: 60,
                                height: 35
                            });
                        },
                        cursorAt: {
                            left: 30,
                            top: 25
                        }
                    });
                        //$(this).remove();
                         var del = "<button type='button' style='float:right;' class='cross'><img src='cross.png' height='8px' width='8px'/></button>" ;
                     $(a).append(del);
                        //$(a).append("<img id='cross'style='float:right' src='cross.png' height='13px' width='13px'/>");
                        $(a).addClass("newaddedclass");
                        $(".active").addClass("green");
                        $('#category6 input').remove();
                        $("#container1 .active").removeClass("active");
                        $(a).removeClass("green");
                        $(a).removeClass("active");
                        $('.check').prop('checked', false);

                        $(a).attr('id', itemid);
                        arr12.push(mulid);
                    });
                }

                // arr12.push(itemid);
                main_array['category6'] = arr12;
            }
        }
    });
    //main_array.push(arr11);
    console.log(main_array);
    //console.log(main_array.toString());

});