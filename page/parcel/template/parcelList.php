<div class="content_tab" id="riderlist">
    <div class="bottom_content_wrapper">
      <div class="bottom_info_wrapper">
         
<div class='new_button' onclick='<?php print(Page::getOnClickFunction( "parcel", "parcelEdit", null, "New Parcel" ) ) ?> '>+ Add Parcel</div>

<ul>
<?php
      
      $dbFunction = new ParcelDbFunction();
      $parcels = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
      $dbFunction->close();

      foreach ( $parcels as $parcel ) {
      print ("
         <li class='riderlist' onclick='" . Page::getOnClickFunction( "parcel", "parcelEdit", $parcel->parcelId, "edit") . "'>
            <div class='listwrapper'>
            <div class='left_info'><img src='" . Page::getImagePath( $parcel ) . "' height=65px width=65px;>
               </div> 
            <div class='middle_info'>
               <p class='title'>" . $parcel->name . "</p>
               <p class='description'>" . $parcel->description . "</p>
            </div>
            <div class='right_info'>
               <p class='confirm'></p>
            </div>
            </div>
         </li>
      ");
      }

?> 
</ul> 
