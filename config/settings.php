<?php
/**
 * Created by PhpStorm.
 * User: mnqf2zp
 * Date: 10/31/17
 * Time: 12:00
 */

return [
    'project_templates' => [
        'first_role' => 'Owner',
        'issue_types' => [
            [//bug
                'name' => 'BUG',
                'color' => '#b51b27'
            ],
            [//user story
                'name' => 'USER STORY',
                'color' => '#1a84b5'
            ]
        ],
        'statuses' => [
            [
                'name' => 'New',
                'color' => '#909090'
            ],
            [
                'name' => 'Ready',
                'color' => '#75e524'
            ],
            [
                'name' => 'In Progress',
                'color' => '#becc00'
            ],
            [
                'name' => 'Done',
                'color' => '#0059a8'
            ],
        ],
        'task_statuses' => [
            [
                'name' => 'New',
                'color' => '#909090'
            ],
            [
                'name' => 'Doing',
                'color' => '#becc00'
            ],
            [
                'name' => 'Done',
                'color' => '#0059a8',
                'is_closed' => 'true'
            ],
        ]
    ]
];