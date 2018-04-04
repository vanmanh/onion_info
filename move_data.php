<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Hoteliers.vn - Vietnam Hospitality Network &#8211; Vietnam Hospitality Network">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="http://wordpress49.local/xmlrpc.php">
    <title>Hoteliers.vn &#8211; Vietnam Hospitality Network &#8211; Vietnam Hospitality Network</title>
</head>
<body>
<?php

header('Content-Type: text/html; charset=utf-8');
ini_set("default_charset", "UTF-8");
mb_internal_encoding("UTF-8");
iconv_set_encoding("internal_encoding", "UTF-8");
iconv_set_encoding("output_encoding", "UTF-8");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'wordpress49';

// Create connection
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, 'utf8');
/**

insert into wp_posts (
               post_title,
                post_content
             ) SELECT mod_news_lang.tieu_de, mod_news_lang.noi_dung from mod_news_lang where lang='en';

*/

function convert2Alias($cs, $lower=true)
{
    $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
    "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
    ,"ế","ệ","ể","ễ",
    "ì","í","ị","ỉ","ĩ",
    "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
    ,"ờ","ớ","ợ","ở","ỡ",
    "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
    "ỳ","ý","ỵ","ỷ","ỹ",
    "đ",
    "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
    ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
    "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
    "Ì","Í","Ị","Ỉ","Ĩ",
    "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
    ,"Ờ","Ớ","Ợ","Ở","Ỡ",
    "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
    "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
    "Đ"," ");
    $marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
    ,"a","a","a","a","a","a",
    "e","e","e","e","e","e","e","e","e","e","e",
    "i","i","i","i","i",
    "o","o","o","o","o","o","o","o","o","o","o","o"
    ,"o","o","o","o","o",
    "u","u","u","u","u","u","u","u","u","u","u",
    "y","y","y","y","y",
    "d",
    "A","A","A","A","A","A","A","A","A","A","A","A"
    ,"A","A","A","A","A",
    "E","E","E","E","E","E","E","E","E","E","E",
    "I","I","I","I","I",
    "O","O","O","O","O","O","O","O","O","O","O","O"
    ,"O","O","O","O","O",
    "U","U","U","U","U","U","U","U","U","U","U",
    "Y","Y","Y","Y","Y",
    "D","-");

    if (!$lower) {
        $cs= str_replace($marTViet, $marKoDau, $cs);
    } else {
        $cs= strtolower(str_replace($marTViet, $marKoDau, $cs));
    }
    $cs= preg_replace('/[^a-zA-Z0-9-\/]/s', '', $cs);
    return preg_replace('/-+|\//i', '-', $cs);
}


$sql = "SELECT * FROM wp_2_posts where 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $post_name = convert2Alias($row['post_title']);
        $sql = " UPDATE wp_2_posts
            SET
            post_date = '2017-12-17 07:26:02',
            post_date_gmt = '2017-12-17 07:26:02',
            post_modified = '2017-12-17 07:26:02',
            post_modified_gmt = '2017-12-17 07:26:02',
            guid = 'http://wordpress49.local/?p=".$row['ID']."',
            post_name = '".$post_name."'

            WHERE ID = ".$row['ID']."
        ";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }

        $sql1 = " insert into wp_2_term_relationships (
                object_id,
                term_taxonomy_id,
                term_order
            )
            VALUES (
                ".$row['ID'].",
                '18',
                '0'
            )
        ";
        if ($conn->query($sql1) === TRUE) {
            echo "New record created successfully";
        }
    }
} else {
    echo "0 results";
}

$conn->close();
?>
</body>
</html>
