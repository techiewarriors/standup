<?php

$path = realpath('../../vendor/autoload.php');
require $path;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\JiraException;
use JiraRestApi\Configuration\ArrayConfiguration;

function filterArray($needle, $haystack) {
	if (stripos($haystack, $needle) !== false) return true;
}

if(isset($_POST['search_key'])) {
	extract($_POST);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://testdeveloper.atlassian.net/rest/agile/1.0/board/1/sprint/1/issue',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	CURLOPT_HTTPHEADER => array(
		'Accept: application/json',
		'Authorization: Basic dGFydW4uY2hvcHJhMTBAZ21haWwuY29tOmNTZ3E2WnJoeU1ZcmhJVldobmZONzJEMg==',
		'Cookie: atlassian.xsrf.token=ef4fa6c7-9205-4ba6-834a-8a408e3b989d_3a6076af70e6ac8744b64777bc8a98a6cb1043c2_lin'
	),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$data = json_decode($response);

	$issues = [];

	if(isset($data->issues) && count($data->issues) > 0) {
		$all_issues = $data->issues;
		foreach($all_issues as $key => $issue) {
			if(isset($issue->fields->summary) && strlen($issue->fields->summary) > 0) {
				$issues[] = $issue->fields->summary;
			}
		}
	}

	$result_data = array_filter($issues, function ($v) {
		return filterArray($_POST['search_key'], $v);
	});

	echo json_encode($result_data); die;
}

// Check and Create New issue
if(isset($_POST['new_issue'])) {
	$issue = $_POST['new_issue'];

	$jql = 'project in (TES) and status in ("To do", "In Progress")';

	try {
	    $issueService = new IssueService(
			new ArrayConfiguration(
				array(
					'jiraHost' => 'https://testdeveloper.atlassian.net',
					'jiraUser' => 'tarun.chopra10@gmail.com',
					'jiraPassword' => 'cSgq6ZrhyMYrhIVWhnfN72D2',
				)
		    )
		);

		$ret = $issueService->search($jql);

		$issues_bag = [];

	    if(isset($ret->issues) && count($ret->issues) > 0) {
			foreach($ret->issues as $issue_v) {
				if(isset($issue_v->fields->summary) && strlen($issue_v->fields->summary) > 0) {
					$issues_bag[] = $issue_v->fields->summary;
				}
			}
		}

		if(!in_array($issue, $issues_bag)) {
			// Create Issue
			$issueField = new IssueField();

			$issueField
				//->setProjectKey("TES-3")
        		->setSummary($issue)
        		//->setAssigneeName("tarun")
        		//->setPriorityName("Critical")
        		->setIssueType("Bug")
        		//->setDescription("Full description for issue")
        		->setProjectId("10000");

			$issueService = new IssueService(
				new ArrayConfiguration(
					array(
						'jiraHost' => 'https://testdeveloper.atlassian.net',
						'jiraUser' => 'tarun.chopra10@gmail.com',
						'jiraPassword' => 'cSgq6ZrhyMYrhIVWhnfN72D2',
					)
		        )
			);	
			$create_i = $issueService->create($issueField);

			echo json_encode([
				'message' => 'Task created successfully.',
				'flag' => 1
			]);
		}
	    
	} catch (JiraRestApi\JiraException $e) {
	    echo json_encode([
			'message' => $e->getMessage(),
			'flag' => 0
		]);
	} catch (JsonMapper_Exception $e) {
	    echo json_encode([
			'message' => $e->getMessage(),
			'flag' => 0
		]);
	}
}