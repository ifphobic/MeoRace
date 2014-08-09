<div class="content_tab" id="rankingoverview_ranking">
<div class="bottom_content_wrapper">
   <ul>

<?php
   
   include 'page/ranking/RankingCalculator.php';

   $dbFunction = new RankingDbFunction();
   $racerTasks = $dbFunction->findAll( CommonDbFunction::getUser()->raceFk );
   $dbFunction->close();

   $rankings = RankingCalculator::evaluate( $racerTasks );
   

   foreach ( $rankings as $ranking ) {
      print("
         <li onclick='" . Page::getOnClickFunction( "ranking", "rankingDetail", $ranking->racerId ) . "'>
            <div class='left_info'>
               <img src='" . Page::getImagePath( $ranking ) . "'>
            </div> 
            <div class='middle_info'>
               <p class='title'>" . $ranking->name . "</p>
               <p class='description'>"  . $ranking->city . ", " . $ranking->country . "</p>
            </div>
            
            <div class='middle_info racer_ranking_points'>
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
</div>
