<div class="content_tab" id="racerlist_dispatch">
   <ul>

<?php
   
   $dbFunction = new RacerDbFunction();
   $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
   $dbFunction->close();
   
    foreach ( $racers as $racer ) {
      print("
         <li onclick='" . Page::getOnClickFunction( "stockExchangeDispatch", "taskDispatch", $racer->racerId ) . "'>
            <div class='left_info'>
               <img src='" . Page::getImagePath( $racer ) . "'>
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
?>

   </ul>
</div>


  


