<div class="content_tab" id="racerlist_dispatch">

<div class='bottom_content_wrapper'> 

<ul>

<?php
   
   $dbFunction = new RacerDbFunction();
   $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
   $dbFunction->close();

   foreach ( $racers as $racer ) {
      print ( Page::getListItem( 
         $racer->racerNumber . "" . $racer->name, 
         Page::getOnClickFunction( "stockExchangeDispatch", "racerDispatch", $racer->racerId, "taskId=" . $_GET['id'] ) 
      ) );

   }

   
    foreach ( $racers as $racer ) {
      print("
         <li onclick='" . Page::getOnClickFunction( "racer", "racerEdit", $racer->racerId ) . "'>
            <div class='left_info'>
               <img src='" . Page::getImagePath( $racer ) . "' alt='strom praesi'>
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


  


