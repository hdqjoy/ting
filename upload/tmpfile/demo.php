<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/5/31
 */

function encode_file_contents($filename) {

    $type=strtolower(substr(strrchr($filename,'.'),1));
    if ('php' == $type && is_file($filename) && is_writable($filename)) { // 如果是PHP文件 并且可写 则进行压缩编码
        $contents = file_get_contents($filename); // 判断文件是否已经被编码处理
        $contents = php_strip_whitespace($filename);

        // 去除PHP头部和尾部标识
        $headerPos = strpos($contents,'<?php');
        $footerPos = strrpos($contents,'?>');
        $contents = substr($contents, $headerPos + 5, $footerPos - $headerPos);
        $encode = base64_encode(gzdeflate($contents)); // 开始编码
        $encode = '<?php'."\n eval(gzinflate(base64_decode("."'".$encode."'".")));\n\n?>";

        return file_put_contents($filename, $encode);
    }
    return false;
}