<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $accessToken = '00D7X0000004mSf!AQEAQGXoSmztGwBHz7ljwxW9UWXOuY0RRhrxlViuMOy1vFvES1Ud6xOsHMtHwqEsCI7lcFAWGTff1lJ7srDN0tEBn5BwshfX';
    $instanceUrl = 'https://cassi--homolog.sandbox.my.salesforce.com/';
    $attachmentId = '00P7X00000UlWubUAF'; // ID do Attachment

    // URL do conteúdo binário do anexo
    $url = $instanceUrl . "/services/data/v57.0/sobjects/Attachment/{$attachmentId}/Body";

    // Requisição GET autenticada
    $response = Http::withToken($accessToken)
        ->withHeaders([
            'Accept' => 'application/octet-stream'
        ])
        ->get($url);

    if ($response->successful()) {
        $fileContent = $response->body();
        $fileName = 'anexo_salesforce_' . $attachmentId . '.pdf'; // ou use .jpg/.docx conforme necessário

        // Salvar o arquivo no storage Laravel
        Storage::disk('local')->put("salesforce-files/{$fileName}", $fileContent);
        dd('salvou');
        return response()->json(['message' => 'Arquivo salvo com sucesso.', 'nome' => $fileName]);
    }
    dd('deu erro');
    return response()->json(['error' => 'Erro ao buscar anexo no Salesforce.'], 500);
  }
  // public function index()
  // {
  //   dd('teste');
  //   return view('content.dashboard.dashboards-analytics');
  // }
}
