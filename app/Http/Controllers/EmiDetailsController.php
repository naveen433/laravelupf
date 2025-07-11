<?php
namespace App\Http\Controllers;

use App\Services\EmiService;
use Illuminate\Http\Request;

class EmiDetailsController extends Controller
{
    protected $emiService;

    public function __construct(EmiService $emiService)
    {
        $this->emiService = $emiService;
    }

    public function show()
    {
        $data = $this->emiService->getEmiTableData();
        return view('emi.show', $data);
    }

    public function process(Request $request)
    {
        $success = $this->emiService->processEmiData();
        
        if (!$success) {
            return redirect()->back()->with('error', 'No loan data found.');
        }

        return redirect()->route('emi.show')->with('success', 'EMI data processed!');
    }
}