function myFunction() {
             document.getElementById("demo").innerHTML = 
		"<textarea class='input' cols = '15' rows = '6' name='text' id='text_id' class='form-control' style='resize:vertical; ' ></textarea>";
 }

function openCity(evt, cityName) {
             var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                 tabcontent[i].style.display = "none";
             }
             tablinks = document.getElementsByClassName("tablinks");
             for (i = 0; i < tablinks.length; i++) {
                 tablinks[i].className = tablinks[i].className.replace(" active", "");
             }
             document.getElementById(cityName).style.display = "block";
             evt.currentTarget.className += " active";
  }


function openCitya(evt, cityName) {
             var i, tabcontent1, tablink;
              tabcontent1 = document.getElementsByClassName("tabcontent1");
              for (i = 0; i < tabcontent1.length; i++) {
                 tabcontent1[i].style.display = "none";
             }
             tablink = document.getElementsByClassName("tablink");
             for (i = 0; i < tablinks.length; i++) {
                 tablink[i].className = tablink[i].className.replace(" active", "");
             }
             document.getElementById(cityName).style.display = "block";
             evt.currentTarget.className += " active";
  }
