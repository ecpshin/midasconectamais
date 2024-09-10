<?php 

namespace App\Services;

class BuscasApiService {

    public static function buscaCep(string $cep): array|null
    {
        $curl = curl_init();

        $cep = str_ireplace('-', '', $cep);

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://brasilapi.com.br/api/cep/v1/{$cep}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 3,
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, true);
    }

    public static function buscaBanco(string $codigo): array|null
    {
        $curl = curl_init();

        $codigo = intval($codigo, 10);

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://brasilapi.com.br/api/banks/v1/{$codigo}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 3,
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, true);
    }
}
