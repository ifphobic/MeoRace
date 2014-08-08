<div class="content_tab" id="racerlist_racer">
    <div class="bottom_content_wrapper">

<div class="new_button" onclick='<?php print(Page::getOnClickFunction( "racer", "racerEdit", null)); ?>'>+ Add Racer</div>

<ul>
   <?php
   
      $dbFunction = new RacerDbFunction();
      $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
      $dbFunction->close();
      
      foreach ( $racers as $racer ) {
      print ("
           <li onclick='" . Page::getOnClickFunction( "racerTask", "racerTask", $racer->racerId ) . "'>
            <div class='left_info'>
               <img src='" . Page::getImagePath( $racer ) . "'>
            </div> 
            <div class='middle_info'>
               <span class='title'>" . $racer->name . "</span><br />
               <span class='description'>" . $racer->city . ", " . $racer->country . "</span>
            </div> 

            <div class='right_info'>
               <span class='rider_number'>" . $racer->racerNumber . "</span> 
            </div>
            ") . "
         </li>
      ");
      }
   ?>
</ul>

	
	</div>
</div>





 
