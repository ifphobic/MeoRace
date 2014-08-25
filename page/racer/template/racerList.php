<div class="content_tab" id="riderlist">

<div class='new_button' onclick='<?php print(Page::getOnClickFunction( "racer", "racerEdit", null ) ) ?> '>+ Add Racer</div>

<ul>
   <?php
   
      $dbFunction = new RacerDbFunction();
      $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
      $dbFunction->close();
      
      foreach ( $racers as $racer ) {
      print ("
         <li class='riderlist' onclick='" . Page::getOnClickFunction( "racer", "racerEdit", $racer->racerId) . "' >
            <div class='listwrapper'>
               <div class='left_info'>
                  <img  src='" . Page::getImagePath( $racer ) . "'>
               </div> 
                  <div class='middle_info'>
                     <p class='title'>" . $racer->name . ", " . $racer->email . "</p>
                     <p class='description'>" . $racer->city . ", " . $racer->country . " / " . $racer->status . "</p>
                  </div> 
                  <div class='right_info'>
                     <span class='rider_number'>" . $racer->racerNumber . "</span> 
                  </div>
               </div> <!-- listwrapper -->
         </li>
      ");
      }
   ?>
</ul>

</div>





 
