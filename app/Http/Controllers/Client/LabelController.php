<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Conversations\CreateLabelFormRequest;
use App\Http\Requests\Client\Conversations\UpdateLabelFormRequest;
use App\Models\Label;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
            auth('client')->user()->labels()->create($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Label was successfully created.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ACTION: LABEL_CREATE, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
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
            Log::error("ACTION: LABEL_UPDATE, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }

    public function destroy(Label $label)
    {
        DB::beginTransaction();
        try {
            if (!$label->isOwned()) {
                return redirect()->back()->withErrors(['message' => 'Error: Unauthorized Operation!']);
            }
            $label->delete();
            DB::commit();
            return redirect(route('client.labels.index'))->with('success', 'Label was deleted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("ACTION: LABEL_DELETE, ERROR:" . $e->getMessage());
            return redirect()->back()->withErrors(['message' => "Something went wrong; We are working on it."]);
        }
    }
}
