<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once('../../includes/config.php');
    require_once('../../includes/classes/Video.php');

    // Instantiate video obj
    $video = new Video($db_host);
    
    // Video query
    $result = $video->getVideos();
    // Get row count
    $num = $result->rowCount();
    // Check if any posts
    if($num > 0) {
        // Video array
        $videoArr = array();
        $videoArr['videoData'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            // Format upload_date
            $upload_date = date("Y年m月d日<\b\\r>A g:i", strtotime($upload_date));

            $videoItem = array(
                'id' => $id,
                'thumbnail' => $thumbnail_path,
                'title' => $title,
                'filePath' => $filePath,
                'description' => $description,
                'category_name' => $category_name,
                'category_id' => $category,
                'duration' => $duration,
                'upload_date' => $upload_date,
                'views' => $views
            );

            // Push to data
            array_push($videoArr['videoData'], $videoItem);
        }

        // Turn to JSON & output
        echo json_encode($videoArr, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    } else {
        // No videos
        echo json_encode(
            array('message' => 'No posts found')
        );
    }
?>
