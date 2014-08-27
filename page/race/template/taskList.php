<div class="content_tab" id="taskdispatch_dispatch">

<?php

   $user = CommonDbFunction::getUser();
   $dbFunction = new RaceDbFunction();
   $race = $dbFunction->findById( $user->raceFk );
   $dbFunction->close();
   print( "<b>Race: " . $race->name . "</b> (" . CommonPageFunction::getLink("race", "raceEdit", $user->raceFk, "edit" ) . ")<br>" );
   print( "Status: " . $race->status . "<br><br>" );
   
   $dbFunction = new TaskDbFunction();
   $tasks = $dbFunction->findAll( $user->raceFk );
   $dbFunction->close();
?>                     

<div class='new_button' onclick='<?php print(Page::getOnClickFunction( "race", "taskEdit", null, "New Task" ) ) ?> '>+ New Task</div>

        
<p class="heading">Tasks</p>

<?php
   foreach ( $tasks as $task ) {
      print("
			<ul>
				<li onclick='" . Page::getOnClickFunction( "race", "deliveryList", $task->taskId, "Edit") . "'>
					<div class='listwrapper'>
         			<div class='left_info'>
            			<p class='manifest_number'>" . $task->name . "</p>
						</div>
						<div class='middle_info'>
   						<p class='title'>" . $task->description. "</td>
						
							<p> 
								<span class='manifest_points'>" . $task->price . "</span>
            				<span class='manifest_maxduration'>" . Page::readableDuration( $task->maxDuration ) . "</span>
							</p>
           			</div>
         			<div class='right_info'>
						</div>	
					</div>			
			</li>
		</ul>

      ");

      if ( array_key_exists( "deleteTask", $_GET ) && $_GET['deleteTask'] == $task->taskId ) {
         Page::printFormStart("race", "taskDelete");
         print("<input type='hidden' name='raceId' value='" . $race->raceId . "' />");
         print("<input type='hidden' name='taskId' value='" . $task->taskId . "' />");
         Page::printFormEnd( "confirm delete" );
      } else {
         print( CommonPageFunction::getLink("race", "taskList", $race->raceId, "delete", "deleteTask=" . $task->taskId, 0 ) );
      }      

   }
?>   
 
