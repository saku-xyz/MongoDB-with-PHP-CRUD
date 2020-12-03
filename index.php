<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <h1>Hello, world!</h1>
    <hr>
    <div class="text-center">
        <?php require_once "vendor/autoload.php";
        if (isset($_POST['create'])) {
            $client = new MongoDB\Client;
            $database =  $client->selectDatabase('blog');
            $collection = $database->selectCollection('articles');

            $data  = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'author' => $_POST['author'],
                // 'createdOn' => new MongoDB\BSON\UTCDateTime
            ];

            if($_FILES['file']) {
                if(move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name'])){
                    $data['fileName'] = $_FILES['file']['name'];
                } else {
                    echo "Failed to upload file.";
                }
            }

            $result = $collection->insertOne($data);
            if($result->getInsertedCount()>0) {
                echo "Article is created.";
            } else {
                echo "Failed to create Article.";
            }
        }
        ?>
    </div>

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" id="inputEmail4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" id="inputEmail4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Author</label>
                    <input type="text" class="form-control" name="author" id="inputEmail4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Select Image</label>
                    <input type="file" class="form-control" name="file" id="inputEmail4">
                </div>
            </div>

    <button type="submit" class="btn btn-primary" name="create">Sign in</button>
    </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>