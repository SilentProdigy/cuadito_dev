<?php

namespace App\Http\Controllers;

use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GoogleSheetController extends Controller
{

    
    public function submitForm(Request $request)
    {
        /*  
            $client = new Google_Client();
            $client->setApplicationName('CUADITO');
            $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
            $client->setAccessType('online');
            $client->setAuthConfig('/path/to/your/credentials.json');
            $service = new Google_Service_Sheets($client);

            // Set the spreadsheet ID and range
            $spreadsheetId = 'your_spreadsheet_id';
            $range = 'Sheet1!A1:C1';

            // Prepare the row data
            $rowData = [
                $request->input('name'),
                $request->input('email'),
                $request->input('message')
            ];
            $valueRange = new Google_Service_Sheets_ValueRange();
            $valueRange->setValues(['values' => $rowData]);

            // Append the new row to the sheet
            $response = $service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, [
                'valueInputOption' => 'USER_ENTERED',
                'insertDataOption' => 'INSERT_ROWS'
            ]);

            // Handle the response
            if ($response->getUpdates()->getUpdatedCells() > 0) {
                return redirect()->back()->with('success', 'Form submitted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to submit form.');
            } 
            
        */
        
        try
        {
            Sheets::spreadsheet(config('sheets.spreadsheet_id'))
            ->sheet(config('sheets.sheet_id'))
            ->append([
                [
                    now()->format('d-M-Y'),
                    $request->input('name'),
                    $request->input('company'),
                    "", // title
                    "", // industry
                    "", // address
                    $request->input('number'),
                    $request->input('email'),
                    "", // linkedin
                    "", // channel
                    "", // segment
                    "", // sales_rep
                    "", // status
                    now()->format('d-M-Y'),
                    "", // client response
                    "", // sale date
                    "", // sales amount
                    $request->input('message'), 
                    
                ]
            ]);
            
            return response()->json('Form submitted successfully.', Response::HTTP_CREATED);
        }
        catch(\Exception $e)
        {
            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

}
