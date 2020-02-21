#!/bin/sh

MODELS=("Company" "Meeting" "AgendaItem" "Attendee" "Benefit" "Concern" "Day" "Decision" "Expectation" "NextStep" "Note" "Objective" "Token");


for M in ${MODELS[@]}; do
  M_CONTROLLER=$M"Controller";

  M_LOWERCASE="$(echo $M | awk '{print tolower($0)}')";

  echo $M_LOWERCASE;
  php artisan make:model $M -a;
  php artisan make:controller Api/$M_CONTROLLER --model=$M --api;
  echo "    Route::resource('"$M_LOWERCASE"', '"$M_CONTROLLER"');" >> routes/web.php
  echo "    Route::apiResource('"$M_LOWERCASE"', '"$M_CONTROLLER"');" >> routes/api.php
done

