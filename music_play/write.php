<?php
include 'noticeboard/dbconfig.php';

$name 		= (isset($_POST['name'		]) && $_POST['name'			] != '') ? $_POST['name'		] : '';
$password	= (isset($_POST['password']) && $_POST['password'	] != '') ? $_POST['password'] : '';
$subject 	= (isset($_POST['subject'	]) && $_POST['subject'	] != '') ? $_POST['subject'	] : '';
$content 	= (isset($_POST['content'	]) && $_POST['content'	] != '') ? $_POST['content'	] : '';
$code 		= (isset($_POST['code'		]) && $_POST['code'			] != '') ? $_POST['code'		] : '';

if ($code == 'undefined') {
	$code = 'freeboard';
}

// 비밀번호 단방향 암호화
$pwd_hash = password_hash($password, PASSWORD_BCRYPT);

// 정규식, 정규표현식 EXP
preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $content, $matches);


$img_array = [];
foreach($matches[1] as $key => $val) {
	list($type, $data) = explode(';', $val);
	// $type : data:image/png
	// $data : base64,AAFBfj42 ...
	list(, $ext) = explode('/', $type);
	$ext = ($ext == 'jpeg') ? 'jpg' : $ext;
	$filename = date('YmdHis') .'_'. $key .'.'.$ext; // 2023030311111_0.png
	
	list(,$base64_decode_data) = explode(',', $data);

	$rs_code = base64_decode($base64_decode_data);
	file_put_contents("noticeboard/upload/".$filename, $rs_code);

	$img_array[] = "noticeboard/upload/".$filename;
	$content = str_replace($val, "noticeboard/upload/".$filename, $content);
}

$imglist = implode('|', $img_array);

// echo $imglist;

// DB에 INSERT
$sql = "INSERT INTO board(code, name, subject, password, content, imglist, ip, rdate) values (:code, :name, :subject, :password, :content, :imglist, :ip, now())";

$ip = $_SERVER['REMOTE_ADDR'];

$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->bindParam(':code', $code);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':subject', $subject);
$stmt->bindParam(':password', $pwd_hash);
$stmt->bindParam(':content', $content);
$stmt->bindParam(':imglist', $imglist);
$stmt->bindParam(':ip', $ip);
$stmt->execute();



$arr = ['result' => 'success'];

$j = json_encode($arr); // {"result" : "success" }
echo $j;
// die($j);