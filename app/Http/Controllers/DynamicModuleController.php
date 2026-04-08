<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DynamicModuleController extends Controller
{
    public function index($moduleName)
    {
        $module = Module::where('name', $moduleName)->firstOrFail();
        $tableName = Str::snake(Str::plural($moduleName));
        $data = DB::table($tableName)->get();

        return view('admin.modules.index', compact('module', 'data'));
    }

    public function create($moduleName)
    {
        $module = Module::where('name', $moduleName)->firstOrFail();
        $relatedData = [];
        if ($module->relations) {
            foreach ($module->relations as $rel) {
                if (($rel['type'] ?? '') == 'belongsTo') {
                    $table = Str::snake(Str::plural($rel['model'] ?? ''));
                    if (\Schema::hasTable($table)) {
                        $relatedData[$rel['model']] = [
                            'data' => DB::table($table)->get(),
                            'display_column' => $rel['display_column'] ?? 'name'
                        ];
                    }
                }
            }
        }
        return view('admin.modules.create', compact('module', 'relatedData'));
    }

    public function store(Request $request, $moduleName)
    {
        $module = Module::where('name', $moduleName)->firstOrFail();
        $tableName = Str::snake(Str::plural($moduleName));
        
        $rules = [];
        foreach ($module->fields as $field) {
            $rules[$field['name']] = 'required'; // Simple validation
        }
        $request->validate($rules);

        $fieldNames = collect($module->fields)->pluck('name')->toArray();
        if ($module->relations) {
            foreach ($module->relations as $rel) {
                if (($rel['type'] ?? '') == 'belongsTo') {
                    $fieldNames[] = Str::snake($rel['model'] ?? '') . '_id';
                }
            }
        }

        $data = $request->only($fieldNames);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table($tableName)->insert($data);

        return redirect()->route('admin.modules.index', $moduleName)->with('success', "Registro en {$moduleName} creado.");
    }

    public function edit($moduleName, $id)
    {
        $module = Module::where('name', $moduleName)->firstOrFail();
        $tableName = Str::snake(Str::plural($moduleName));
        $entry = DB::table($tableName)->where('id', $id)->first();

        if (!$entry) abort(404);

        $relatedData = [];
        if ($module->relations) {
            foreach ($module->relations as $rel) {
                if (($rel['type'] ?? '') == 'belongsTo') {
                    $table = Str::snake(Str::plural($rel['model'] ?? ''));
                    if (\Schema::hasTable($table)) {
                        $relatedData[$rel['model']] = [
                            'data' => DB::table($table)->get(),
                            'display_column' => $rel['display_column'] ?? 'name'
                        ];
                    }
                }
            }
        }

        return view('admin.modules.edit', compact('module', 'entry', 'relatedData'));
    }

    public function update(Request $request, $moduleName, $id)
    {
        $module = Module::where('name', $moduleName)->firstOrFail();
        $tableName = Str::snake(Str::plural($moduleName));

        $rules = [];
        foreach ($module->fields as $field) {
            $rules[$field['name']] = 'required';
        }
        $request->validate($rules);

        $fieldNames = collect($module->fields)->pluck('name')->toArray();
        if ($module->relations) {
            foreach ($module->relations as $rel) {
                if (($rel['type'] ?? '') == 'belongsTo') {
                    $fieldNames[] = Str::snake($rel['model'] ?? '') . '_id';
                }
            }
        }

        $data = $request->only($fieldNames);
        $data['updated_at'] = now();

        DB::table($tableName)->where('id', $id)->update($data);

        return redirect()->route('admin.modules.index', $moduleName)->with('success', "Registro en {$moduleName} actualizado.");
    }

    public function destroy($moduleName, $id)
    {
        $module = Module::where('name', $moduleName)->firstOrFail();
        
        // 1. Verificar dependencias en otros módulos dinámicos
        $allModules = Module::all();
        foreach ($allModules as $m) {
            if ($m->relations) {
                foreach ($m->relations as $rel) {
                    // Si el otro módulo depende de ESTE modelo
                    if (($rel['type'] ?? '') == 'belongsTo' && ($rel['model'] ?? '') == $moduleName) {
                        $otherTable = Str::snake(Str::plural($m->name));
                        $fk = Str::snake($moduleName) . '_id';
                        
                        if (Schema::hasTable($otherTable) && Schema::hasColumn($otherTable, $fk)) {
                            $exists = DB::table($otherTable)->where($fk, $id)->exists();
                            if ($exists) {
                                return back()->with('error', "No se puede eliminar: Este registro está siendo utilizado en el módulo '{$m->name}'.");
                            }
                        }
                    }
                }
            }
        }

        // 2. Verificar dependencias en modelos estáticos conocidos (ej. Productos)
        // Por ahora lo dejamos para módulos entre sí, pero se podría extender.

        $tableName = Str::snake(Str::plural($moduleName));
        DB::table($tableName)->where('id', $id)->delete();

        return redirect()->route('admin.modules.index', $moduleName)->with('success', "Registro en {$moduleName} eliminado.");
    }
}
