<?php

ini_set('display_errors', 1);

define('TITLE', "Home");
include '../assets/layouts/header.php';
require '../assets/setup/db.inc.php';
include '../assets/includes/datacheck.php';
check_verified();

//pr($_SESSION);
$user_id = ($_SESSION['id']) ? $_SESSION['id'] : 0;
$answer_data = array();
if($user_id > 0) {

	$answer_data = getStandupAnswers($conn, $user_id);
}

?>


<main role="main" class="container">

    <div class="row">
        <div class="col-sm-3">

            <?php include('../assets/layouts/profile-card.php'); ?>

        </div>
        <div class="col-sm-9">

            <div class="d-flex align-items-center p-3 mt-5 mb-3 text-white-50 bg-purple rounded box-shadow">
                <img class="mr-3" src="../assets/images/logonotextwhite.png" alt="" width="48" height="48">
                <div class="lh-100">
                    <h6 class="mb-0 text-white lh-100">Hey there, <?php echo $_SESSION['username']; ?></h6>
                    <small>Last logged in at <?php echo date("m-d-Y", strtotime($_SESSION['last_login_at'])); ?></small>
                </div>
            </div>

            <div class="my-3 p-3 bg-white rounded box-shadow">
                <form class="task_submission_form" name="task_submission_form" id="task_submission_form">
                    <div class="wdm-questions-wrap">
                        <div class="wdm-question-header">
                            <span class="wdm-today">Today, <?= date("F jS"); ?></span>
                            <span on-change="datePicked(date)">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                        
                        <div id="msg_div"></div>
                        
                        <?php
							if(!empty($answer_data) && sizeof($answer_data) > 0) {
								//pr($answer_data, 1);
								
								foreach($answer_data as $key => $value) {

									if($key == 1) {

										echo '<div class="wdm-question">';
										echo '<h4>What did you accomplish yesterday?</h4>';

									} else if($key == 2) {

										echo '<div class="wdm-question">';
										echo '<h4>What are you planning to do today?</h4>';

									} else if($key == 3) {

										echo '<div class="wdm-question">';
										echo '<h4>What challenges stand in your way?</h4>';

									}
									
									echo '<ul id="yesterday_task_list" class="taskl_listing">';
									
										foreach($value as $val) {
									
											echo '<li>'. ucfirst($val[2]).'<span class="extraEventsItem input-group-addon"><span class="moveItem fa fa-bars"></span><span class="removeItem fa fa-times"></span></span></li>';
										}

									echo '</ul>';
									echo '</div>';
								}

							} 
							else {
							?>

								<div class="wdm-question">
									<h4>What did you accomplish yesterday?</h4>
									<ul id="yesterday_task_list" class="taskl_listing">
									</ul>

									<div class="wdm-question-input">
										<input type="text" placeholder="Add Progress..." name="question_yesterday[]" id="add_yesterday_task" class="form-control" list="issues" />
										<datalist id="issues"></datalist>
										<span onclick="addYesterDayTaskList()" class="addBtn"><i class="fa fa-plus"></i></span>
									</div>
								</div>

								<div class="wdm-question">
									<h4>What are you planning to do today?</h4>
									<ul id="planning_task_list" class="taskl_listing">
									</ul>
									<div class="wdm-question-input">
										<input type="text" placeholder="Add Plans..." name="question_today[]" id="add_today_planning" class="form-control" />
										<span onclick="addPlanningTaskList()" class="addBtn"><i class="fa fa-plus"></i></span>
									</div>
								</div>

								<div class="wdm-question">
									<h4>What challenges stand in your way?</h4>
									<ul id="challenges_task_list" class="taskl_listing">
									</ul>
									<div class="wdm-question-input">
										<input type="text" placeholder="Add Challenges..." name="question_challenges[]" id="add_challenges" class="form-control"/>
										<span onclick="addChallengesList()" class="addBtn"><i class="fa fa-plus"></i></span>
									</div>
								</div>

								<div class="wdm-question-submit">
									<button class="pushblish_standup">Publish Standup</button>
								</div>
							<?php
							}
							?>
                    </div>
                </form>
                <!-- <small class="d-block text-right mt-3">
                    <a href="#">All updates</a>
                </small> -->
            </div>

        </div>
    </div>
</main>

    <?php

    include '../assets/layouts/footer.php'

    ?>
