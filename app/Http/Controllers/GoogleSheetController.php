<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleSheetController extends Controller
{
    use Google_Client;
    use Google_Service_Sheets;
    use Google_Service_Sheets_ValueRange;

    public function submitForm(Request $request)
    {
        // Authenticate with Google API
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
    }

}
