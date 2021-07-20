<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once('../../includes/config.php');
    require_once('../../includes/classes/Video.php');

    // Instantiate video obj
    $video = new Video($db_host);
    
    // Get id
    $video->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get video
    $video->getOneVideo();

    // Create array
    $videoArr = array(
        'id' => $video->id,
        'thumbnails' => $video->thumbnail_path,
        'title' => $video->title,
        'filePath' => $video->filePath,
        'description' => $video->description,
        'category_name' => $video->category_name,
        'category_id' => $video->category,
        'duration' => $video->duration,
        'upload_date' => $video->upload_date,
        'views' => $video->views
    );

    // Turn to JSON & output
    echo json_encode($videoArr, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>
