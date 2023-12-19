<!DOCTYPE html>
<html>
<head>
    <title>Button Page</title>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .button {
            background-color: red;
            color: white;
            padding: 100px;
            font-size: 32px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['capture'])) {
        $command = 'gphoto2 --capture-image-and-download';
        $output = shell_exec($command);
        // You can process the output here if needed
        echo "Image captured!";
    }
}
?>
<body>
    <form method="post" action="">
        <button class="button" type="submit" name="capture">Capture Image</button>
    </form>
</body>
</html>