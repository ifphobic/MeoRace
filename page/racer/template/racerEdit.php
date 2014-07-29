
<?php
   $racer = null;
   $dbFunction = new RacerDbFunction();
   if ( isset( $_GET['id'] ) ) {
      $racer = $dbFunction->findById( $_GET['id'] );
      print( "<input type='hidden' name='racerId' value='" . $racer->racerId ."' />" );
      $raceId = $racer->raceFk;
   } else {
      $raceId = CommonDbFunction::getUser()->raceFk;
      print( "<input type='hidden' name='raceFk' value='" . $raceId  ."' />" );
   }
   $freeRaceNumbers = $dbFunction->getFreeRaceNumbers( $raceId, $racer );
   $dbFunction->close();
?>
 

<div class="content_tab">
   <h1>Racer Edit</h1>
  
   <div class="top_content_wrapper registration">
      <div class="top_info_wrapper">
         <div class="left_info">
            <div>
               <input type="file" name="photo" accept="image/*" capture="camera"></input> 
               <div class="photo_upload" />
                  <img src="https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-xpa1/v/t1.0-9/224772_10150301758538298_5948223_n.jpg?oh=16fa88602ac2da9dc2f927f091637d85&oe=541195B5&__gda__=1412144473_b10848b4a4b08509b69f92f603521d4d" 
                     alt="dont mess with rolling ruedy"></div> 
               </div>
            </div>
            <div class="middle_info">
               <span class="rider_name"><?php Page::printValue( $racer, "name" ) ?></span><br />
               <span class="rider_city_country"><?php Page::printValue($racer, array( "city", "country" ), ", ") ?></span>
            </div>
            <div class="right_info">
               <span class="rider_number"><?php Page::printValue( $racer, "racerNumber" ) ?></span>
            </div>
         </div>
      </div>
      <div class="bottom_content_wrapper">
         <div class="registration_values">
            <?php print( CommonPageFunction::getCombobox("racerNumber", $racer, "Number", $freeRaceNumbers ) ) ?>
            <label for="ridername" class="ridername"> <input type="text" name="name" placeholder="Name" value="<?php Page::printValue( $racer, "name" ) ?>"/> </label> 
            <label for="ridercity" class="ridercity"> <input type="text" name="city" placeholder="City" value="<?php Page::printValue( $racer, "city" ) ?>"/> </label>
            <label for="ridercountry" class="ridercountry"> <input type="text" name="country" placeholder="Country" value="<?php Page::printValue( $racer, "country" ) ?>"/> </label>
            <label for="rideremail" class="rideremail"> <input type="text" name="email" placeholder="Email" value="<?php Page::printValue( $racer, "email" ) ?>"/> </label>
            <?php print( CommonPageFunction::getCombobox("status", $racer, "Status", array( "registered", "active", "finished", "disqualified" )) ) ?>
         </div>  
      </div>   
   </div>
</div>

