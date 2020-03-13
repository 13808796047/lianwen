<?php
function count_words($needle)
{
// 	$needle = preg_replace("/\s/", "", $needle);///////移除空格
    return mb_strlen($needle, 'UTF-8');
}

function remove_spec_char($content)
{
// 	$txt=preg_replace("/&#\d{2,4};/", ",", $content);
    $txt = preg_replace("/[&]/", " ", $content);// 方框依次是：word标题折叠        表格处出现的       图片处出现的     强制换行
// 	$txt=preg_replace("/&/", ",", $content);
    return $txt;
}

/**
 * 纯php读取docx文档
 * @param unknown $filename
 */
function read_docx($filename)
{

    $striped_content = '';
    $content = '';

    if(!$filename || !file_exists($filename)) return false;

    $zip = zip_open($filename);
    if(!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if(zip_entry_open($zip, $zip_entry) == false) continue;

        if(zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }
    zip_close($zip);
    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);

    return remove_spec_char($striped_content);
}

/**
 * 依赖于windows word com 组件
 * 可以读取doc docx wps文件
 *
 * @param unknown $file
 */
function read_doc_from_com($file)
{
    $word = new COM("word.application") or die ("Could not initialise MS Word object.");
    $word->Documents->Open(realpath($file));
// 	$num= (int) $word->ActiveDocument->BuiltinDocumentProperties(15); //获取统计字数
    $content = (string)$word->ActiveDocument->Content->Text;
    $word->ActiveDocument->Close(false);
    $word->Quit();
    $word = null;
    unset($word);
// 	$encode = mb_detect_encoding($content);
// // 	echo $encode."------------------------------";exit;
// 	if ($encode == ""){
// 		$content = iconv("GBK","UTF-8",$content);
// 	}
// echo "Words:". $num."_____";
    return remove_spec_char($content);
}

function convert2utf8($content)
{
    if(mb_detect_encoding($content, "UTF-8, ISO-8859-1, GBK") != "UTF-8") {
        $content = iconv("GBK", "UTF-8//IGNORE", $content);
    }
    return $content;
}

/**
 * 统计中英文单词字数
 * @param unknown $str
 *
 */
function count_t_words($str)
{
// 	$encode = mb_detect_encoding($str,array('ASCII','GB2312','GBK','UTF-8'));
// 	if ($encode == "UTF-8"){
// 		$str = iconv("UTF-8","GBK",$str);
// 	}
    $content = preg_split("/\s+/", $str);
    $len = 0;
    for($i = count($content) - 1; $i >= 0; $i--) {
        $pp = preg_replace("/[^\x{2400}-\x{27ff}|\x{2e80}-\x{2eff}|\x{3000}-\x{32ff}|\x{4e00}-\x{9fff}|\x{ac00}-\x{d7af}|\x{ff00}-\x{ff40}]+/u", ' ', $content[$i]);
        $part = explode(' ', $pp);
        for($j = count($part) - 1; $j >= 0; $j--) {
            $len += mb_strlen($part[$j]);
        };
        //前后有字母
        $bais = 0;
        if($part[0] == "") {
            $len++;
            $bais++;
        }
        if($part[count($part) - 1] == "") {
            $len++;
            $bais++;
        }
        $len += (count($part) - 1 - $bais);
    };
    return $len;
}

/**
 * 通过 antiword 读取doc
 * @param unknown $file
 * @param string $antipath
 * @return string
 */
function read_doc_from_antiword($file, $antipath = "/usr/bin/antiword", $enc = "UTF-8.txt")
{
    $content = shell_exec("$antipath -m  $enc $file");
    return remove_spec_char($content);
}

