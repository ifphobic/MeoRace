<div class="content_tab" id="racerdispatch_dispatch">
<div class='bottom_content_wrapper'> 

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

   <ul>
      <li>
         <div class="left_info">
         </div>

         <div class="middle_info">
            <p class="title"><?php print( "Assign Task " ) ?></p>
         </div>

         <div class="right_info">
         </div>
      </li>
      <li>
         <div class="left_info">
            <p class="manifest_number">12</p>
         </div>

         <div class="middle_info">
            <p class="title"><?php print( $task->name ) ?></p>
            <p class="description"><?php print( $task->description ) ?>
         </div>

         <div class="right_info">
            <p class="manifest_points"><?php print( round( $task->price ) ) ?></p>
            <p class="manifest_maxduration"><?php print( Page::readableDuration( $task->maxDuration ) ) ?></p>
         </div>
      </li>
      <li>
         <div class="left_info">
         </div>

         <div class="middle_info">
            <p class="title"><?php print( "To Racer " ) ?></p>
         </div>

         <div class="right_info">
         </div>
      </li>
      <li>
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
      </li>
   </ul>

</div>
</div>
