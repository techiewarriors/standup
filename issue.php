<?php
require 'vendor/autoload.php';

use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;

try {
    $issueService = new IssueService();
	
    $queryParam = [
        'fields' => [  // default: '*all'
            'summary',
            'comment',
        ],
        'expand' => [
            'renderedFields',
            'names',
            'schema',
            'transitions',
            'operations',
            'editmeta',
            'changelog',
        ]
    ];
            
    $issue = $issueService->get('CLIEN-375', $queryParam);
	
    var_dump($issue->fields);	
} catch (JiraRestApi\JiraException $e) {
	print("Error Occured! " . $e->getMessage());
}
?>