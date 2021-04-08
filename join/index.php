<?php
session_start();
require ('../dbconnect.php');

//※"!"で否定する
//$_POSTが空では"ない"時にエラーチェックを走らせる
if (!empty($_POST)) {
	if ($_POST['name'] === '') {
		$error['name'] = 'blank'; //内容が入力されていない場合のエラー
	}
	
	if ($_POST['email'] === '') {
		$error['email'] = 'blank'; //内容が入力されていない場合のエラー
	}
	
	//※"strlen"を使うと文字の長さを測って数字で返す
	//4文字以下の場合はエラーを表示
	if (strlen($_POST['password']) < 4) {
		$error['password'] = 'length'; //内容が入力されていない場合のエラー
	}
	
	if ($_POST['password'] === '') {
		$error['password'] = 'blank'; //内容が入力されていない場合のエラー
	}

	//※"substr"でfileName後ろの三文字 = 拡張子部分を得ることができる
	//拡張子が"jpb","gif","png"の場合は画像として認識するが,それ以外の場合は'type'部分のerrorを表示させる
	$fileName = $_FILES['image']['name'];
	if (!empty($fileName)) {
		$ext = substr($fileName, -3); 
		if ($ext != 'jpg' && $ext !='gif' && $ext != 'png') {
			$error['image'] = 'type';
		}
	}
	
	//アカウント重複をチェック
	if(empty($error)) {
		$member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
		$member->execute(array($POST['email']));
		$record = $member->fetch();
		if ($record['cnt'] > 0) {
			$error['email'] = 'duplicate';
		}
	}


	// $errorがemptyだった場合は"check.php"にジャンプする
	// errorが発生していない場合にSESSIONを走らせ"join"に$_POSTの内容を保存
	//ファイル名20210408081620myface.png 
	//
	if (empty($error)) {
		$image = date('YmdHis') . $_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
		$_SESSION['join'] = $_POST;	
		$_SESSION['join']['image'] = $image;
		header('Location: check.php');
		exit ();
	}
}

//$a_REQUEST action = rewriteだった場合、書き直しとみなしPOSTにSESSION 'join'を代入
if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
	$_POST = $_SESSION['join'];
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>

	<link rel="stylesheet" href="../style.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>会員登録</h1>
</div>


<div id="content">
<p>次のフォームに必要事項をご記入ください。</p>
<!-- ※"enctype~"はファイルアップロードする際は必ず必要 -->
<form action="" method="post" enctype="multipart/form-data">　
	<dl>
		<dt>ニックネーム<span class="required">必須</span></dt>
		<dd>
			<!-- value属性に入力した内容（名前）を表示させる ※htmlspecialcharsを忘れずに -->
        	<input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>" /> 
			<!-- ニックネーム入力空白時にエラーを表示させる -->
			<?php if ($error['name'] === 'blank'): ?> 
			<p class="error">* ニックネームを入力して下さい</p>
			<?php endif; ?>

		</dd>
		<dt>メールアドレス<span class="required">必須</span></dt>
		<dd>
			<!-- value属性に入力した内容（メールアドレス）を表示させる ※htmlspecialcharsを忘れずに -->
        	<input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>" />
			<?php if ($error['email'] === 'blank'): ?> 
			<!-- メールアドレス入力空白時にエラーを表示させる -->
			<p class="error">* メールアドレスを入力して下さい</p>
			<?php endif; ?>
			<?php if ($error['email'] === 'duplicate'): ?> 
			<!-- メールアドレス入力空白時にエラーを表示させる -->
			<p class="error">* 指定されたメールアドレスは既に登録されています</p>
			<?php endif; ?>
		<dt>パスワード<span class="required">必須</span></dt>
		<dd>
			<!-- value属性に入力した内容（パスワード）を表示させる ※htmlspecialcharsを忘れずに -->
        	<input type="password" name="password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>" />
			<?php if ($error['password'] === 'length'): ?> 
			<!-- パスワード入力空白時にエラーを表示させる -->
			<p class="error">* パスワードは4文字以上で入力して下さい</p>
			<?php endif; ?>

			<?php if ($error['password'] === 'blank'): ?> 
			<!-- パスワード入力空白時にエラーを表示させる -->
			<p class="error">* パスワードを入力して下さい</p>
			<?php endif; ?>
        </dd>
		<dt>写真など</dt>
		<dd>
        	<input type="file" name="image" size="35" value="test"  />
			<?php if ($error['image'] === 'type'): ?> 
			<!-- 写真アップロード時に指定した拡張子以外ならエラーを表示させる -->
			<p class="error">* 写真などは「.gif」「.jpg」「.png」形式の画像を指定して下さい</p>
			<?php endif; ?>
			<?php if (!empty($error)): ?>
			<p class="error">画像を改めて指定してください</p>
			<?php endif; ?>
        </dd>
	</dl>
	<div><input type="submit" value="入力内容を確認する" /></div>
</form>
</div>
</body>
</html>
