<?php
   if ( RaceDbFunction::printFinished( CommonDbFunction::getUser()->raceFk) ) {
      exit;
   }
?>
<div class="content_tab confirm" id="racerdispatch_dispatch">

<?php

   $racerId = $_GET['racerId'];
   $taskId = $_GET['id'];

   $dbFunction = new TaskDbFunction();
   $task = $dbFunction->findById( $taskId );
   $dbFunction->close();
   $dbFunction = new RacerDbFunction();
   $racer = $dbFunction->findById( $racerId );
   $dbFunction->close();
?>
   
   <input type='hidden' name='taskId' value='<?php print( $taskId) ?>' />
   <input type='hidden' name='racerId' value='<?php print( $racerId) ?>' />

            

<p class="confirm_heading"><?php print( "Assign Task " ) ?></p>

 <ul>
      <li>
        <div class="listwrapper">
			<div class="left_info">
            <p class="manifest_number"><?php print( $task->name ) ?></p>
         </div> 

        <div class="middle_info">
            <p class="title"><?php print( $task->description ) ?></p>
	         <p>
                  <span class='manifest_points'><?php print( round( $task->price ) ) ?></span>
                  <span class='manifest_maxduration'><?php print( Page::readableDuration( $task->maxDuration ) ) ?></span>
            </p>
         </div>
    
         <div class="right_info">
        </div>
 </ul>


<p class="confirm_heading"><?php print( "To Racer " ) ?></p>

      <ul>
      <li>
	 	<div class="listwrapper">
         <div class='left_info'>
            <img src='<?php print( Page::getImagePath( $racer ) ) ?>'>
         </div> 
         <div class='middle_info'>
            <p class='title'><?php print( $racer->name ) ?></p>
            <p class='description'><?php print( $racer->city . ", " . $racer->country ) ?></p>
         </div>
         <div class='right_info'>
            <p class='rider_number'><?php print( $racer->racerNumber ) ?></p>
         </div>
		</div>
      </li>
   </ul>

</div>
