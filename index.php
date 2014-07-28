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
         var reloadTabs = new Array();
         var reloadTask = null;
         
         // @philip: start review
         var tabFocus = 0;
         var colNumber = 1;
         
         // min Column width is 280px...
         var twoCol = window.matchMedia("only screen and (min-width: 560px)")
         var treeCol = window.matchMedia("only screen and (min-width: 840px)")
         var fourCol = window.matchMedia("only screen and (min-width: 1120px)")
         
         function mediaqueryresponse(){
            if (twoCol.matches){
               colNumber = 2;
            } else if (treeCol.matches){
               colNumber = 3;
            } else if (fourCol.matches){
               colNumber = 4;
            } else {
               colNumber = 1;
            }
            setColWidth(colNumber);
            setVisibility(tabFocus, colNumber);
         }
         
         window.addEventListener('resize', mediaqueryresponse, true);
         mediaqueryresponse() // call listener function explicitly at run time
         
         function setColWidth(colNumber) {
            var colWidth = 100/colNumber;
            for (var i = 0; i < 4; i++) {
               element('content' + i).style.width = colWidth + '%';
            }
         }
         
         function setVisibility(tabFocus, colNumber) {
            if (tabFocus < colNumber) {
               for (var i = 0; i < 4; i++) {
                  if (i <= tabFocus) {
                     element('content' + i).style.display = 'block';
                  } else{
                     element('content' + i).style.display = 'none';
                  }
               }
            }
            else {
               for (var i = 0; i < 4; i++) {
                  if (i <= tabFocus && i >= (tabFocus-colNumber)) {
                     element('content' + i).style.display = 'block';
                  } else{
                     element('content' + i).style.display = 'none';
                  }
               }
            }
         }
         // @philip: finish review
         

        function element(id) {
            return document.getElementById(id);
        }
       
         function initReload( input, tabId ) {
        
            var result = input.match( /<reload interval=\"([0-9]+)\" *\/ *>/ );
            if ( result != null && result.length > 0 ) {
                  
                  var found = false;
                  for (var i = 0; i < reloadTabs.length && !found; ++i) {
                     found = ( reloadTabs[i] == tabId);
                  }

                  if ( found ) {
                     return;
                  }
      
                  if ( reloadTask != null ) {
                     clearInterval( reloadTask );
                  }
                  reloadTask = window.setInterval("reloadTasks()", RegExp.$1 * 1000 );

            }

         }

         function reloadTasks() {
            for (var i = 0; i < reloadTabs.length; i++) {
               getHttpRequest( reloadTabs[i], tabParameter[reloadTabs[i]], true );
            }
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
            element('content0').classList.remove('drilldown1');
            element('content1').classList.remove('drilldown1');
            element('content2').classList.remove('drilldown1');
            element('content3').classList.remove('drilldown1');
            tabFocus--;
        }



        function drilldown(index, parameter) {
            // @philip: meine strategie:
            // 1. drilldown nur (evtl) nštig, wenn tab nicht bereits sichtbar, sonst update
            // wenn drilldown, dann bisher nicht sichtbares tab sichtbar machen, alle tabs nach links verschieben und dann sichtbarkeit neu setzen (das tab, das links rausgeschoben wurde unsichtbar machen)
            // setzen der sichtbarkeit mŸsste wohl als funktion ausgefŸhrt sein, abhŠngig von der spaltenzahl...
            if (element('content' + index).style.display == 'none') {
               element('content' + index).style.display = 'block';
               var colWidth = element('content' + i).style.width;
               var left = "";
               for (var i = 0; i < 4; i++) {
                  left = (i-index)*colWidth + "%";
                  element('content' + i).style.left = left;
               }
               
            }
            add = 'drilldown' + index;
            for (var i = 0; i < 4; i++) {
               element('content' + i).classList.add(add);
            }
            tabFocus = index;
            getHttpRequest(index, parameter, false); 
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
                  tabParameter[index] = xmlhttp.responseText;
                  if ( tabParameter[index] == "" ) {
                     tabParameter[index] = null;
                  }
                  refreshTab();
                } else {
                    element(elementId).innerHTML = xmlhttp.status;
                    tabParameter[index] = null;
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
            element(elementId).innerHTML = '<div class="headspacer"></div>Seite wird geladen';
            xmlhttp.open("GET", "content.php?index=" + index + "&" + parameter, false);
            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState != 4) {
                    element(elementId).innerHTML = '<div class="headspacer"></div>Seite wird geladen ...';
                } else if(xmlhttp.status == 200) {
                    element(elementId).innerHTML = xmlhttp.responseText;
                     initReload( xmlhttp.responseText, index );
                } else {
                    element(elementId).innerHTML = xmlhttp.status;
                }
            }
            xmlhttp.send(null);
        }

      </script>
   </head>
<?php
   print( "<body onLoad=\"getHttpRequest(0, '" . Page::getParameter('menu', 'menuList') . "', false)\">" );
?>

      <div class="header">
         <div class="but_back" onclick="drillup()"><</div>
         <div class="but_menu"><p><a href="login.php">log<br />out</a></p></div>
         <div class="title">
            <h1>Current Module Title</h1>
            <h1 class=sub>
               <?php
                  $user = CommonDbFunction::getUser();         
                  if ( $user != null ) {
                     print(" Logged in as: " . $user->user . " (" . $user->role . "/" . $user->raceName . ") " );
                  }
               ?>
            </h1>
         </div>
      </div>
      <div class="content0 drilldown0" id="content0"> </div>
      <div class="content1 drilldown0" id="content1"> </div>
      <div class="content2 drilldown0" id="content2"> </div>
      <div class="content3 drilldown0" id="content3"> </div>
   </body>
</html>



