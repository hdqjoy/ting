<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/5/31
 */
namespace app\demo\controller;

use think\facade\Env;

class Encphp extends DemoBase{

    public function run(){

        // 第一种：利用base64 + 压缩 加密

        $filename = Env::get('root_path')."upload/tmpfile/demo.php";

        $res = $this->encode_file_contents($filename);
        if(false == $res){
            echo '加密失败';
        }

        // 第二种：利用随机字符加密
        $this->rand_encode_file($filename);

    }

    /**
     * 第一种：利用base64 + 压缩 加密
     * @param $filename 
     * 需要加密的文件名
     * @return bool|int
     * 返回值：若成功，则直接加密；若失败，返回false 
     */
    public function encode_file_contents($filename) {

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

    // 第二种：利用随机字符加密
    public function rand_encode_file($filename){

        $T_k1 = $this->randAbc(); //随机密匙1
        $T_k2 = $this->randAbc(); //随机密匙2
        $vstr = file_get_contents($filename);
        $v1 = base64_encode($vstr);
        $c = strtr($v1, $T_k1, $T_k2); //根据密匙替换对应字符。
        $c = $T_k1.$T_k2.$c;
        $q1 = "O00O0O";
        $q2 = "O0O000";
        $q3 = "O0OO00";
        $q4 = "OO0O00";
        $q5 = "OO0000";
        $q6 = "O00OO0";
        $s = '$'.$q6.'=urldecode("%6E1%7A%62%2F%6D%615%5C%76%740%6928%2D%70%78%75%71%79%2A6%6C%72%6B%64%679%5F%65%68%63%73%77%6F4%2B%6637%6A");$'.$q1.'=$'.$q6.'{3}.$'.$q6.'{6}.$'.$q6.'{33}.$'.$q6.'{30};$'.$q3.'=$'.$q6.'{33}.$'.$q6.'{10}.$'.$q6.'{24}.$'.$q6.'{10}.$'.$q6.'{24};$'.$q4.'=$'.$q3.'{0}.$'.$q6.'{18}.$'.$q6.'{3}.$'.$q3.'{0}.$'.$q3.'{1}.$'.$q6.'{24};$'.$q5.'=$'.$q6.'{7}.$'.$q6.'{13};$'.$q1.'.=$'.$q6.'{22}.$'.$q6.'{36}.$'.$q6.'{29}.$'.$q6.'{26}.$'.$q6.'{30}.$'.$q6.'{32}.$'.$q6.'{35}.$'.$q6.'{26}.$'.$q6.'{30};eval($'.$q1.'("'.base64_encode('$'.$q2.'="'.$c.'";eval(\'?>\'.$'.$q1.'($'.$q3.'($'.$q4.'($'.$q2.',$'.$q5.'*2),$'.$q4.'($'.$q2.',$'.$q5.',$'.$q5.'),$'.$q4.'($'.$q2.',0,$'.$q5.'))));').'"));';

        $s = '<?php '."\n".$s."\n".' ?>';

        // 生成 加密后的PHP文件
        $fpp1 = fopen($filename, 'w');
        fwrite($fpp1, $s) or die('写文件错误');

    }

    // 第三种: 在线加密: www.phpjm.net
    // 第四种: 加密软件加密

    public function randAbc($length = "") { // 返回随机字符串
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        return str_shuffle($str);
    }
}