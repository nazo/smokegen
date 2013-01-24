<?php

require_once 'Services/Bitly.php';

if (isset($_GET['t'])) {
    $word = $_GET['t'];

    $twitter_word = preg_replace("/\r\n|\r|\n/", " ", $word);

    $current_url = "http://nazone.info/smoke/?t=".urlencode($word);

    $login = 'input your bitly id';
    $apikey = 'input your bitly password';

    try {
        $bitly = new Services_Bitly($login, $apikey);
        $current_url = $bitly->shorten($current_url);
    } catch (Services_Bitly_Exception $e) {
    }

    $current_url = urlencode($twitter_word).' '.$current_url.urlencode(' #smokegen');

} else {
    $word = "";
}

$image_url = "smoke.php?w=".urlencode($word);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="ja">
<head>
<title>すもけジェネレーター</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>
すもけジェネレーター
</h1>

<p>
<img src="<?php echo $image_url ?>" />
</p>
<?php if ($word != "") : ?>
<p><a href="http://twitter.com/intent/tweet?text=<?php echo $current_url ?>" target="_blank">twitterでつぶやく</a></p>
<?php endif ?>

<form action="index.php" method="get">

言わせたいこと：<br />
<textarea style="width: 400px; height: 200px;" name="t"></textarea>

<input type="submit" value="すもけ" />

</form>

</body>
</html>

