<?php

use Illuminate\Database\Seeder;

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
                $benefits = factory(App\Benefit::class, 3)->create(['meeting_id' => $meeting->id]);
                $concerns = factory(App\Concern::class, 3)->create(['meeting_id' => $meeting->id]);
                $decisions = factory(App\Decision::class, 3)->create(['meeting_id' => $meeting->id]);
                $notes = factory(App\Note::class, 3)->create(['meeting_id' => $meeting->id]);

              });
          });
      });

    //$agenda_items = factory(App\AgendaItem::class)->create();
    // $this->call(UsersTableSeeder::class);
  }
}
