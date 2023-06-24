<?php

//Initializing Variables 
$student_name = '';
$student_id = '';
$courses = array();
$enrolled_courses = array();
$mentors = array();

//Connecting to database
$conn = new mysqli($servername, $username, $password);

//Create a function to get the students data
function studentData($student_name,$student_id){
    global $conn;
    $sql = "SELECT * FROM students WHERE student_name = '".$student_name."' AND student_id = '".$student_id."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}

//Create a function to get the list of courses
function getCourses(){
    global $conn;
    $sql = "SELECT * FROM courses";
    $result = $conn->query($sql);
    $courses = array();
    while($row = $result->fetch_assoc()){
        $courses[] = $row;
    }
    return $courses;
}

//Create a function to get the list of enrolled courses
function enrolledCourses($student_id){
    global $conn;
    $sql = "SELECT * FROM enrolled_courses WHERE student_id = '".$student_id."'";
    $result = $conn->query($sql);
    $enrolled_courses = array();
    while($row = $result->fetch_assoc()){
        $enrolled_courses[] = $row;
    }
    return $enrolled_courses;
}

//Create a function to get the list of mentors
function getMentors(){
    global $conn;
    $sql = "SELECT * FROM mentors";
    $result = $conn->query($sql);
    $mentors = array();
    while($row = $result->fetch_assoc()){
        $mentors[] = $row;
    }
    return $mentors;
}

//Create a function to enroll the student in the selected courses
function enrollCourse($student_id,$course_id){
    global $conn;
    $sql = "INSERT INTO enrolled_courses (student_id, course_id) VALUES ('$student_id', '$course_id')";
    $result = $conn->query($sql);
    return $result;
}

//Create a function to fetch the mentor assigned for the enrolled course
function getMentorForCourse($course_id){
    global $conn;
    $sql = "SELECT * FROM mentors WHERE course_id = '".$course_id."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}

//Create a function to start the course
function startCourse($course_id,$mentor_id){
    global $conn;
    $sql = "UPDATE enrolled_courses SET status = 'started', mentor_id = '".$mentor_id."' WHERE course_id = '".$course_id."'";
    $result = $conn->query($sql);
    return $result;
}

//Create a function to update the student's progress
function updateProgress($student_id,$course_id,$progress){
    global $conn;
    $sql = "UPDATE enrolled_courses SET progress = '".$progress."' WHERE student_id = '".$student_id."' AND course_id = '".$course_id."'";
    $result = $conn->query($sql);
    return $result;
}

//Create a function to complete the course
function completeCourse($student_id,$course_id){
    global $conn;
    $sql = "UPDATE enrolled_courses SET status = 'completed' WHERE student_id = '".$student_id."' AND course_id = '".$course_id."'";
    $result = $conn->query($sql);
    return $result;
}

//Create a function to get the transcripts for the student
function getTranscripts($student_id){
    global $conn;
    $sql = "SELECT * FROM enrolled_courses WHERE student_id = '".$student_id."'";
    $result = $conn->query($sql);
    $transcripts = array();
    while($row = $result->fetch_assoc()){
        $transcripts[] = $row;
    }
    return $transcripts;
}

//Create a function to get the course details
function getCourseDetails($course_id){
    global $conn;
    $sql = "SELECT * FROM courses WHERE course_id = '".$course_id."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}

//Create a function to get the mentor details
function getMentorDetails($mentor_id){
    global $conn;
    $sql = "SELECT * FROM mentors WHERE mentor_id = '".$mentor_id."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}
?>