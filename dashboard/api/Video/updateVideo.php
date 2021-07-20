<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require_once('../../includes/config.php');
    require_once('../../includes/classes/Video.php');

    // Instantiate video obj
    $video = new Video($db_host);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set id to Update
    $video->id = $data->id;
    $video->thumbnailId = $data->thumbnailId;
    $video->title = $data->title;
    $video->description = $data->description;
    $video->category = $data->category;

    // Update video
    if($video->updateVideo()) {
        echo json_encode(
            array('message' => 'Video Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Video Not Updated')
        );
    }

?>