<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Http\Requests\Report\StoreRequest;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketType;
use App\Models\Unit;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public const tables = ['TicketType', 'TicketPriority', 'Ticket', 'Unit'];

    public static function routes()
    {
        Route::get('/report/wizard/show', [__CLASS__, 'getWizard'])->name('report.wizard.show');
        Route::post('/report/wizard/make', [__CLASS__, 'makeReport'])->name('report.wizard.make');
    }

    public function getWizard()
    {
        return view('reporter.wizard')->with([
            'tables' => self::tables,
        ]);
    }

    public function makeReport(StoreRequest $request)
    {
        $report = null;
        if ($request->input('all')) {
            if ($request->input('report_table') == 'TicketType') {
                $report = TicketType::withTrashed()->get();
            } elseif ($request->input('report_table') == 'TicketPriority') {
                $report = TicketPriority::withoutTrashed()->get();
            } elseif ($request->input('report_table') == 'Ticket') {
                $report = Ticket::withoutTrashed()->get();
            } elseif ($request->input('report_table') == 'Unit') {
                $report = Unit::withTrashed()->get();
            } else {
                return redirect()->back()->with('message', 'selected table doesnt exists');
            }
        } else {
            $flag = 0;
            if ($request->input('report_table') == 'TicketType') {
                if ($request->input('deletedRecords')) {
                    $report = TicketType::onlyTrashed()->get();
                    $flag = 1;
                }
                if ($request->input('activated')) {
                    if ($flag) {
                        $report->merge(TicketType::query()->where('is_active', true)->get());
                    } else {
                        $report = TicketType::query()->where('is_active', true)->get();
                    }
                }
                if ($request->input('diactivated')) {
                    if ($flag) {
                        $report->merge(TicketType::query()->where('is_active', false)->get());
                    } else {
                        $report = TicketType::query()->where('is_active', false)->get();
                    }
                }
                $flag = 0;
            } elseif ($request->input('report_table') == 'TicketPriority') {
                if ($request->input('deletedRecords')) {
                    $report = TicketPriority::onlyTrashed()->get();
                    $flag = 1;
                }
                if ($request->input('activated')) {
                    if ($flag) {
                        $report->merge(TicketPriority::query()->where('is_active', true)->get());
                    } else {
                        $report = TicketPriority::query()->where('is_active', true)->get();
                    }
                }
                if ($request->input('diactivated')) {
                    if ($flag) {
                        $report->merge(TicketPriority::query()->where('is_active', false)->get());
                    } else {
                        $report = TicketPriority::query()->where('is_active', false)->get();
                    }
                }
                $flag = 0;
            } elseif ($request->input('report_table') == 'Ticket') {
                if ($request->input('deletedRecords')) {
                    $report = Ticket::onlyTrashed()->get();
                    $flag = 1;
                }
                if ($request->input('activated')) {
                    if ($flag) {
                        $report->merge(Ticket::query()->where('is_active', true)->get());
                    } else {
                        $report = Ticket::query()->where('is_active', true)->get();
                    }
                }
                if ($request->input('diactivated')) {
                    if ($flag) {
                        $report->merge(Ticket::query()->where('is_active', false)->get());
                    } else {
                        $report = Ticket::query()->where('is_active', false)->get();
                    }
                }
                $flag = 0;
            } elseif ($request->input('report_table') == 'Unit') {
                if ($request->input('deletedRecords')) {
                    $report = Unit::onlyTrashed()->get();
                    $flag = 1;
                }
                if ($request->input('activated')) {
                    if ($flag) {
                        $report->merge(Unit::query()->where('is_active', true)->get());
                    } else {
                        $report = Unit::query()->where('is_active', true)->get();
                    }
                }
                if ($request->input('diactivated')) {
                    if ($flag) {
                        $report->merge(Unit::query()->where('is_active  ', false)->get());
                    } else {
                        $report = Unit::query()->where('is_active', false)->get();
                    }
                }
            } else {
                return redirect()->back()->with('message', 'selected table doesnt exists');
            }
        }
        return Excel::download(new ReportExport($report),  $request->input('report_name') . ' - ' . $request->input('report_description') . ' - report.xlsx');
    }

}
