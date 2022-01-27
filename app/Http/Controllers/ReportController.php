<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Role;
use App\Models\OrderDetails;
use App\Models\Users;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;



class ReportController extends Controller
{
    public function export() 
    {
          
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    // public function exportCsv(Request $request)
    // {
    //     $fileName = 'users.csv';
    //     $tasks = User::join('roles','roles.role_name','=','users.role')->get(['users.*','roles.role_name as role']);

    //     $headers = array(
    //         "Content-type"        => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //         "Pragma"              => "no-cache",
    //         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires"             => "0"
    //     );

    //     $columns = array('Id', 'FirstName', 'LastName', 'email', 'role');

    //     $callback = function() use($tasks, $columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);

    //         foreach ($tasks as $task) {
    //             $row['Id']  = $task->id;
    //             $row['FirstName']    = $task->firstname;
    //             $row['LastName']    = $task->lastname;
    //             $row['email']  = $task->email;
    //             $row['role']  = $task->role;
                

    //             fputcsv($file, array($row['Id'], $row['FirstName'], $row['LastName'], $row['email'], $row['role']));
    //         }

    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    public function report(){
        return view('admin.Report.Report');
    }

    public function exportOrderCsv(Request $request)
    {
   $fileName = 'Orders.xlsx';

  $tasks=OrderDetails::join('user_details','order_details.userdetail_id','=','user_details.id')->
    join('orders','orders.id','=','order_details.order_id')
    ->get();
        $headers = array(
            "Content-type"        => "xlsx",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        );

        $columns = array('Id', 'First Name', 'Last Name' ,'email','address','finalTotal');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Id']  = $task->order_id;
                $row['First Name']    = $task->firstname;
                $row['Last Name']    = $task->lastname;
                $row['email']  = $task->email;
                $row['address']    = $task->address1;
                $row['finalTotal']=$task->finalTotal;
                
                fputcsv($file, array($row['Id'], $row['First Name'],$row['Last Name'],$row['email'],$row['address'],$row['finalTotal'] ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
}

}
