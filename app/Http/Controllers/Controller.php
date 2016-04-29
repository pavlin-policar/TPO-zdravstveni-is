<?php

namespace App\Http\Controllers;

use App\Exceptions\UnsupportedFileFormatException;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     * Handle the export request for given data and extension.
     *
     * @param $data
     *      The data to be passed to the view. The data will be available through the 'data'
     *      variable.
     * @param $extension
     *      A supported extension. Must be in the format ".<ext>". If no valid extension is given
     *      an error message will be shown.
     * @param $viewName
     *      The full path of the view to be rendered for the file format.
     * @return mixed
     *
     * @throws Exception
     *      If debug mode is enabled, throw a detailed exception describing error.
     * @throws \App\Exceptions\UnsupportedFileFormatException
     *      If in production, display a pretty error message.
     */
    protected function generateExportFile($data, $extension, $viewName)
    {
        $extension = substr($extension, 1);
        switch ($extension) {
            case 'json':
                return $data;
            case 'pdf':
                try {
                    $pdf = PDF::loadView($viewName, ['data' => $data]);
                    return $pdf->stream(md5(time()) . '.pdf');
                } catch (Exception $e) {
                    if (env('APP_DEBUG', false)) {
                        throw $e;
                    } else {
                        throw new UnsupportedFileFormatException();
                    }
                }
            default:
                throw new UnsupportedFileFormatException();
        }
    }
}
