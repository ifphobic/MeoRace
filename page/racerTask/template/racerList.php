<div class="content_tab" id="racerlist_racertask">

<ul>
<?php
   
   $dbFunction = new RacerDbFunction();
   $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
   $dbFunction->close();

   print("<div class='bottom_content_wrapper'><ul>");
   foreach ( $racers as $racer ) {
      print("
         <li onclick='" . Page::getOnClickFunction( "racerTask", "racerTask", $racer->racerId ) . "'>
            <div class='left_info'>
               <img src='http://static.wixstatic.com/media/87f473_013e75dfc64446ea98841a8f4c96056a.jpg_srz_321_273_75_22_0.50_1.20_0.00_jpg_srz' alt='strom praesi'>
            </div> 
            <div class='middle_info'>
               <p class='title'>" . $racer->name . "</p>
               <p class='description'>"  . $racer->city . ", " . $racer->country . "</p>
            </div>
            <div class='right_info'>
               <p class='rider_number'>" . $racer->racerNumber . "</p>
            </div>
         </li>
      ");
   }
   print("</ul></div>");

?>

</div>
