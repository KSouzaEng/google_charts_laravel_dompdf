<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WildlifePopulation;
use Illuminate\Support\Facades\DB;
use PDF;
use Dompdf\Options;
use Dompdf\Dompdf;

class ChartController extends Controller
{
    public function showChart()
    {
        $population = WildlifePopulation::select(
                        DB::raw("year(created_at) as year"),
                        DB::raw("SUM(bears) as bears"),
                        DB::raw("SUM(dolphins) as dolphins"))
                    ->orderBy(DB::raw("YEAR(created_at)"))
                    ->groupBy(DB::raw("YEAR(created_at)"))
                    ->get();

        $res[] = ['Year', 'bears', 'dolphins'];
        foreach ($population as $key => $val) {
            $res[++$key] = [$val->year, (int)$val->bears, (int)$val->dolphins];
        }

        return view('line-chart')
            ->with('population', json_encode($res));
    }


    public function rel(Request $request){

        $data = $request->chartData;
        // dd($request->all());
        // $temp_file = tempnam(sys_get_temp_dir(),'teste.pdf');
        // dd(  $temp_file);
        $pdf = PDF::loadView('relatorios/teste',compact('data'));
        $pdf->setPaper('A4', 'landscape');
        $options = new Options();
        $options->set('defaultFont', 'Verdana');
        $options->set('javascript-delay', 3000);
        $dompdf = new Dompdf($options);
         return $pdf->download('teste.pdf');
        // return $pdf->output();
        // $dompdf->render();

    }
}
