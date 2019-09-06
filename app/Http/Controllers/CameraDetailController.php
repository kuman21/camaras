<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incident;
use App\Maintenance;

class CameraDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function saveIncident(Request $request)
    {
        $incident = new Incident;
        $incident->camera_id = $request->camera_id;
        $incident->date = $request->date;
        $incident->detail = strtolower($request->detail);
        $incident->save();

        return redirect()->route('cameraDetail', ['id' => $incident->camera_id])->with('success', 'La incidencia se ha agregado correctamente');
    }

    public function saveMaintenance(Request $request)
    {
        $maintenance = new Maintenance;
        $maintenance->camera_id = $request->camera_id;
        $maintenance->date = $request->date;
        $maintenance->detail = strtolower($request->detail);
        $maintenance->save();

        return redirect()->route('cameraDetail', ['id' => $maintenance->camera_id, 'type' => 'm'])->with('success', 'El mantenimiento se ha agregado correctamente');
    }

    public function applied(Request $request)
    {
        if ($request->ajax()) {
            $maintenance = Maintenance::find($request->maintenanceId);
            if ($request->applied === 'true') {
                $maintenance->applied = 1;
            } else {
                $maintenance->applied = 0;
            }
            
            $maintenance->save();

            return response()->json($maintenance);
        }
    }
}
