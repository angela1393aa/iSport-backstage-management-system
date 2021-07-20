<?php
class Video {

    private $con;
    private $table = 'video_file';
    private $valid = '0';
    private $ffprobePath = 'ffmpeg/bin/ffprobe';

    // Properties
    public $id, $title, $thumbnail_path, $filePath, $description, $category, $category_name, $duration, $upload_date, $views;

    public function __construct($con) {
        $this->con = $con;
    }

    // Get video list
    public function getVideos() {
        // // Create query
        // $query = 'SELECT *
        //     FROM
        //         ' . $this->table . '
        //     WHERE
        //         valid=1
        //     ORDER BY
        //         upload_date
        //     DESC';

        // // Prepare statement
        // $stmt = $this->con->prepare($query);
        // $stmt->execute();

        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $data = array();

        // // Set properties
        // $this->id = $row['id'];

        // while($row) {
        //     $data[] = array(
        //         'id' => $row['id'],
        //         'title' => $row['title'],
        //         'description' => $row['description'],
        //         'category' => $row['category'],
        //         'duration' => $row['duration'],
        //         'upload_date' => $row['upload_date'],
        //         'views' => $row['views']
        //     );
        // }
        // return $data;

        // $query = 'SELECT * FROM category';

        // // Prepare statement
        // $stmt = $this->con->prepare($query);

        // // Execute
        // $stmt->execute();

        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // // while()

        // $query = 'SELECT *
        //     FROM
        //         video_file_thumbnails
        //     WHERE
        //         id=:videoId';

        // // Prepare statement
        // $stmt = $this->con->prepare($query);
        
        // // Bind ID
        // $stmt->bindParam(":videoId", $this->id);

        // // Execute
        // $stmt->execute();
        // return;

        $query = 'SELECT 
                c.id as category_id,
                c.name as category_name,
                t.filePath as thumbnail_path,
                v.id,
                v.title,
                v.filePath,
                v.description,
                v.category,
                v.duration,
                v.upload_date,
                v.views
            FROM
                ' . $this->table . ' v
            LEFT JOIN
                category c ON v.category = c.id
            LEFT JOIN
                video_file_thumbnails t ON v.id = t.videoId AND selected=1
            WHERE
                v.valid=1
            ORDER BY
                v.upload_date DESC';
            
        // Prepare statement
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get one video
    public function getOneVideo() {
        // Get video data
        $query = 'SELECT *
            FROM
                ' . $this->table . '
            WHERE
                id=:id';
        
        // Prepare statement
        $stmt = $this->con->prepare($query);

        // Bind ID
        $stmt->bindParam(":id", $this->id);

        // Execute
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->filePath = $row['filePath'];
        $this->description = $row['description'];
        $this->category = $row['category'];
        $this->duration = $row['duration'];
        $this->upload_date = $row['upload_date'];
        $this->views = $row['views'];

        // Get categories
        $query = 'SELECT * FROM category';
        
        // Prepare statement
        $stmt = $this->con->prepare($query);

        // Execute
        $stmt->execute();

        $categories = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = $row['name'];
        }
        $this->category_name = $categories;

        // Get thumbnails data
        $query = 'SELECT *
            FROM
                video_file_thumbnails
            WHERE 
                videoId=:videoId';
        
        // Prepare statement
        $stmt = $this->con->prepare($query);

        // Bind param
        $videoId = $this->id;
        $stmt->bindParam(":videoId", $videoId);

        // Execute
        $stmt->execute();

        // Get all thumbnails
        $thumbnails = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $thumbnails[] = $row;
        }
        $this->thumbnail_path = $thumbnails;
    }

    // Delete one video
    public function deleteVideo() {
        // Create query
        $query = 'UPDATE ' . 
                $this->table . '
            SET
                valid=:valid
            WHERE
                id=:id';

        // Prepare statement
        $stmt = $this->con->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(":valid", $this->valid);
        $stmt->bindParam(":id", $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Update one video
    public function updateVideo() {
        // Update video detail
        $query = 'UPDATE ' .
            $this->table . '
        SET
            title=:title,
            description=:description,
            category=:category
        WHERE
            id=:id';
        
        // Prepare statement
        $stmt = $this->con->prepare($query);

        // Clean data
        $this->thumbnailId = htmlspecialchars(strip_tags($this->thumbnailId));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->category = (int)$this->category;
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        $stmt->execute();

        // Update seleted thumbnail(Update->all 0)
        $query = 'UPDATE
                video_file_thumbnails
            SET
                selected=0
            WHERE
                videoId=:videoId';
        
        // Prepare statement
        $stmt = $this->con->prepare($query);

        // Bind param
        $videoId = $this->id;
        $stmt->bindParam(':videoId', $videoId);

        // Execute
        $stmt->execute();

        // Update 1->0
        $query = 'UPDATE
                video_file_thumbnails
            SET
                selected=1
            WHERE
                id=:thumbnailId';
        
        // Prepare statement
        $stmt = $this->con->prepare($query);

        // Bind param
        $thumbnailId = $this->thumbnailId;
        $stmt->bindParam(':thumbnailId', $thumbnailId);

        // Execute
        $stmt->execute();

        return true;
    }
}
?>