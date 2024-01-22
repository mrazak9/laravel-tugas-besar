<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use App\Models\StudentSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Mengambil jadwal untuk mahasiswa tertentu
        $schedules = StudentSchedule::where('student_id', $user->id)->with('schedule.subject.lecturer')->get();

        // Mengonversi hasil ke dalam format yang diinginkan
        $formattedSchedules = $schedules->map(function ($studentSchedule) {
            return [
                'course' => $studentSchedule->schedule->subject->title,
                'lecturer' => $studentSchedule->schedule->subject->lecturer->name,
                'description' => $studentSchedule->schedule->ruangan,
                'startTime' => $studentSchedule->schedule->jam_mulai,
                'endTime' => $studentSchedule->schedule->jam_selesai,
            ];
        });

        return response()->json($formattedSchedules);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
