<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $classroomIds = DB::table('classrooms')->pluck('id')->toArray();
        $subjects = DB::table('subjects')->get();
        $days = collect(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday'])
                ->sortBy(function ($day) {
                    $dayNumber = Carbon::parse($day)->dayOfWeek;
                    $todayNumber = Carbon::now()->dayOfWeek;
                    // adjust to move past days to the end
                    return ($dayNumber < $todayNumber) ? $dayNumber + 7 : $dayNumber;
                })->values()->toArray();


        foreach ($classroomIds as $classroomId) {
            // For each class, pick random days and number of sessions per day
            foreach ($days as $day) {
                // Randomly decide if this classroom has classes on this day (50-80% chance)
                if (rand(0, 100) > 60) continue;

                $sessionsPerDay = rand(2, 8); // number of sessions that day

                $availableTimes = collect(range(8, 18)); // from 8AM to 4PM

                for ($i = 0; $i < $sessionsPerDay; $i++) {
                    if ($availableTimes->isEmpty()) break;

                    // Randomly select a subject
                    $subject = $subjects->random();
                    
                    // Find an available teacher for this subject
                    $teacherId = DB::table('subject_teacher')
                        ->where('subject_id', $subject->id)
                        ->inRandomOrder()
                        ->value('teacher_id');

                    if (!$teacherId) continue;

                    // Pick a random starting hour and remove it to avoid overlap
                    $startHour = $availableTimes->random();
                    $availableTimes = $availableTimes->reject(fn($hour) => $hour == $startHour);

                    $startTime = Carbon::createFromTime($startHour, 0, 0);
                    $endTime = (clone $startTime)->addMinutes(90); // 1h30 session
                    $room = 'Room ' . rand(1, 10);

                    // Conflict check — simplified since we already control classroom hours
                    $hasConflict = Schedule::where('day_of_week', $day)
                    ->where(function ($query) use ($startTime, $endTime, $teacherId, $classroomId, $room) {
                        $query->where('room', $room)
                            ->orWhere('teacher_id', $teacherId)
                            ->orWhere('classroom_id', $classroomId)
                            ->where(function ($timeQ) use ($startTime, $endTime) {
                                $timeQ->whereBetween('start_time', [$startTime->format('H:i:s'), $endTime->format('H:i:s')])
                                    ->orWhereBetween('end_time', [$startTime->format('H:i:s'), $endTime->format('H:i:s')])
                                    ->orWhere(function ($innerQ) use ($startTime, $endTime) {
                                        $innerQ->where('start_time', '<=', $startTime->format('H:i:s'))
                                            ->where('end_time', '>=', $endTime->format('H:i:s'));
                                    });
                            });
                    })->exists();

                    if (!$hasConflict) {
                    // Check if the teacher already has 3 sessions on this day
                    $teacherSessionsCount = Schedule::where('teacher_id', $teacherId)
                        ->where('day_of_week', $day)
                        ->count();

                    if ($teacherSessionsCount >= 3) continue;

                    Schedule::create([
                        'title' => $subject->name,
                        'classroom_id' => $classroomId,
                        'teacher_id' => $teacherId,
                        'day_of_week' => $day,
                        'start_time' => $startTime->format('H:i:s'),
                        'end_time' => $endTime->format('H:i:s'),
                        'room' => $room,
                    ]);
                    }

                }
            }
        }
    }
}
