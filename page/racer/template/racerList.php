<div class="content_tab" id="riderlist">
  
  <h1>Racer List</h1>
    
  
  
    <div class="bottom_content_wrapper">
   
    <div class="bottom_info_wrapper">


<?php print( CommonPageFunction::getLink( "racer", "racerEdit", null, "<div class='new_button'>+ Add Racer</div>") );?>


<ul>
   <?php
   
      $dbFunction = new RacerDbFunction();
      $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
      $dbFunction->close();
      
      foreach ( $racers as $racer ) {
      print ("
         <li class='riderlist'>
            " . CommonPageFunction::getLink( "racer", "racerEdit", $racer->racerId, "
            <div class='left_info'>
               <img src='http://ux.crealogix.com/wp-content/uploads/2013/03/portrait_jakob.png' alt='dont mess with jakob the boss'>
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
            ") . "
         </li>
      ");
      }
   ?>
</ul>

		</div>
	</div>
</div>





 
