<?php header('Content-Type: text/html; charset=utf-8');
if ($_GET['ajax']) {
    $task = $_GET['task'];
    //sleep(1);
    $result = $task();
    exit();
}
function testFileGetContents()
{
    $content = file_get_contents('https://www.yandex.ru/');
    if (strlen($content) > 0) {
        echo ' - <font color="green">успешно!</font>';
    } else {
        echo ' - <font color="red">ошибка!</font>';
    }
    return $result;
}
function testCurl()
{
    if (!function_exists('curl_init')) {
        echo ' - <font color="red">возможно не поддерживается!</font>';
        return false;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.yandex.ru/');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0");
    $out = curl_exec($ch);
    curl_close($ch); 
    if (strlen($out) > 0) {
        echo ' - <font color="green">успешно!</font>';
    } else {
        echo ' - <font color="red">ошибка!</font>';
    }
    return $result;
}

function testCurlSaveFile()
{
    if (!function_exists('curl_init')) {
        echo ' - <font color="red">возможно не поддерживается!</font>';
        return false;
    }
    $ch = curl_init('https://yastatic.net/morda-logo/i/apple-touch-icon/ru-180x180.png');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $file = curl_exec($ch);
    curl_close($ch);
    $fp = @fopen('ru-180x180.png','x');
    @fwrite($fp, $file);
    @fclose($fp);
    if (is_file('ru-180x180.png')) {
        echo ' - <font color="green">успешно!</font>';
        @unlink('ru-180x180.png');
    } else {
        echo ' - <font color="red">ошибка! (<a target="_blank" href="http://www.php.su/functions/?cat=curl">подробнее...</a>)</font>';
    }
    return strlen($file);
}

function testCopy()
{
    if (@copy('https://yastatic.net/morda-logo/i/apple-touch-icon/ru-180x180.png', 'ru-180x180.png')) {
        echo ' - <font color="green">успешно!</font>';
        @unlink('ru-180x180.png');
    } else {
        echo ' - <font color="red">ошибка! (<a target="_blank" href="http://www.php.su/copy">подробнее...</a>)</font>';
    }
}

function testFileGetContentsSaveFile()
{
    $file = @file_get_contents('https://yastatic.net/morda-logo/i/apple-touch-icon/ru-180x180.png');
    @file_put_contents('ru-180x180.png', $file);
    if (is_file('ru-180x180.png')) {
        echo ' - <font color="green">успешно!</font>';
        @unlink('ru-180x180.png');
    } else {
        echo ' - <font color="red">ошибка! (<a target="_blank" href="http://www.php.su/file_get_contents">подробнее...</a>)</font>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>WPGrabber Test 2.1.4</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <script type="text/javascript" src="https://yastatic.net/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    function __start()
    {
        $('#display').html('');
        $('#sbmt').hide();
        $('#loading').show();
        __echo('1. Тестированиe внешних запросов из php-функции file_get_contents()...');       
        $.get('?ajax=1&task=testFileGetContents', function( data ) {
            __echo( data );
            
            __echo('<br>2. Тестированиe работы библиотеки CURL...');       
            $.get('?ajax=1&task=testCurl', function( data ) {
                __echo( data );
                
                __echo('<br>3. Тестированиe внешних запросов из php-функции copy()...');
                 $.get('?ajax=1&task=testCopy', function( data ) {
                    __echo( data );
                    
                    __echo('<br>4. Тестированиe сохранения файла из php-функции file_get_contents()...');
                    $.get('?ajax=1&task=testFileGetContentsSaveFile', function( data ) {
                        __echo( data );
                        
                        __echo('<br>5. Тестированиe сохранения файла с помощью библиотеки CURL...');
                        $.get('?ajax=1&task=testCurlSaveFile', function( data ) {
                            __echo( data );
                            
                            __echo('<br><br>Тестирование завершено!');
                            
                            $('#sbmt').show();
                            $('#loading').hide();
                        
                        }); // testCurlSaveFile
                        
                    }); // testFileGetContentsSaveFile
                    
                 }); // testCopy
                 
            });  // testCurl
            
        }); // testFileGetContents
        $('#sbmt').attr('value', 'Перезапустить тестирование...');
         /*__echo('Тестированиe php-функции file_get_contents()...'); 
        $.ajax({
          type: "GET",
          async: false,
          url: "?ajax=1&task=testFileGetContents",
        }).done(function( data ) {
            __echo( data );
        });
        __echo('<br>Тестированиe библиотеки CURL...'); 
        $.ajax({
          type: "GET",
          async: false,
          url: "?ajax=1&task=testCurl",
        }).done(function( data ) {
            __echo( data );
        });*/
/*        __echo('<br>Тестированиe библиотеки CURL...');       
        $.get('?ajax=1&task=testCurl', function( data ) {
            __echo( data );
        });  */
/*        $.get('?ajax=1&task=2', function( data ) {
            __echo( data );
        });  */
    }
    function __echo(text) {
        $('#display').html($('#display').html() + text);
    }
    </script>
    <style>
    * {
        font-family: Verdana;
        font-size: 13px;        
    }
    h5 {
        font-size: 19px;
        font-weight: normal;
        padding-bottom: 20px;
        border-bottom: 1px solid #ccc;
    }
    #display {
        margin-top: 20px;
    }
    </style>
</head>
<body>
    <h5>Тестирование веб-сервера/хостинга<br>
        <small>на предмет использования плагина WPGrabber</small>
    </h5><br>
<p>Значение <b>memory_limit = <?php echo ini_get('memory_limit'); ?></b></p>
<p>Значение <b>max_execution_time = <?php echo ini_get('max_execution_time'); ?></b></p>
<p>Значение <b>max_input_time = <?php echo ini_get('max_input_time'); ?></b></p>
    <input id="sbmt" type="button" value="Начать тестирование..." onclick="__start();" />
    <img id="loading" src="http://wpgrabber.biz/wp-content/uploads/2016/01/spinner.gif" style="display: none;" />
    <div id="display"></div>
</body>
</html>