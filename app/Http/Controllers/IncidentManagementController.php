<?php

namespace App\Http\Controllers;

use App\IncidentManagement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncidentManagementController extends Controller
{

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insert(Request $request)
    {
        $errors = [];
        foreach ($request->get('data') as $data) {
            $validator = Validator::make($data, [
                'title' => ['required'],
                'category' => ['required', 'exists:incident_category,cat_id'],
                'incidentDate' => ['required', 'date'],
                'createDate' => ['sometimes', 'nullable', 'date'],
                'modifyDate' => ['sometimes', 'nullable', 'date'],
                'location.latitude' => ['required', 'numeric', 'between:-90,90'],
                'location.longitude' => ['required', 'numeric', 'between:-180,180']
            ]);
            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $errors[] = $error;
                }
            } else {
                $incident = new IncidentManagement();
                $incident->fill($data);
                $incident->latitude = $data['location']['latitude'];
                $incident->longitude = $data['location']['longitude'];
                $incident->incidentDate = Carbon::parse($data['incidentDate']);
                $incident->createDate = Carbon::parse($data['createDate']);
                $incident->modifyDate = Carbon::parse($data['modifyDate']);
                $incident->save();
            }

        }
        if (!empty($errors)) {
            return response()->json(['errors' => $errors])->setStatusCode(422);
        }
        return response()->json(array('status' => true, 'message' => 'Incidents stored successfully.'))->setStatusCode(201);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIncidents()
    {
        $response = [
            'no_of_incidents' => IncidentManagement::all()->count(),
            'data' => IncidentManagement::all()->toArray()
        ];
        return response()->json($response);
    }
}
