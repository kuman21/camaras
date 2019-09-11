<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\alertMaintenance;
use App\Camera;
use App\Incident;
use App\Maintenance;

class CameraController extends Controller
{   
    /**
     * Crea una instancia del controlador.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la vista de cámaras internas
     * 
     * @return view
     */
    public function showInternal()
    {
        $cameras = Camera::select('id', 'description', 'status', 'image_path')
        ->where('type', 'I')
        ->where('status', 1)
        ->get();

        return view('internal-cameras', [
            'cameras' => $cameras
        ]);
    }

    /**
     * Muestra la vista de cámaras externas
     * 
     * @return view
     */
    public function showExternal()
    {
        $cameras = Camera::select('id', 'description', 'status', 'image_path')
        ->where('type', 'E')
        ->where('status', 1)
        ->get();

        return view('external-cameras', [
            'cameras' => $cameras
        ]);
    }

    /**
     * Muestra la vista del detalle de la cámara
     * 
     * @return view
     */
    public function cameraDetail($id, $notificationId = null)
    {   
        if ($notificationId !== null) {
            foreach (\Auth::user()->unreadNotifications as $notification) {
                if ($notification->id === $notificationId) {
                    $notification->markAsRead();
                }
            }
        }
        $camera = Camera::find($id);
        $incidents = Incident::where('camera_id', $id)->orderBy('id', 'desc')->paginate(5);
        $maintenances = Maintenance::where('camera_id', $id)->orderBy('id', 'desc')->paginate(5);

        return view('camera-detail', [
            'camera' => $camera,
            'incidents' => $incidents,
            'maintenances' => $maintenances
        ]);
    }

    /**
     * Guarda en la base de datos el registro de las cámaras.
     * 
     * @return redirect
     */
    public function store(Request $request)
    {   
        ($request->type === 'I') ? $imagePath = 'images/cam_int_azul.png' : $imagePath = 'images/cam_ext_azul.png';
        
        $camera = new Camera;
        $camera->description = $request->description;
        $camera->type = $request->type;
        $camera->image_path = $imagePath;
        $camera->save();

        if ($camera->type === 'I') {
            return redirect()->route('showInternal')->with('success', 'La cámara se ha agregado correctamente');
        }

        return redirect()->route('showExternal')->with('success', 'La cámara se ha agregado correctamente');
    }
}
