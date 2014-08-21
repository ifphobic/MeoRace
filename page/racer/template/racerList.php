<div class="content_tab" id="riderlist">
    <div class="bottom_content_wrapper">
      <div class="bottom_info_wrapper">

<div class="new_button" onclick='<?php print(Page::getOnClickFunction( "racer", "racerEdit", null ) ) ?>'>+ Add Racer</div>

<ul>
   <?php
   
      $dbFunction = new RacerDbFunction();
      $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
      $dbFunction->close();
      
      foreach ( $racers as $racer ) {
      print ("
         <li class='riderlist' >
            " . CommonPageFunction::getLink( "racer", "racerEdit", $racer->racerId, "
            <div class='listwrapper'>
               <div class='left_info'>
                  <img src='http://static.wixstatic.com/media/87f473_013e75dfc64446ea98841a8f4c96056a.jpg_srz_321_273_75_22_0.50_1.20_0.00_jpg_srz' alt='strom praesi'>
               </div> 
                  <div class='middle_info'>
                     <span class='title'>" . $racer->name . "</span><br />
                     <span class='description'>" . $racer->city . ", " . $racer->country . "</span>
                  </div> 
                  <div class='middle_info'>
                     <span class='title'>" . $racer->email . "</span><br />
                     <span class='description'>" . $racer->status . "</span>
                  </div>
                  <div class='right_info'>
                     <span class='rider_number'>" . $racer->racerNumber . "</span> 
                  </div>
               </div> <!-- listwrapper -->
            ") . "
         </li>
      ");
      }
   ?>
</ul>

		</div>
	</div>
</div>





 
