<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form action="userCreate.php" method="post">
            <div class="mb-2">
                <label for="article_name">作者</label>
                <input type="text" class="form-control" name="article_name" id="article_name" required>
            </div>
            <div class="mb-2">
                <label for="category">分類</label>
                <select name="category" id="category">
                    <option value="1">有氧</option>
                    <option value="2">重訓</option>
                    <option value="3">tabata</option>
                    <option value="4">核心</option>
                    <option value="5">飲食</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="added_by">標題</label>
                <input type="text" class="form-control" name="added_by" id="added_by" required>
            </div>
            <div class="mb-2">
                    <label for="content">內容:</label>
                    <textarea class="form-control" rows="30" name="content" id="content" required></textarea>
                </div>
            <button class="btn btn-info" type="submit">新增</button>
        </form>
    </div>
</body>
</html>