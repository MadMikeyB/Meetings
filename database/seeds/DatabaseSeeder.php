<?php

use Illuminate\Database\Seeder;

use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $companies = factory(App\Company::class, 5)
      ->create()
      ->each(function ($company) {
        factory(App\User::Class, 3)
          ->create(['company_id' => $company->id])
          ->each(function($user) {
            factory(App\Meeting::Class, 3)
              ->create(['user_id' => $user->id])->each(function($meeting) {
                $days = factory(App\Day::class, 2)->create([
                  'meeting_id' => $meeting->id,
                ])->each(function($day) {
                  $items = factory(App\AgendaItem::class, 5)->create([
                    'day_id' => $day->id,
                    'leader_id' => App\User::all()->random()->id,
                    'position' => 0,
                  ]);
                });
                $benefits = factory(App\Benefit::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $concerns = factory(App\Concern::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $decisions = factory(App\Decision::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $notes = factory(App\Note::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $objectives = factory(App\Objective::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $expectations = factory(App\Expectation::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $nextsteps = factory(App\NextStep::class, 3)->create([
                  'user_id' => App\User::all()->random()->id,
                  'meeting_id' => $meeting->id,
                ]);
              });
          });
      });

    $me = factory(App\User::class)->create([
      'company_id' => App\Company::all()->random()->id,
      'name' => 'Jack Ellis',
      'email' => 'jackellis1504@gmail.com',
      'password' => bcrypt(12345678),
    ])->each(function($user) {
            factory(App\Meeting::Class, 3)
              ->create(['user_id' => $user->id])->each(function($meeting) {
                $days = factory(App\Day::class, 2)->create([
                  'meeting_id' => $meeting->id,
                ])->each(function($day) {
                  $items = factory(App\AgendaItem::class, 5)->create([
                    'day_id' => $day->id,
                    'leader_id' => App\User::all()->random()->id,
                    'position' => 0,
                  ]);
                });
                $benefits = factory(App\Benefit::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $concerns = factory(App\Concern::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $decisions = factory(App\Decision::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $notes = factory(App\Note::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $objectives = factory(App\Objective::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $expectations = factory(App\Expectation::class, 3)->create([
                  'meeting_id' => $meeting->id
                ]);
                $nextsteps = factory(App\NextStep::class, 3)->create([
                  'user_id' => App\User::all()->random()->id,
                  'meeting_id' => $meeting->id,
                ]);
              });
          });
;




    //$agenda_items = factory(App\AgendaItem::class)->create();
    // $this->call(UsersTableSeeder::class);
  }
}
