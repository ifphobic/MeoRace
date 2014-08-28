<?php
   if ( RaceDbFunction::printFinished( CommonDbFunction::getUser()->raceFk) ) {
      exit;
   }
?>

<div class="content_tab" id="racerlist_racertask">

<ul>
<?php
   
   $dbFunction = new RacerDbFunction();
   $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
   $dbFunction->close();

   print("<ul>");
   foreach ( $racers as $racer ) {
      print("
         <li onclick='" . Page::getOnClickFunction( "racerTask", "racerTask", $racer->racerId ) . "'>
            <div class='listwrapper'>
               <div class='left_info'>
                  <img src='" . Page::getImagePath( $racer ) . "' />
               </div> 
               <div class='middle_info'>
                  <p class='title'>" . $racer->name . "</p>
                  <p class='description'>"  . $racer->city . ", " . $racer->country . "</p>
               </div>
               <div class='right_info'>
                  <span class='rider_number'>" . $racer->racerNumber . "</span>
               </div>
            </div>
         </li>
      ");
   }
   print("</ul>");

?>

</div>
