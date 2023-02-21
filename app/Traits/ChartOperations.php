<?php 

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait ChartOperations
{
    public function groupTableDataByMonthAndYear($table_name, $date_column_name = "created_at", $year = 2023)
    {
        return DB::select("
                    SELECT 
                        YEAR({$date_column_name}) AS year, 
                        MONTH({$date_column_name}) AS month, 
                        MONTHNAME({$date_column_name}) AS month_str,
                        COUNT(*) AS data 
                    FROM 
                        {$table_name} 
                    WHERE 
                        YEAR({$date_column_name}) = {$year}
                    GROUP BY 
                        YEAR({$date_column_name}), 
                        MONTH({$date_column_name}),
                        MONTHNAME({$date_column_name}) 
                    ORDER BY 
                        YEAR({$date_column_name}) ASC, 
                        MONTH({$date_column_name}) ASC
                ");
    }
}