<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;

class VehicleController extends Controller
{
    /**
     * @param $modelYear
     * @param $manufacturer
     * @param $model
     * @return array
     */
    public function getListVehicles($modelYear, $manufacturer, $model)
    {
        $withRating = request('withRating') === 'true';
        return $this->listVehicles($modelYear, $manufacturer, $model, $withRating);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postListVehicles(Request $request)
    {
        $this->validate($request, [
            'modelYear' => 'required',
            'manufacturer' => 'required',
            'model' => 'required'
        ]);

        return $this->listVehicles($request->modelYear, $request->manufacturer, $request->model);
    }

    /**
     * Metodo para unificar la consulta y la respuesta del Api
     * @param $modelYear
     * @param $manufacturer
     * @param $model
     * @param bool $withRating
     * @return array
     */
    protected function listVehicles($modelYear, $manufacturer, $model, $withRating = false)
    {
        $url = "https://one.nhtsa.gov/webapi/api/SafetyRatings/modelyear/{$modelYear}/make/{$manufacturer}/model/{$model}?format=json";
        $resultsResponse = $this->connectionToApi($url);
        $count = $resultsResponse->Count ?? 0;
        $results = $resultsResponse->Results ?? [];

        $response = [
            'Count' => $count,
            'Results' => []
        ];
        foreach ($results as $result) {
            $response['Results'][] = $this->withRatingResults($result, $withRating);
        }

        return $response;
    }

    /**
     * Con este metodo se puede comprobar si los rating estan siendo solicitados
     *
     * @param $result
     * @param bool $withRating
     * @return array
     */
    private function withRatingResults($result, bool $withRating): array
    {
        $vehicleId = $result->VehicleId;
        if ($withRating) {
            $url = "https://one.nhtsa.gov/webapi/api/SafetyRatings/VehicleId/{$vehicleId}?format=json";
            $response = $this->connectionToApi($url);
            $resArr['CrashRating'] = $response->Results[0]->OverallRating ?? 'Not Rated';
        }
        $resArr['Description'] = $result->VehicleDescription;
        $resArr['VehicleId'] = $vehicleId;

        return $resArr;
    }

    /**
     * Metodo para la coneccion al api desde php
     * @param $url
     * @return mixed
     */
    private function connectionToApi($url)
    {
        $jsonResponse = json_decode('');
        $client = new Client();
        try {
            $responseClient = $client->request('GET', $url);
            $jsonResponse = json_decode($responseClient->getBody()->getContents());
        } catch (GuzzleException $e) {
            //todo: respuesta para cuando exista un error en la consulta del Api
        }

        return $jsonResponse;
    }
}
