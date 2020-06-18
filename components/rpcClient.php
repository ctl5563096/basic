<?php declare(strict_types=1);


namespace app\components;

use Exception;

/**
 * 原生调用rpc
 *
 * Class rpcClient
 * @package app\components
 */
class rpcClient
{
    public static function rpcClient(string $host,string $class,string $method,array $param, $version = '1.0', $ext = []): array
    {
        $fp = stream_socket_client($host, $errno, $errstr);
        if (!$fp) {
            throw new Exception("stream_socket_client fail errno={$errno} errstr={$errstr}");
        }

        $req = [
            "jsonrpc" => '2.0',
            "method" => sprintf("%s::%s::%s", $version, $class, $method),
            'params' => $param,
            'id' => '',
            'ext' => $ext,
        ];
        $data = json_encode($req) . "\r\n\r\n";
        fwrite($fp, $data);

        $result = '';
        while (!feof($fp)) {
            $tmp = stream_socket_recvfrom($fp, 1024);

            if ($pos = strpos($tmp, "\r\n\r\n")) {
                $result .= substr($tmp, 0, $pos);
                break;
            } else {
                $result .= $tmp;
            }
        }

        fclose($fp);
        return json_decode($result, true);
    }
}