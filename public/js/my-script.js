function openNav() {
  document.getElementById("mySidenav").style.width = "80%";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
/* but-menu-welcome */
function openCity(cityName, elmnt, color) {
  tablinks = document.getElementsByClassName("tab-link");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  document.getElementById(cityName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

function openCitys(cityName, elmnt, color) {
  tablinks = document.getElementsByClassName("tab-links");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  document.getElementById(cityName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

function getCity(dropdown) {
  var catagory = dropdown.options[dropdown.selectedIndex].value;
  var dataString = "city="+catagory;
  $.ajax(
    {
    type: "GET",
    url: "../get_city.blade.php", // Name of the php files
    data: dataString,
    success: function(html)
      {
        $("#showGetCity").html(html);
      }
    }
  );
}














