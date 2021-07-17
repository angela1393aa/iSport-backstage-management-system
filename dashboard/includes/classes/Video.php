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
        // Create query
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
        // Create query
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
                v.id = :id
            LIMIT 1';
        
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
        $this->thumbnail_path = $row['thumbnail_path'];
        $this->filePath = $row['filePath'];
        $this->description = $row['description'];
        $this->category = $row['category'];
        $this->category_name = $row['category_name'];
        $this->duration = $row['duration'];
        $this->upload_date = $row['upload_date'];
        $this->views = $row['views'];
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
        // Create query
        $query = 'UPDATE ' .
            $this->table . '
        SET
            title=:title,
            filePath=:filePath,
            description=:description,
            category=:category
        WHERE
            id=:id';
        
        // Prepare statement
        $stmt = $this->con->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->filePath = htmlspecialchars(strip_tags($this->filePath));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $this->category = (int)$this->category;

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':filePath', $this->filePath);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
?>