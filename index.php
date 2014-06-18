<?php 
   include "core/include.php";
   $dbFunction = new CommonDbFunction();
   $user = $dbFunction->determineCurrentUSer();
   if ( $user == null) {
      print("<head><meta http-equiv='refresh' content='0; URL=login.php' /></head> ");
      exit;
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <title>MeoRace</title>
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
      <link href="design.css" rel="stylesheet">
      <script language = 'JavaScript'>
         
         var tabParameter = new Array();
        function element(id) {
            return document.getElementById(id);
        }
        
        function toggleMenu() {
            if(element('but_menu').innerHTML == 'a' ) {
               element('but_menu').innerHTML = 'b';
               element('menu').classList.add('menu_unfold');
            } else {
               element('but_menu').innerHTML = 'a';
               element('menu').classList.remove('menu_unfold');
            }
        }
        
        function drillup() {
            element('content0').classList.remove('drilldown');
            element('content1').classList.remove('drilldown');
            element('content2').classList.remove('drilldown');
            element('content3').classList.remove('drilldown');
        }



        function drilldown(index, parameter) {
            element('content0').classList.add('drilldown');
            element('content1').classList.add('drilldown');
            element('content2').classList.add('drilldown');
            element('content3').classList.add('drilldown');
            getHttpRequest(index, parameter); 
        }

         
         function postHttpRequest() {
            var xmlhttp = null;


            var data = '';
            var elements = element('myForm').elements;
            var index = -1;
            for(var i = 0; i < elements.length; i++) {
               if ( elements[i].name == "index" ) {
                  index = elements[i].value;
               }
               data += elements[i].name + "=";
              if ( elements[i].type != "checkbox" ) {
                  data += elements[i].value;
               } else {
                  data += elements[i].checked ? 1 : 0;
               }
               data += "&";
            } 
            
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }


            elementId = 'content' + index;
            element(elementId).innerHTML = 'Seite wird geladen';
            xmlhttp.open("POST", "commit.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.setRequestHeader("Content-length", data.length);

            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState != 4) {
                    element(elementId).innerHTML = 'Seite wird geladen ...';
                } else if(xmlhttp.status == 200) {
                    element(elementId).innerHTML = xmlhttp.responseText;
                    refreshTab();
                } else {
                    element(elementId).innerHTML = xmlhttp.status;
                }
            }
            xmlhttp.send(data);
            return false;
         }
        
         function refreshTab() {
            for (var i = 0; i < tabParameter.length; i++) {
               if ( tabParameter[i] != null ) {
                  getHttpRequest( i, tabParameter[i], true );
               } else {
                  element("content" + i).innerHTML = "";
               }
            }
          }
        
         function getHttpRequest( index, parameter, refresh ) {
            if ( typeof refresh == 'undefined' ) {
               refresh = false;
            }
            
            tabParameter[index] = parameter;
            for ( i = index + 1; !refresh && i < tabParameter.length; i++ ) {
               tabParameter[i] = null;
               element("content" + i).innerHTML = "";
            }
            var xmlhttp = null;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            elementId = 'content' + index;
            element(elementId).innerHTML = 'Seite wird geladen';
            xmlhttp.open("GET", "content.php?index=" + index + "&" + parameter, false);
            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState != 4) {
                    element(elementId).innerHTML = 'Seite wird geladen ...';
                } else if(xmlhttp.status == 200) {
                    element(elementId).innerHTML = xmlhttp.responseText;
                } else {
                    element(elementId).innerHTML = xmlhttp.status;
                }
            }
            xmlhttp.send(null);
        }

      </script>
   </head>
<?php
   print( "<body onLoad=\"getHttpRequest(0, '" . Page::getParameter('menu', 'menuList') . "')\">" );
?>

      <div class="menu" id="menu">
         <div class="header">
            <div class="but_back" onclick="drillup()"><</div>
            <div class="nav_button" onclick="drilldown()">menu 2</div>
            <div class="nav_button">menu 3</div>
            <div class="but_menu" id="but_menu" onclick="toggleMenu()">aaa</div>
            <div class="title" onclick="getHttpRequest();"> Title </div>
         </div>
      </div>

      <div class="content0" id="content0"> </div>
      <div class="content1" id="content1"> </div>
      <div class="content2" id="content2"> </div>
      <div class="content3" id="content3"> </div>
   </body>
</html>



