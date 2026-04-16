<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PSISController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/approved-pr-number/{prno}', [PSISController::class, 'approvedPr'])
    ->middleware('check.pr.api.token')
    ->name('approvedPr');

// TOKEN : pr-secret-token-23-03-2026-vswegfdfddfh

    // $headers = @{
    //     "X-API-TOKEN" = "pr-secret-token-23-03-2026-vswegfdfddfh"
    // }

    // $response = Invoke-RestMethod `
    //     -Uri "http://172.16.126.239/cpsuprv3/public/api/approved-pr-number/2025-1689-IGI" `
    //     -Method GET `
    //     -Headers $headers

    // $response | ConvertTo-Json -Depth 5
