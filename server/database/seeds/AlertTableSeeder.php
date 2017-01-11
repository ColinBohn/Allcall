<?php

use Illuminate\Database\Seeder;

class AlertTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alerts')->insert([
            'name' => 'Test Message',
            'shortname' => 'test',
            'description' => 'This is a test of the emergency alert system. No action is required. This is only a test.',
            'loop_delay' => 5,
        ]);
        DB::table('alerts')->insert([
            'name' => 'Lockdown',
            'shortname' => 'lockdown',
            'description' => 'Lockdown. All staff begin emergency full lockdown procedures. All students return to the nearest secured area. The campus is closed to all new arrivals. We are now in full lockdown.',
            'loop_delay' => 30,
        ]);
        DB::table('alerts')->insert([
            'name' => 'Modified Lockdown',
            'shortname' => 'mod_lockdown',
            'description' => 'Modified lockdown. All students and staff begin modified lockdown procedures. The campus is closed to all new arrivals. We are now in modified lockdown.',
            'loop_delay' => 60,
        ]);
        DB::table('alerts')->insert([
            'name' => 'Evacuate',
            'shortname' => 'evacuate',
            'description' => 'Evacuate the building. Follow evacuation routes to assembly areas. The building is now being evacuated.',
            'loop_delay' => 0,
        ]);
        DB::table('alerts')->insert([
            'name' => 'Shelter In Place',
            'shortname' => 'shelter',
            'description' => 'Shelter in place. Seek indoor shelter now. Shutdown all heating, ventilation, and air conditioning systems. Close and cover all doors, windows, and air vents.',
            'loop_delay' => 30,
        ]);
        DB::table('alerts')->insert([
            'name' => 'Earthquake',
            'shortname' => 'earthquake',
            'description' => 'Earthquake. At this time drop cover and hold. Get under a desk or table with your back to the windows. Grab a desk or table leg. Burry your face in your arms, making your body as small as possible. Keep your eyes closed. Maintain this position until the earthquake stops.',
            'loop_delay' => 2,
        ]);
        DB::table('alerts')->insert([
            'name' => 'Armed Intruder',
            'shortname' => 'armed_intruder',
            'description' => 'Armed intruder reported on campus. Immediately take shelter where you are. Lock doors, turn off lights, and stay away from windows.',
            'loop_delay' => 60,
        ]);
        DB::table('alerts')->insert([
            'name' => 'All Clear',
            'shortname' => 'all_clear',
            'description' => 'All clear. Students and staff return to normal activities.',
            'loop_delay' => 1,
        ]);
    }
}
