<?php
   include "core/include.php";
   $dbFunction = new CommonDbFunction();
   $user = $dbFunction->determineCurrentUSer();
   $dbFunction->close();
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

            var result = input.match( /<reload *\/ *>/ );
            if ( result != null && result.length > 0 ) {
                  var found = false;
                  for (var i = 0; i < reloadTabs.length && !found; ++i) {
                     found = ( reloadTabs[i] == tabId);
                  }
                  if ( found ) {
                     return;
                  }
                  reloadTabs.push( tabId );
                  if ( reloadTask != null ) {
                     clearInterval( reloadTask );
                  }
                  reloadTask = window.setInterval("reloadTasks()", 5000 );
            }
         }

         function reloadTasks() {
            for (var i = 0; i < reloadTabs.length; i++) {
               showPage( reloadTabs[i], tabParameter[reloadTabs[i]], false );
            }
         }

         function clearReload( index ) {
            for ( i = reloadTabs.length - 1; i >= 0; i-- ) {
               if (reloadTabs[i] >= index ) {
                  reloadTabs.pop();
               }
            }
         }

         // --------- tab content ----------

         function showPage( index, parameter, clicked ) {

            tabParameter[index] = parameter;
            if (clicked ) {
               clearReload( index );
            }
            for ( i = index + 1; clicked && i < tabParameter.length; i++ ) {
               tabParameter[i] = null;
               element("content" + i).innerHTML = "";
            }
            var xmlhttp = createRequest();
            elementId = 'content' + index;
            element(elementId).innerHTML = '<div class="headspacer"></div>loading ...';
            xmlhttp.open("GET", "content.php?index=" + index + "&" + parameter, false);
            xmlhttp.onreadystatechange = function() {
               if(xmlhttp.readyState != 4) {
                 element(elementId).innerHTML = '<div class="headspacer"></div>loading ...';
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
            element(elementId).innerHTML = 'loading ...';
            xmlhttp.open("POST", "commit.php", true);
//            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//            xmlhttp.setRequestHeader("Content-length", data.length);

            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState != 4) {
                    element(elementId).innerHTML = 'loading ...';
                } else if(xmlhttp.status == 200) {
                  setTitelNewRace(xmlhttp.responseText);
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

         function setTitelNewRace( parameter ) {
            searchParameter = "newRace=";
            position = parameter.indexOf( searchParameter );
            if ( position != -1 ) {
               positionEnd = parameter.indexOf( "&", position + 1 );
               if ( positionEnd == -1 ) {
                  positionEnd = parameter.length;
               }
               position += searchParameter.length;
               raceName = decodeURIComponent( parameter.substring(position,  positionEnd) );
               setLoginTitle( raceName );
            }
         }

         function setLoginTitle( raceName ) {


               <?php
                  if ( $user != null ) {
                    print("defaultRaceName='" . $user->raceName . "';\n");
                    print("element('loginTitle').innerHTML='Logged in as: " . $user->user . " (" . $user->role . "/' + ((raceName != null) ? raceName : defaultRaceName) + ')'" );
                  } else {
                    print("element('loginTitle').innerHTML='Public view without login'");
                  }
               ?>
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

         function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(element("uploadImage").files[0]);

            oFReader.onload = function (oFREvent) {
               element("uploadPreview").src = oFREvent.target.result;
            };
         };

         function element(id) {
            return document.getElementById(id);
         }

         function onload( mode ) {

           numberOfColums = determineNumberOfColumns();
           setColumnWidth();
           setVisibility();
           setLeft();
           setLoginTitle( null );
           if ( mode == "tv" ) {
               showPage(0, "module=stockExchangeDispatch&page=taskDispatch" , false);
               showPage(1, "module=stockExchangeDispatch&page=taskDispatch" , false);
               showPage(2, "module=stockExchangeDispatch&page=taskDispatch" , false);
               showPage(3, "module=stockExchangeDispatch&page=taskDispatch" , false);
               for ( i = 0; i < 4; i++ ) {
                  reloadTabs.push(i);
               }
               reloadTask = window.setInterval("reloadTasks()", 5000 );
           } else if ( mode == "user" ) {
              showPage(0, "module=menu&page=menuList" , true);
           } else if ( mode == "ranking" ) {
              showPage(0, "module=menu&page=menuList" , true);
              showPage(1, "module=ranking&page=rankingOverview" , true);
           } else {
              showPage(0, "module=menu&page=menuList" , true);
              showPage(1, "module=race&page=raceList" , true);
           }
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

         function menuOpen() {
           if (element('menu1').style.top == "0px") {
             element('menuwrapper').style.height= "150px";
           } else {
             element('menuwrapper').style.height= "0px";
           }
           for (var i = 1; i < 3; i++) {
              if (element('menu' + i).style.top == "0px") {
                element('menu' + i).style.top = i * 50 + "px";
              } else {
                element('menu' + i).style.top = 0 + "px";
              }

            }
         }

      </script>
   </head>
<?php
   $mode = "standard";
   if ( isset( $_GET['tv'] ) ) {
      $mode = "tv";
   } else if ( isset($_GET['ranking'] ) ) {
      $mode = "ranking";
   } else if ( $user != null ) {
      $mode = "user";
   }

?>
   <body onload="onload( '<?php print( $mode ) ?>')">
      <div class="header">
         <div class="but_back" onclick="back()"><</div>
         <div class="but_menu" onclick="menuOpen()">
           <span style="font-family: 'icomoon'; color: #808080; font-size: 1.7em; line-height: 1.7em; margin-right: 15px; margin-left: 15px; color: #166D3A;"></span>
           </div>
         <div class="title">
            <h1>Messenger Race Software</h1>
            <h1 class=sub id="loginTitle">
               <?php
                  if ( $user != null ) {
                     print(" Logged in as: " . $user->user . " (" . $user->role . "/" . $user->raceName . ") " );
                  } else {
                     print("Public view without login");
                  }
               ?>
            </h1>
         </div>
      </div>
    <div class="menu_wrapper" id="menuwrapper" style="box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.5); position:absolute; min-width: 280px; height=0px; right:0px; transition: height 400ms cubic-bezier(0.7, 1.5, 0.7, 0.85);">
      <div class="menu_top menu2" id="menu2" style="position: absolute; font-size:1.7em; right: 0px; top: 0px; height: 49px; min-width: 280px; z-index: 50; background: linear-gradient(#ffffff, #f2f2f2); border-bottom: 1px solid #999999; transition: top 400ms cubic-bezier(0.7, 1.5, 0.7, 0.85);">
        <span style="font-family: 'icomoon'; color: #808080; font-size: 0.8em; margin-right: 15px; margin-left: 15px; color: #166D3A;"></span>
         <a class="ohne" style="color: #ccc;" href="login.php">
           Select Race
        </a>
      </div>
      <div class="menu_top menu1" id="menu1" style="position: absolute; font-size:1.7em; right: 0px; top: 0px; height: 49px; min-width: 280px; z-index: 50; background: linear-gradient(#ffffff, #f2f2f2); border-bottom: 1px solid #999999; transition: top 400ms cubic-bezier(0.7, 1.5, 0.7, 0.85);">
        <span style="font-family: 'icomoon'; color: #808080; font-size: 0.8em; margin-right: 15px; margin-left: 15px; color: #166D3A;"></span>
        <a class="ohne" style="color: #ccc;" href="login.php">
          <?php
             if ( $user == null) {
                print("Login");
             } else {print("Logout");}
          ?>
        </a>
      </div>

    </div>
      <div class="content0" id="content0"> </div>
      <div class="content1" id="content1"> </div>
      <div class="content2" id="content2"> </div>
      <div class="content3" id="content3"> </div>
      <div class="content4" id="content4"> </div>
   </body>
</html>
