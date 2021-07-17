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

    // Set id to delete(update)
    $video->id = $data->id;

    // Delete(update) video
    if($video->deleteVideo()) {
        echo json_encode(
            array('message' => 'Video Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Video Not Deleted')
        );
    }

?>