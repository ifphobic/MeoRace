<?php 
   include "core/include.php";
   $dbFunction = new CommonDbFunction();
   $user = $dbFunction->determineCurrentUSer();
?>
<!DOCTYPE html>
<html>
   <head>
      <title>MeoRace</title>
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
      <link href="core/html/design.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
      <script language = 'JavaScript'>

         var numberOfTabs = 5;
         var screenSizes = new Array( 1120, 840, 560 ); 
         var currentTab = 0;
         var viewportLeftIndex = 0;
         var numberOfColums = 0;
         var tabParameter = new Array();
         
         // ---------- screen resize ---------
         function resizeScreen() {
            var newNumber = determineNumberOfColumns();
            if ( newNumber != numberOfColums ) {
               numberOfColums = newNumber;
               setColumnWidth();
               setVisibility();
               setLeft();
               //moveToCurrentTab();
            }
            showTab(currentTab);
         }
         
         function determineNumberOfColumns() {
            var counter = screenSizes.length + 1;
            for ( var i = 0; i < screenSizes.length; i++ ) {
               if ( window.matchMedia("only screen and (min-width: " + screenSizes[i] + "px)").matches ) {
                  return counter;
               }
               counter--;
            }
            return counter;
         }
         
         function setColumnWidth() {
            var columnWidth = 100 / numberOfColums;
            for (var i = 0; i < numberOfTabs; i++) {
               element('content' + i).style.width = columnWidth + '%';
            }
         }

         // ---------- show tab ----------
         function showTab( tabIndex ) {
            currentTab = tabIndex;
            viewportMove = determineViewportMove( tabIndex );
            if ( viewportMove == 0 ) {
               return;
            } 
            numberOfColums += Math.abs(viewportMove);
            setVisibility();
            numberOfColums -= Math.abs(viewportMove);
            viewportLeftIndex += viewportMove;
            setTimeout("setLeft()", 1);
            setTimeout("setVisibility()", 200);
            //moveToCurrentTab();
         }

         function determineViewportMove( tabIndex ) {
            if ( tabIndex < viewportLeftIndex ) {
               return tabIndex - viewportLeftIndex;
            } else if ( tabIndex < ( viewportLeftIndex + numberOfColums ) ) {
               return 0;
            } else {
               return tabIndex - ( viewportLeftIndex + numberOfColums ) + 1;
            }
         }

         //function moveToCurrentTab() {
         //   for (var i = 0; i < numberOfTabs; i++) {
         //      setVisibility(i);
         //      setLeft(i);
         //   }
         //}

         function setVisibility() {
            for (var i = 0; i < numberOfTabs; i++) {
               var visible = ( i >= viewportLeftIndex && i < (viewportLeftIndex + numberOfColums) );
               element('content' + i).style.display = ( visible) ? 'block' : 'none';
//            alert ( "visible: " + visible + " index: " + index + " viewPortLeft: " + viewportLeftIndex + " numberOfColums: " + numberOfColums );
            }
         }
         
         function setLeft() {
            for (var i = 0; i < numberOfTabs; i++) {
               var left = ( i - viewportLeftIndex ) * 100 / numberOfColums;
//            alert ( "left: " + left + " index: " + index + " viewPortLeft: " + viewportLeftIndex + " numberOfColums: " + numberOfColums );
               element('content' + i).style.left = left + "%";
            }
         }



         // ---------- interval reload --------
         
         var reloadTabs = new Array();
         var reloadTask = null;
         
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
               showPage( reloadTabs[i], tabParameter[reloadTabs[i]], false );
            }
         }


         // --------- tab content ----------

         function showPage( index, parameter, clicked ) {
            
            tabParameter[index] = parameter;
            for ( i = index + 1; clicked && i < tabParameter.length; i++ ) {
               tabParameter[i] = null;
               element("content" + i).innerHTML = "";
            }
            var xmlhttp = createRequest();
            elementId = 'content' + index;
            element(elementId).innerHTML = '<div class="headspacer"></div>Seite wird geladen';
            xmlhttp.open("GET", "content.php?index=" + index + "&" + parameter, false);
            xmlhttp.onreadystatechange = function() {
               if(xmlhttp.readyState != 4) {
                 element(elementId).innerHTML = '<div class="headspacer"></div>Seite wird geladen ...';
               } else if(xmlhttp.status == 200) {
                  element(elementId).innerHTML = xmlhttp.responseText;
                  initReload( xmlhttp.responseText, index );
                  if ( clicked ) {
                     showTab( index );
                  }
               } else {
                 element(elementId).innerHTML = xmlhttp.status;
               }
            }
            xmlhttp.send(null);
         }

         function postData() {
            var xmlhttp = createRequest();

            result = createFormData();
            index = result[0];
            data = result[1];

            elementId = 'content' + index;
            element(elementId).innerHTML = 'Seite wird geladen';
            xmlhttp.open("POST", "commit.php", true);
//            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//            xmlhttp.setRequestHeader("Content-length", data.length);

            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState != 4) {
                    element(elementId).innerHTML = 'Seite wird geladen ...';
                } else if(xmlhttp.status == 200) {
                  tabParameter[index] = xmlhttp.responseText;
                  if ( tabParameter[index] == "" ) {
                     tabParameter[index] = null;
                  }
                  refreshTab();
                  showTab( index - 1 );
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
                  showPage( i, tabParameter[i], false );
               } else {
                  element("content" + i).innerHTML = "";
               }
            }
         }

         function createFormData() {

//            var data = '';

            var index = -1;
            var elements = element('myForm').elements;
            for(var i = 0; i < elements.length; i++) {
               if ( elements[i].name == "index" ) {
                  index = elements[i].value;
               }
            }
//               data += elements[i].name + "=";
//              if ( elements[i].type != "checkbox" ) {
//                  data += elements[i].value;
//               } else {
//                  data += elements[i].checked ? 1 : 0;
//               }
//               data += "&";
//            } 
            var data = new FormData( element('myForm') );
            return new Array(index, data);
         }


         function createRequest() {
            if (window.XMLHttpRequest) {
                return new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                return xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
         }
         
         // -------- no browser back ---------
         
         history.pushState({ page: 1 }, "MeoRace", "#nbb");
         window.onhashchange = function (event) {
             window.location.hash = "nbb";
         };


         // -------- util ---------
        
         function element(id) {
            return document.getElementById(id);
         }

         function onload() {
           
           numberOfColums = determineNumberOfColumns();
           setColumnWidth();
           setVisibility();
           setLeft();
           showPage(0, "module=menu&page=menuList" , true);
           window.addEventListener('resize', resizeScreen, true);
         }

         function back() {
            if ( currentTab < 1 ) {
               return;
            }
            currentTab--;
            if ( viewportLeftIndex > 0 ) {
               viewportLeftIndex--;
               numberOfColums++;
               setVisibility();
               numberOfColums--;
               setTimeout("setLeft()", 1);
               setTimeout("setVisibility()", 200);
            }
            //moveToCurrentTab();
         }

      </script>
   </head>
   <body onload="onload()">
      <div class="header">
         <div class="but_back" onclick="back()"><</div>
         <div class="but_menu"><p style=" margin-top: 5px;"><a class="ohne" style="color: #ccc;" href="login.php">
<?php   
   if ( $user == null) {
      print("log<br />in");
   } else {print("log<br />out");}
?>
         </a></p></div>
         <div class="title">
            <h1>Current Module Title</h1>
            <h1 class=sub>
               <?php
                  $user = CommonDbFunction::getUser();         
                  if ( $user != null ) {
                     print(" Logged in as: " . $user->user . " (" . $user->role . "/" . $user->raceName . ") " );
                  } else {print("Public view without login");}
               ?>
            </h1>
         </div>
      </div>
      <div class="content0" id="content0"> </div>
      <div class="content1" id="content1"> </div>
      <div class="content2" id="content2"> </div>
      <div class="content3" id="content3"> </div>
      <div class="content4" id="content4"> </div>
   </body>
</html>



