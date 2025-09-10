<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Resume - String Formatting</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 700px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
        }
        h1, h2 {
            border-bottom: 2px solid #444;
            padding-bottom: 4px;
        }
        .section {
            margin-bottom: 25px;
        }
        .job {
            margin-bottom: 15px;
        }
        .job-title {
            font-weight: bold;
            font-size: 1.1em;
        }
        .company-duration {
            font-style: italic;
            color: #666;
            margin-bottom: 6px;
        }
        ul.skills {
            list-style: square inside;
            padding-left: 0;
        }
    </style>
</head>
<body>

<?php

// Data arrays
$personal = [
    'name' => 'Bhargav Patel',
    'title' => 'Software Engineer',
    'email' => 'bhargav@example.com',
    'phone' => '+1-555-123-4567',
    'address' => '123 Elm Street, Springfield, USA'
];

$education = [
    ['degree' => 'MCA', 'school' => 'State University', 'year' => 2023, 'details' => 'Focus on Software Engineering'],
    ['degree' => 'BSc Computer Science', 'school' => 'City College', 'year' => 2020, 'details' => 'Graduated with distinction']
];

$experience = [
    [
        'title' => 'Junior Developer',
        'company' => 'Tech Corp',
        'duration' => 'July 2023 - Present',
        'tasks' => [
            'Develop web applications using PHP and JavaScript',
            'Maintain and improve existing systems',
            'Collaborate with cross-functional teams'
        ]
    ],
    [
        'title' => 'Intern',
        'company' => 'Innovate Labs',
        'duration' => 'Jan 2023 - June 2023',
        'tasks' => [
            'Assisted in software testing',
            'Documented project requirements',
            'Supported development team'
        ]
    ]
];

$skills = ['PHP', 'JavaScript', 'HTML5', 'CSS3', 'MySQL', 'Git', 'Laravel'];

// Helper functions for string formatting
function formatPersonalInfo($p) {
    // Using sprintf for formatted string
    return sprintf(
        "<h1>%s</h1><h2>%s</h2><p>Email: <a href='mailto:%s'>%s</a><br>Phone: %s<br>Address: %s</p>",
        htmlspecialchars($p['name']),
        htmlspecialchars($p['title']),
        htmlspecialchars($p['email']),
        htmlspecialchars($p['email']),
        htmlspecialchars($p['phone']),
        htmlspecialchars($p['address'])
    );
}

function formatEducation($eduArr) {
    $output = "<div class='section'><h2>Education</h2>";
    foreach ($eduArr as $edu) {
        $output .= sprintf(
            "<p><strong>%s</strong>, %s (%d)<br>%s</p>",
            htmlspecialchars($edu['degree']),
            htmlspecialchars($edu['school']),
            intval($edu['year']),
            htmlspecialchars($edu['details'])
        );
    }
    $output .= "</div>";
    return $output;
}

function formatExperience($expArr) {
    $output = "<div class='section'><h2>Work Experience</h2>";
    foreach ($expArr as $job) {
        $output .= "<div class='job'>";
        $output .= sprintf("<p class='job-title'>%s</p>", htmlspecialchars($job['title']));
        $output .= sprintf("<p class='company-duration'>%s | %s</p>", htmlspecialchars($job['company']), htmlspecialchars($job['duration']));
        // Using implode to build bullet points dynamically
        $tasks = array_map(fn($task) => "<li>" . htmlspecialchars($task) . "</li>", $job['tasks']);
        $output .= "<ul>" . implode("", $tasks) . "</ul>";
        $output .= "</div>";
    }
    $output .= "</div>";
    return $output;
}

function formatSkills($skillsArr) {
    // Join skills with comma for inline list
    $skillsLine = implode(", ", array_map('htmlspecialchars', $skillsArr));
    return "<div class='section'><h2>Skills</h2><p>" . $skillsLine . "</p></div>";
}

// Output the resume using string formatting techniques
echo formatPersonalInfo($personal);
echo formatEducation($education);
echo formatExperience($experience);
echo formatSkills($skills);

?>

</body>
</html>
