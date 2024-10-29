
<?php
echo "<table><tr>";
for($i='A'; $i<='Z'; $i++ )
{
    /*
    float disk_free_space ( string $directory )
    Функция возвращает размер свободного пространства в байтах, доступного для использования в указанном разделе диска
    */
    if(@diskfreespace($i.":"))
    {
        $disk = $i.":";
        echo "<td width=20%><h2><img src='DRIVE.ICO'><a href=explorer.php?dir=" . $disk . ">" . $disk. "</a></h2>&nbsp;&nbsp;</td>";
    }
}
echo "</tr></table><hr>";
if(isset($_GET["dir"]))
{
    $dir = $_GET["dir"];
    /*
    bool chdir ( string $directory )
    Изменяет текущий каталог PHP на указанный в качестве параметра каталог. Возвращает TRUE в случае успешного завершения или FALSE в случае возникновения ошибки.
    */
    @chdir($dir);
}
else
{
    return;
}
//$utfdir = iconv("Windows-1251", "UTF-8", $dir);
//echo "<h2>".$utfdir."</h2>";
echo "<h2>".$dir."</h2>";

/*
resource opendir ( string $path )
Возвращает дескриптор каталога для последующего использования с функциями closedir(), readdir() и rewinddir().
*/
$handle = @opendir($dir);

/*
string readdir ( resource $dir_handle )
Возвращает имя следующего по порядку элемента каталога. Имена элементов возвращаются в порядке, зависящем от файловой системы.
*/

while($elem = @readdir($handle))
{
    if(($elem!=".")&&($elem!=".."))
    {
        $path = $dir."/".$elem;
        /*
        bool is_dir ( string $filename )
          Возвращает TRUE, если файл существует и является директорией. Если filename - это относительное имя файла, оно будет проверено относительно текущей рабочей директории.
        */
        //$elem = iconv("Windows-1251", "UTF-8", $elem);
        if(is_dir($path))
        {
            $path = rawurlencode($path);
            //$path = iconv("Windows-1251", "UTF-8", $path);
            echo "<a href=explorer.php?dir=".$path.">".$elem."</a><br>";
        }
        else echo $elem."<br>";
    }
}

@closedir($handle);
?>
