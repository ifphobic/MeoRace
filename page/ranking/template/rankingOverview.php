<div class="content_tab" id="rankingoverview_ranking">

   <ul>

<?php
   
   include 'page/ranking/RankingCalculator.php';

   if ( CommonDbFunction::getUser() != null ) {
      $raceId = CommonDbFunction::getUser()->raceFk;
   } else {
      $raceId = Configuration::CURRENT_RACE;
   }

   $dbFunction = new RankingDbFunction();
   $racerTasks = $dbFunction->findAll( $raceId );
   $dbFunction->close();

   $raceFinished = false;
   if ( count( $racerTasks ) > 0 && $racerTasks[0]->racerTaskId != null ) {
      $raceFinished = RaceDbFunction::isFinished( $racerTasks[0]->raceFk );
   }                  


   $rankings = RankingCalculator::evaluate( $racerTasks, $raceFinished );
   

   foreach ( $rankings as $ranking ) {
      print("
         <li onclick='" . Page::getOnClickFunction( "ranking", "rankingDetail", $ranking->racerId ) . "'>
         <div class='listwrapper'>
				<div class='left_info'>
               <img src='" . Page::getImagePath( $ranking ) . "'>
            </div> 
            <div class='middle_info'>
               <p class='title'>" . $ranking->name . "</p>
               <p>
                  <span class='racer_ranking'>" . $ranking->ranking . "</span>
                  <span class='racer_points'>" . $ranking->score . "</span>
               </p>
            </div>
            <div class='right_info'>
               <p class='rider_number'>" . $ranking->racerNumber . "</p>
            </div>
         </li>
      ");
   }

?>

   </ul>
</div>
