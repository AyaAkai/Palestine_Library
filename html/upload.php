
<?php


if(isset($_POST['submit']))
{
    $db_name = "palestine_library";
    $tbl_name = "uploadbooks";
    $server = "localhost";
    $db_username = "root";
    $db_password = "";

    //connect to your database
    $connect = new mysqli($server, $db_username, $db_password, $db_name);

    if($connect->connect_error)
    {
        die("Error : (". $connect->connect_errno .") ". $connect->connect_error);
    }

    $authorName = $_POST['authorName'];
    $bookName = $_POST['bookName'];
    $pdfFile = $_FILES['pdfFile']['name'];
    $fileTmp = $_FILES['pdfFile']['tmp_name'];

    $allowed_ext = array('pdf', 'doc', 'docx');
    $file_extension = pathinfo($pdfFile, PATHINFO_EXTENSION);

    if(in_array($file_extension, $allowed_ext))
    {
        move_uploaded_file($fileTmp, $pdfFile);
        $query = "INSERT INTO uploadbooks (authorName, bookName, pdfFile) VALUES ('$authorName', '$bookName', '$pdfFile')";
        if($connect->query($query))
        {
            echo "File uploaded and saved in the database.";
        }
        else
        {
            echo "Error : ";
        }
    }
    else
    {
        echo "Error : This file extension is not allowed.";
    }
}

$connect->close();

?>