<?php
   include 'page/ranking/RankingCalculator.php';
   
   $racer = null;
  
   $dbFunction = new RacerDbFunction();
   $racer = $dbFunction->findById( $_GET['id'] );
   
   $dbFunction->close();
?>

<div class="content_tab">
<div id="ranking_rankingdetail">
<div class="top_content_wrapper" > 
   <div class="top_info_wrapper top_info_rider"> 
      <div class='left_info'>
         <img src='<?php print( Page::getImagePath( $racer ) ) ?>' alt='racer image'>
      </div> 
      <div class='middle_info'>
         <p class='title'><?php print( $racer->name ) ?></p>
         <p class='description'><?php print( Page::printValue($racer, array( "city", "country" ), ", ") ) ?></p>
      </div>
      <div class='middle_info racer_ranking_points'>
         <p>
            <span class='racer_ranking'>1</span>
            <span class='racer_points'>120</span>
         </p>
      </div>
      <div class='right_info'>
         <p class='rider_number'><?php print( $racer->racerNumber ) ?></p>
      </div>
   </div><!-- top info wrapper -->
</div> <!-- top content wrapper -->
</div>

<div id="ranking_detail_tasks">
   <ul>

<?php

   $dbFunction = new RankingDbFunction();
   $racerTasks = $dbFunction->findAll( null, $_GET['id'] );
   $dbFunction->close();
   
   $raceFinished = false;
   if ( count( $racerTasks ) > 0 ) {
      $dbFunction = new RaceDbFunction();
      $race = $dbFunction->findById( $racerTasks[0]->raceFk );
      $raceFinished = $dbFunction->isFinished( $race );
      $dbFunction->close();
   }

   foreach( $racerTasks as $racerTask ) {
      $taskComplete = true;
      $time = $racerTask->taskTime;
      if($racerTask->taskTime == null) {
         $taskComplete = false;
         $time = $racerTask->maxDuration - $racerTask->currentTime;
      }
      ?>

      <li onclick='<?php print( Page::getOnClickFunction( "ranking", "taskDetail", $racerTask->racerTaskId ) ) ?>'>
        <div class="listwrapper">
         <div class="left_info">
            <p class="manifest_number <?php $taskComplete ? print("manifest_completed") : print("manifest_possible"); ?>">
            <?php print( $racerTask->taskName ) ?></p>
         </div> 
       
         <div class="middle_info">
            <p class="title"><?php print( $racerTask->taskDescription ) ?></p>
            <p class="description"><?php $taskComplete ? print("Completed") : print("Open"); ?></p>
         </div>
      
         <div class="right_info">
            <p class="manifest_points"><?php print( RankingCalculator::calculateScore( $racerTask, $raceFinished ) . "/" . $racerTask->price ) ?></p>
            <p class="manifest_maxduration"><?php print(Page::readableDuration( $time )) ?></p>
         </div>
    </li>


      <?php
   }
?>
   </ul>
</div>
</div>
</div>
