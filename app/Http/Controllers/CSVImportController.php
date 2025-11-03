<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CSVImportController extends Controller
{
    public function index()
    {
        return view('admin.import-csv.import');
    }
   
    public function import(Request $request)
    {
        if ($request->hasFile('csv_file')) { // Ensure file is uploaded
            $file = $request->file('csv_file');
            $filePath = $file->getRealPath(); // Use getRealPath() for a proper temp file path
        
            $data = [];
        
            // Open and read CSV file
            if (($handle = fopen($filePath, 'r')) !== false) {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    $data[] = $row; // Each row is stored separately in the array
                }
                fclose($handle);
            }
        
            // Print each row separately

            $masterArr = [];

            // echo '<pre>';
            // print_r($data);
            // die();
            // return false;
            foreach($data as $index => $value){
                
                if( $index  == 0 )  continue;

                // $id_validity = date("Y-m-d H:i:s");

                // if($value[8] != ''){
                //     $date = \DateTime::createFromFormat("Ymd", $value[8]);
                //     $id_validity = $date->format("Y-m-d"); // Convert to YYYY-MM-DD
                // }

                $masterArr[] = [
                    'account_no' => trim($value[0]),
                    'name' => trim($value[1]),
                    'classification' => trim($value[2]),
                    'address' => trim($value[3]),
                    'tel_1' => trim($value[4]),
                    'mobile' => trim($value[5]),
                    'full_name' => trim($value[6]),
                    'nationality' => trim($value[7]),
                    'status' => trim($value[8]) == true ? 1 : 0,
                    'company_name' => trim($value[9]),
                    'created_at' => now(), 
                    'updated_at' => now()
                ];

                // break;
            }


            $chunks = array_chunk($masterArr, 500); // Break into chunks of 500 rows

            foreach ($chunks as $chunk) {
                \DB::table('party_ledger')->insert($chunk);
            }
            
        } else {
            echo "No file uploaded!";
        }
        
    }

 



}
