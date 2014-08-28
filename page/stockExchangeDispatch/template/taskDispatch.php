<?php
   if ( RaceDbFunction::printFinished( CommonDbFunction::getUser()->raceFk) ) {
      exit;
   }
?>

<div class="content_tab" id="taskdispatch_dispatch">
<ul>   

<?php
   $dbFunction = new StockExchangeDispatchDbFunction();
   $raceFk = CommonDbFunction::getUser()->raceFk;
   $dbFunction->init( $raceFk );
   $tasks = $dbFunction->findAll( $raceFk, $_GET['id'] );
   $dbFunction->close();

   foreach ( $tasks as $task ) {
   $price = round( $task->price );
      if ( $task->notAssigned ) {
         print( "<li onClick='" . Page::getOnClickFunction( "stockExchangeDispatch", "dispatchConfirm", $task->taskFk,  "racerId=" . $_GET['id'] . "&price=$price"  ) . "'>");
      } else {
         print( "<li style='background: #ff0000;'>");
      }
?>
		
         <div class="listwrapper">
			<div class="left_info">
            <p class="manifest_number"><?php print( $task->name ) ?></p>
         </div> 
       
         <div class="middle_info">
            <p class="title"><?php print( $task->description ) ?></p>
	         <p>
                  <span class='manifest_points'><?php print( $price ) ?></span>
                  <span class='manifest_maxduration'><?php print( Page::readableDuration( $task->maxDuration ) ) ?></span>
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




