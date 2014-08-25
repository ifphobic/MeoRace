
   <?php
      $parcel= null;
      if ( isset( $_GET['id'] ) ) {
         $dbFunction = new ParcelDbFunction();
         $parcel = $dbFunction->findById( $_GET['id'] );
         $dbFunction->close();
         print( "<input type='hidden' name='parcelId' value='" . $parcel->parcelId ."' />" );
      } else {
         print( "<input type='hidden' name='raceFk' value='" . CommonDbFunction::getUser()->raceFk  ."' />" );
      }
   ?>

<div class="content_tab" id="parceledit_parcel">
   <h1>Parcel Edit</h1>

   <div class="top_content_wrapper registration">
      <div class="top_info_wrapper">
         <div class="left_info">
            <div>
               <input type="file" id="uploadImage" name="image" accept="image/*" onchange="PreviewImage();" capture></input>
               <div class="photo_upload" />
                  <img id="uploadPreview" src="<?php print( Page::getImagePath( $parcel )) ?>"></div>
               </div>
            </div>
				<div class='middle_info'>
               <?php print( "<p class='title'>" . $parcel->name . "</p>"); ?>
               <?php print( "<p class='description'>" . $parcel->description . "</p>");?>
            </div>
         </div>
      </div>
      <div class="bottom_content_wrapper">
         <div class="registration_values">
            <label for="name" class="parcelname"> <input type="text" name="name" placeholder="Name" value="<?php Page::printValue( $parcel, "name" ) ?>"/> </label>
            <label for="description" class="parceldescription"> <input type="text" name="description" placeholder="Description" value="<?php Page::printValue( $parcel, "description" ) ?>"/> </label>
         </div>
      </div>
   </div>
</div>

