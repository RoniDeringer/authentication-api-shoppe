<?php

namespace App\Http\Controllers;

use CURLFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ApiShopeeController extends Controller
{

    public function index()
    {
        //links usados:
        //https://open.shopee.com/developer-guide/20
        //https://open.shopee.com/developer-guide/211

        $this->authentication();
        $this->postProduct();
    }

    private function authentication()
    {
        /**
         *  1- Gerar o link de autorização, 
         *  2- adquirir autorizações de loja(s), 
         *  3- usar o código de autorização e 
         *  4- obter e atualizar o access_token.
         */

        $partnerId = 847892;
        $partnerKey = "57615053704d6470644f554a78656d50484143644964436a5568777544524579";

        /**
         * 1- Gerar o link de autorização
         */
        $this->authShop($partnerId, $partnerKey);


        /**
         *  2- adquirir autorizações de loja(s)
         *  3- usar o código de autorização e
         */

        /**
         * 4- obter e atualizar o access_token. 
         */

        $code = "494d7a4a4f5a66524556776f66425453";
        $accountId = 19479;
        dump('autenticação por conta:');
        dump($this->getTokenAccountLevel($code, $partnerId, $partnerKey, $accountId));

        //por loja
        // $shopId=200520705;
        // getTokenShopLevel($code, $partnerId, $partnerKey, $shopId);
    }

    private function postProduct()
    {

        /**
         *  1- Imagem e Vídeo
         *  2- Categoria e atributos
         *  3- Descrição
         *  4- Preço
         *  5- Estoque
         *  6- Taxa envio
         *  7- Variantes
         */

        $partnerId = 847892;
        $partnerKey = "57615053704d6470644f554a78656d50484143644964436a5568777544524579";
        $code = "494d7a4a4f5a66524556776f66425453";
        $accountId = 19479;

        dump('send image:  ' . $this->sendImagem($partnerId, $partnerKey));
        dump('send atributo:  ' . $this->sendAtributo($partnerId, $partnerKey));
    }


    private function authShop($partnerId, $partnerKey)
    {
        // $host = 'https://partner.shopeemobile.com';
        $host = 'https://partner.test-stable.shopeemobile.com';

        $path = "/api/v2/shop/auth_partner";
        $redirectUrl = "https://www.baidu.com/";

        $timest = time();
        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s&redirect=%s", $host, $path, $partnerId, $timest, $sign, $redirectUrl);
        return $url;
    }

    private function getTokenAccountLevel($code, $partnerId, $partnerKey, $mainAccountId)
    {
        // $host = 'https://partner.shopeemobile.com';
        $host = 'https://partner.test-stable.shopeemobile.com';;
        $path = "/api/v2/auth/token/get";

        $timest = time();
        $body = array("code" => $code,  "main_account_id" => $mainAccountId, "partner_id" => $partnerId);
        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);

        $sign = hash_hmac('sha256', $baseString, $partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $host, $path, $partnerId, $timest, $sign);

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($c);
        // echo "\nraw result " . $result . "\n";

        $ret = json_decode($result, true);
        // $accessToken = $ret["access_token"];
        $accessToken = 'teste';
        // $newRefreshToken = $ret["refresh_token"];
        $newRefreshToken = 'teste';
        // echo "\naccess_token: " . $accessToken . ", refresh_token: " . $newRefreshToken . "\n";
        return $ret;
    }

    private function sendImagem($partnerId, $partnerKey)
    {
        $host = 'https://partner.test-stable.shopeemobile.com';
        $path = "/api/v2/media_space/upload_image";
        $timest = time();
        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $host, $path, $partnerId, $timest, $sign);

        $curl = curl_init();

        $image_path = 'public/images/foto_produto.png';
        $image_abs_path = base_path($image_path);
        $image_file = new CURLFile($image_abs_path);
        $post_data = array('image' => $image_file);


        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: multipart/form-data'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    private function sendAtributo($partnerId, $partnerKey)
    {

        $host = 'https://partner.test-stable.shopeemobile.com';
        $path = "/api/v2/product/add_item";
        $timest = time();
        $access_token ='c09222e3fc40ffb25fc947f738b1abf1';
        $shop_id = 01;
        $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&access_token=%s&shop_id=%s&sign=%s", $host, $path, $partnerId, $timest, $access_token, $shop_id, $sign);

        // Dados do item
        $data = array(
            'description' => 'fewajidfosa jioajfiodsa fewajfioewa jicoxjsi fjdiao fjeiwao fdsjiao fejwiao jfdsioafjeiowa jfidsax',
            'item_name' => 'Hello WXwhGUCI574UsyBHu5J2indlBT6s08av',
            'category_id' => 14695,
            'brand' => array(
                'brand_id' => 123,
                'original_brand_name' => 'nike'
            ),
            'logistic_info' => array(
                array(
                    'sizeid' => 0,
                    'shipping_fee' => 23.12,
                    'enabled' => true,
                    'is_free' => false,
                    'logistic_id' => 80101
                ),
                array(
                    'shipping_fee' => 20000,
                    'enabled' => true,
                    'is_free' => false,
                    'logistic_id' => 80106
                ),
                array(
                    'is_free' => false,
                    'enabled' => false,
                    'logistic_id' => 86668
                ),
                array(
                    'enabled' => true,
                    'price' => 12000,
                    'is_free' => true,
                    'logistic_id' => 88001
                ),
                array(
                    'enabled' => false,
                    'price' => 2,
                    'is_free' => false,
                    'logistic_id' => 88014
                )
            ),
            'weight' => 1.1,
            'item_status' => 'UNLIST',
            'image' => array(
                'image_id_list' => array(
                    'a17bb867ecfe900e92e460c57b892590',
                    '30aa47695d1afb99e296956699f67be6',
                    '2ffd521a59da66f9489fa41b5824bb62'
                )
            ),
            'dimension' => array(
                'package_height' => 11,
                'package_length' => 11,
                'package_width' => 11
            ),
            'attribute_list' => array(
                array(
                    'attribute_id' => 4811,
                    'attribute_value_list' => array(
                        array(
                            'value_id' => 0,
                            'original_value_name' => '',
                            'value_unit' => ''
                        )
                    )
                )
            ),
            'original_price' => 123.3,
            'seller_stock' => array(
                array(
                    'stock' => 0
                )
            ),
            'tax_info' => array(
                'ncm' => '123',
                'same_state_cfop' => '123',
                'diff_state_cfop' => '123',
                'csosn' => '123',
                'origin' => '1',
                'cest' => '12345',
                'measure_unit' => '1'
            ),
            'complaint_policy' => array(
                'warranty_time' => 'ONE_YEAR',
                "exclude_entrepreneur_warranty" => "123",
                "diff_state_cfop" => true,
                "complaint_address_id" => 123456,
                "additional_information" => ""
            ),
            "description_type" => "extended",
            "description_info" => array(
                "extended_description" => array(
                    "field_list" => array(
                        array(
                            "field_type" => "text",
                            "text" => "text description 1"
                        ),
                        array(
                            "field_type" => "image",
                            "image_info" => array(
                                "image_id" => "1e076dff0699d8e778c06dd6c02df1fe"
                            )
                        ),
                        array(
                            "field_type" => "image",
                            "image_info" => array(
                                "image_id" => "c07ac95ba7bb624d731e37fe2f0349de"
                            )
                        ),
                        array(
                            "field_type" => "text",
                            "text" => "text description 1"
                        )
                    )
                )
            )
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: multipart/form-data'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
