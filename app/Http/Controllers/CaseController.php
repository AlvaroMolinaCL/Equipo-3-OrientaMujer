<?php 

namespace App\Http\Controllers;

use App\Models\LegalCase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CaseUpdated;

class CaseController extends Controller
{
    public function index($tenantId) {
        $cases = LegalCase::where('tenant_id', $tenantId)->get();
        return view('cases.index', compact('cases', 'tenantId'));
    }

    public function create($tenantId) {
        $users = User::all();
        return view('cases.create', compact('users', 'tenantId'));
    }

    public function store(Request $request, $tenantId) {
        $case = LegalCase::create([
            'tenant_id' => $tenantId,
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if ($case->user) {
            Mail::to($case->user->email)->send(new CaseUpdated($case));
        }

        return redirect()->route('cases.index', $tenantId);
    }

    public function edit($tenantId, LegalCase $case) {
        $users = User::all();
        return view('cases.edit', compact('case', 'users', 'tenantId'));
    }

    public function update(Request $request, $tenantId, LegalCase $case) {
        $case->update($request->only('user_id', 'title', 'description', 'status'));

        if ($case->user) {
            Mail::to($case->user->email)->send(new CaseUpdated($case));
        }

        return redirect()->route('cases.index', $tenantId);
    }
}
