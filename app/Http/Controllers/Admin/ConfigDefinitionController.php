<?php

namespace App\Http\Controllers\Admin;

use App\ConfigDefinition;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class ConfigDefinitionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Config Definitions')->only(['createForm', 'create']);
        $this->middleware('can:Read Config Definitions')->only(['index', 'read']);
        $this->middleware('can:Update Config Definitions')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Config Definitions'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $config_definitions = ConfigDefinition::query();
            $datatable = datatables($config_definitions)
                ->editColumn('actions', function ($config_definition) {
                    return view('admin.config_definitions.datatable.actions', compact('config_definition'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Config', 'data' => 'config'],
            ['title' => 'Definition', 'data' => 'definition'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'config_definitions_datatable');

        return view('admin.config_definitions.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.config_definitions.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "config" => "required",
        ]);

        $config_definition = ConfigDefinition::create(request()->all());

        activity('Created Config Definition: ' . $config_definition->definition, request()->all(), $config_definition);
        flash(['success', 'Config Definition created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.config_definitions'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(ConfigDefinition $config_definition)
    {
        return view('admin.config_definitions.read', compact('config_definition'));
    }

    public function updateForm(ConfigDefinition $config_definition)
    {
        return view('admin.config_definitions.update', compact('config_definition'));
    }

    public function update(ConfigDefinition $config_definition)
    {
        $this->validate(request(), [
            "config" => "required",
        ]);

        $config_definition->update(request()->all());

        activity('Updated Config Definition: ' . $config_definition->definition, request()->all(), $config_definition);
        flash(['success', 'Config Definition updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.config_definitions'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(ConfigDefinition $config_definition)
    {
        $config_definition->delete();

        activity('Deleted Config Definition: ' . $config_definition->definition, $config_definition->toArray());
        $flash = ['success', 'Config Definition deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.config_definitions');
        }
    }
}