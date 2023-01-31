<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Conversations\CreateLabelFormRequest;
use App\Http\Requests\Client\Conversations\UpdateLabelFormRequest;
use App\Models\Label;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\LaravelXssProtection\Middleware\XssCleanInput;

class LabelController extends Controller
{

    public function __construct()
    {
        $this->middleware(XssCleanInput::class)->only(['store', 'update']);
    }

    public function index()
    {
        $labels = auth('client')->user()->labels;

        return view('client.labels.index')->with(compact('labels'));
    }

    public function store(CreateLabelFormRequest $request)
    {
        DB::beginTransaction();

        try {
            // Label::create($request->all());
            auth('client')->user()->labels()->create($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Label was successfully created.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function update(Label $label, UpdateLabelFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $label->update($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Label was successfully updated.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function destroy(Label $label, Request $request)
    {
        try {
            $label->delete();

            return redirect(route('client.labels.index'))->with('success', 'Label was deleted successfully!');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
