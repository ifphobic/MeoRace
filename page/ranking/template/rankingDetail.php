<?php
   $racer = null;
   $dbFunction = new RacerDbFunction();
   if ( isset( $_GET['id'] ) ) {
      $racer = $dbFunction->findById( $_GET['id'] );
      $raceId = $racer->raceFk;
   } else {
      $raceId = CommonDbFunction::getUser()->raceFk;
   }
   $dbFunction->close();
?>

<div class="content_tab" id="racertask_racertask">

<div class="top_content_wrapper""> <!-- Wrapper for the top content like search, selected rider, selected parcel and so on-->
   <div class="top_info_wrapper top_info_rider"> <!-- Second top wrapper: Put in here the search input form, selected rider, selected parcel and so on.  -->
      <div class='left_info'>
         <img src='<?php print( Page::getImagePath( $racer ) ) ?>' alt='racer image'>
      </div> 
      <div class='middle_info'>
         <p class='title'><?php Page::printValue( $racer, "name" ) ?></p>
         <p class='description'><?php Page::printValue($racer, array( "city", "country" ), ", ") ?></p>
      </div>
      <div class='right_info'>
         <p class='rider_number'><?php Page::printValue( $racer, "racerNumber" ) ?></p>
      </div>
   </div><!-- top info wrapper -->
</div> <!-- top content wrapper -->

<div class="bottom_content_wrapper">
    <div class="bottom_info_wrapper bottom_rider_tasks">
      <p class="racer_checkpointlist_heading">Racer Tasks</p>
       <ul>
    <li onclick="showPage( 3, 'module=ranking&page=taskDetail' , true )">

  <div class="left_info">
      <p class="manifest_number">12</p>
      </div> 
       
      <div class="middle_info">
      <p class="title">Tolles Manifest</p>
	  <p class="description">Rock'n'Roll</p>
	 
      </div>
      
      <div class="right_info">
      <p class="manifest_points">100</p>
      <p class="manifest_maxduration">00:02:10</p>
      </div>
      
    </li>
      </ul>
 
 <ul>
    <li>

  <div class="left_info">
      <p class="manifest_number">14</p>
      </div> 
       
      <div class="middle_info">
      <p class="title">Tolles Manifest</p>
	  <p class="description">Rock'n'Roll</p>
	 
      </div>
      
      <div class="right_info">
      <p class="manifest_points">100</p>
      <p class="manifest_maxduration">00:02:10</p>
      </div>
    </li>
      </ul>
 
 
 
 <ul>
    <li>

  <div class="left_info">
      <p class="manifest_number">19</p>
      </div> 
       
      <div class="middle_info">
      <p class="title">Tolles Manifest</p>
	  <p class="description">Rock'n'Roll</p>
	 
      </div>
      
      <div class="right_info">
      <p class="manifest_points">100</p>
      <p class="manifest_maxduration">00:02:10</p>
      </div>
    </li>
      </ul>
 
 
 
 
 <ul>
    <li>

  <div class="left_info">
      <p class="manifest_number">01</p>
      </div> 
       
      <div class="middle_info">
      <p class="title">Tolles Manifest</p>
	  <p class="description">Rock'n'Roll</p>
	 
      </div>
      
      <div class="right_info">
      <p class="manifest_points">100</p>
      <p class="manifest_maxduration">00:02:10</p>
      </div>
    </li>
      </ul>
      
      
     
    </div> <!-- bottom_content_wrapper xxx -->