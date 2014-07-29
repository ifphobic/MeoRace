
<ul>
   <?php
   
      $dbFunction = new RacerDbFunction();
      $racers = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
      $dbFunction->close();
      
      foreach ( $racers as $racer ) {
      print ("
         <li class='listitem'>
            " . CommonPageFunction::getLink( "racer", "racerEdit", $racer->racerId, "
            <div class='left_info'>
               <img src='https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-xpa1/v/t1.0-9/224772_10150301758538298_5948223_n.jpg?oh=16fa88602ac2da9dc2f927f091637d85&oe=541195B5&__gda__=1412144473_b10848b4a4b08509b69f92f603521d4d' alt='dont mess with rolling ruedy'>
            </div> 
            <div class='middle_info'>
               <span class='rider_name''>" . $racer->name . "</span><br />
               <span class='rider_city_country'>" . $racer->city . ", " . $racer->country . "</span>
            </div> 
            <div class='middle_info'>
               <span class='rider_name''>" . $racer->email . "</span><br />
               <span class='rider_city_country'>" . $racer->status . "</span>
            </div>
            <div class='right_info'>
               <span class='rider_number'>" . $racer->racerNumber . "</span> 
            </div>
            ") . "
         </li>
      ");
      }
   ?>
</ul><p><br /></p>

<?php print( CommonPageFunction::getLink( "racer", "racerEdit", null, "<div class='new_button'>New Racer</div>") );?>



 
