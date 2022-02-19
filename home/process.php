<?php

function pr($arr1, $is_die = null) {

	echo '<pre>';
	print_r($arr1);
	echo '</pre>';

	if(!empty($is_die)) {
		die;
	}
}

$result = array();

session_start();

require '../assets/includes/auth_functions.php';

require '../assets/includes/datacheck.php';

require '../assets/includes/security_functions.php';

if(!isset($_SESSION['id']) && $_SESSION['id'] <=0) {

	$results['status'] = false;
	$results['msg'] = 'User not validated';
	die(json_encode($results));
	
}

//check_logged_out();
//pr($_POST, 1);
    /*
    * -------------------------------------------------------------------------------
    *   Securing against Header Injection
    * -------------------------------------------------------------------------------
    */

	$posted_data = array();

    foreach($_POST as $key => $value){

        $my_val = _cleaninjections(trim($value));
        $posted_data[$key] = explode(',', $my_val);
    }

	if(!isset($posted_data['question_yesterday']) && !isset($posted_data['question_today'])  && !isset($posted_data['question_challenges'])){
		
		$results['status'] = false;
		$results['msg'] = 'Data is not valid';
		die(json_encode($results));
		
	} else {

		require '../assets/setup/db.inc.php';

		$i = 1;
		$user_id = $_SESSION['id'];

		foreach($posted_data as $key => $value) {

			foreach($value as $val) {
				
				$answer = $val;
				$sql = "INSERT INTO standup_answers (user_id, question_id, answer) 
				VALUES (?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {

					$results['status'] = false;
					$results['msg'] = 'SQL Error';
					die(json_encode($results));
				}
				else {

					mysqli_stmt_bind_param($stmt, "iis", $user_id, $i, $answer);
					mysqli_stmt_execute($stmt);
				}
			}
			$i++;
		}

		$results['status'] = true;
		$results['msg'] = 'Options saved successfully.';
		die(json_encode($results));

	}


