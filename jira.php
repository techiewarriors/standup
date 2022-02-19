<?php
require 'vendor/autoload.php';

use JiraRestApi\Project\ProjectService;
use JiraRestApi\JiraException;

try {
    $proj = new ProjectService();

    print_r($proj);

    $prjs = $proj->getAllProjects();

    foreach ($prjs as $p) {
        echo sprintf("Project Key:%s, Id:%s, Name:%s, projectCategory: %s\n",
            $p->key, $p->id, $p->name, $p->projectCategory['name']
        );			
    }			
} catch (JiraRestApi\JiraException $e) {
	print("Error Occured! " . $e->getMessage());
}