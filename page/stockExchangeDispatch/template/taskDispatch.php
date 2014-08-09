<reload interval="10" />

<div class="content_tab" id="taskdispatch_dispatch">
<div class="bottom_content_wrapper">   
<ul>   

<?php
   $dbFunction = new StockExchangeDispatchDbFunction();
   $raceFk = CommonDbFunction::getUser()->raceFk;
   $dbFunction->init( $raceFk );
   $tasks = $dbFunction->findAll( $raceFk );
   $dbFunction->close();

   foreach ( $tasks as $task ) {
//      print ( Page::getListItem( $task->name, Page::getOnClickFunction( "stockExchangeDispatch", "racerList", $task->taskFk ), round( $task->price ) . "/" . "max. " . Page::readableDuration( $task->maxDuration ), $task->description ) );
      ?>

      <li onClick='<?php print( Page::getOnClickFunction( "stockExchangeDispatch", "dispatchConfirm", $task->taskFk,  "racerId=" . $_GET['id']  ) ) ?>'>
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
      <?php
   }
?>
   </ul>
</div> <!-- bottom_content_wrapper xxx --> 
</div> <!-- content tab -->




