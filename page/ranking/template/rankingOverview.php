<reload />
<div class="content_tab" id="rankingoverview_ranking">

   <ul>

<?php
   include 'page/ranking/RankingCalculator.php';

   $raceId = CommonDbFunction::getUser()->raceFk;
   $dbFunction = new RankingDbFunction();
   $racerTasks = $dbFunction->findAll( $raceId );
   $dbFunction->close();

   $raceFinished = false;
   $raceFk = null;
   for ( $i = 0; $i < count( $racerTasks ) && $raceFk == null; $i++ ) {
      $raceFk = $racerTasks[$i]->raceFk;

   }
   $raceFinished = $raceFk != null && RaceDbFunction::isFinished( $raceFk );
   $rankings = RankingCalculator::evaluate( $racerTasks, $raceFinished );

   if ( !isset($_GET['tv']) ) {
      $i = 0;
      $end = count( $rankings );
   } else {
      $i = (Page::getTabIndex() - 2 )* Configuration::TV_SIZE;
      $end =  min( $i + Configuration::TV_SIZE, count( $rankings ));
   }


   for ( ; $i < $end; $i ++  ) {
      $ranking = $rankings[$i];
      print("
         <li onclick='" . Page::getOnClickFunction( "ranking", "rankingDetail", $ranking->racerId, "ranking=" . $ranking->ranking . "&score=" . $ranking->score ) . "'>
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
