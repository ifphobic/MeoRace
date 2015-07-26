<?php

   $user = CommonDbFunction::getUser();

   if ( $user != null ) {
      $raceFk = $user->raceFk;
      $checkpointFk = $user->checkpointFk;
   } else {
      $raceFk = Configuration::CURRENT_RACE;
      $checkpointFk = null;
   }
      
   $racerId = null;
   if ( isset($_GET['id'] ) ) {
      $racerId = $_GET['id'];
   }

   if ( $user != null && $user->role != Role::NO_ROLE && RaceDbFunction::printFinished( $raceFk ) ) {
      exit;
   }

?>

<div class="content_tab" id="taskdispatch_dispatch">
<ul>   

<?php
   $dbFunction = new StockExchangeDispatchDbFunction();
   $tasks = $dbFunction->findAll( $raceFk, $checkpointFk, $racerId );
   $dbFunction->close();

   if ( $user != null ) {
      $i = 0;
      $end = count( $tasks );
   } else {
      $i = Page::getTabIndex() * Configuration::TV_SIZE;
      $end =  min( $i + Configuration::TV_SIZE, count( $tasks ));
   }


   for ( ; $i < $end; $i ++  ) {
      $task = $tasks[$i];
      $price = round( $task->price );
      if ( $task->notAssigned && $user != null && $user->role != Role::NO_ROLE ) {
         print( "<li onClick='" . Page::getOnClickFunction( "stockExchangeDispatch", "dispatchConfirm", $task->taskFk,  "racerId=$racerId&price=$price"  ) . "'>");
      } else {
         print( "<li>");
      }
?>
		
         <div class="listwrapper">
			<div class="left_info">
            <p class="manifest_number <?php print($task->notAssigned ? "" : "manifest_unreachable"); ?>"><?php print( $task->name ) ?></p>
         </div> 
       
         <div class="middle_info">
            <p class="title"><?php print( $task->description ) ?></p>
	         <p><?php if( !$task->notAssigned ){
			         print("Already assigned");
			   } else {
			   ?>
                  <span class='manifest_points'><?php print( $price ) ?></span>
                  <span class='manifest_maxduration'><?php print( Page::readableDuration( $task->maxDuration ) ) ?></span>
			   <?php } ?>
			 </p>
         </div>
    
         <div class="right_info">
   
         </div>

		</div> <!-- listwrapper -->
      </li>
      <?php
   }
?>
   </ul>
</div> <!-- content tab -->




