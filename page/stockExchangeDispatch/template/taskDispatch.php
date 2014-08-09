<div class="content_tab" id="taskdispatch_dispatch">
<div class="bottom_content_wrapper">   
   

<?php
   $dbFunction = new StockExchangeDispatchDbFunction();
   $raceFk = CommonDbFunction::getUser()->raceFk;
   $tasks = $dbFunction->findAll( $raceFk );
   if ( count( $tasks ) == 0 ) {
      $dbFunction->init( $raceFk );
      $tasks = $dbFunction->findAll( $raceFk );
   }
   $dbFunction->close();

   foreach ( $tasks as $task ) {
      print ( Page::getListItem( $task->name, Page::getOnClickFunction( "stockExchangeDispatch", "racerList", $task->taskFk ), round( $task->price ) . "/" . "max. " . Page::readableDuration( $task->maxDuration ), $task->description ) );

   }

?>
<reload interval="10" />



<!-- DC template @Philip: dies hier dynamisch machen-->


   <ul>
    <li>

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
      </ul>
    </li>

</div> <!-- bottom_content_wrapper xxx --> 


</div> <!-- content tab -->




