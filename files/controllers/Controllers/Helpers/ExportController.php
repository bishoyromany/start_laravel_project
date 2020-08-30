<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    /**
     * export data
     */
    public function __construct(Request $request, $data, $database)
    {
        $this->request = $request;
        $this->data = $data;
        $this->database = $database;
    }

    public function export()
    {
        $request = $this->request;
        $data = $this->data;
        $database = $this->database;

        $this->userId = auth()->user()->id;
        $filename = explode('.', $request->filename);
        $ext = $filename[count($filename) - 1];
        $this->filename = $filename[0] . '_' . $this->userId . '_' . date('Y-m-d H_i_s') . '.csv';
        $headers = $database->getTableColumns();
        $newHeaders = [];
        for ($x = 0; $x < count($headers); $x++) {
            if ($headers[$x] == 'updated_at' || $headers[$x] == 'created_at' || $headers[$x] == 'id') {
                continue;
            }
            $newHeaders[] = $headers[$x];
        }
        $this->headers = $newHeaders;

        return $this->exportFile($data);
    }

    /**
     * export the file
     */
    public function exportFile($data)
    {
        /**
         * export headers
         */
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $this->filename . "",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );


        $callback = function () use ($data) {
            // start writing the csv file
            $file = fopen('php://output', 'w');

            $data = json_decode(json_encode($data), true);
            // add headers
            fputcsv($file, $this->headers);

            // loop target data
            foreach ($data as $low) {
                unset($low['updated_at']);
                unset($low['created_at']);
                unset($low['id']);

                fputcsv(
                    $file,
                    $low
                );
            }
            fclose($file);
        };

        return \Response::stream($callback, 200, $headers);
    }
}
