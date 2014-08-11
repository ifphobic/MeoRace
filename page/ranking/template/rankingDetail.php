<div class="content_tab" id="ranking_detail_tasks">

<div class="bottom_content_wrapper">

   
   <ul>

<?php

   $dbFunction = new RankingDbFunction();
   $racerTasks = $dbFunction->findAll( null, $_GET['id'] );
   $dbFunction->close();

   foreach( $racerTasks as $racerTask ) {
      ?>
      <li onclick='<?php print( Page::getOnClickFunction( "ranking", "taskDetail", $racerTask->racerTaskId ) ) ?>'>
         <div class="left_info">
            <p class="manifest_number">12</p>
         </div> 
       
         <div class="middle_info">
            <p class="title"><?php print( $racerTask->taskName ) ?></p>
            <p class="description"><?php print( $racerTask->taskDescription ) ?></p>
         </div>
      
         <div class="right_info">
            <p class="manifest_points">100</p>
            <p class="manifest_maxduration">00:02:10</p>
         </div>
    </li>


      <?php
   }

?>

   </ul>
</div>
</div>
