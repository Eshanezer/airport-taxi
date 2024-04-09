<?php

namespace App\Imports;

use App\Models\Location;
use App\Models\Pricing;
use App\Models\VehicleType;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PricingImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (isntEmpty($row[0]) && isntEmpty($row[1]) && isntEmpty($row[3]) && isntEmpty($row[4]) && isntEmpty($row[5])) {
                $vehicletype = VehicleType::where('type', $row[3])->first();

                if ($vehicletype) {
                    $start = Location::where('location', $row[0])->first();
                    $end = Location::where('location', $row[1])->first();
                    $route = Location::where('location', $row[2])->first();


                    if ($start && $end && $route) {
                        $data = [
                            'journey_price'    => $row[4],
                            'driver_price'    => $row[5],
                            'status'    => 1,
                        ];

                        if (isntEmpty($row[7]) && $row[7] != 'NA')
                            $data['extra'] = $row[7];

                        if (isntEmpty($row[6]) && $row[6] != 'NA')
                            $data['km'] = $row[6];

                        if (isntEmpty($row[8]) && $row[8] != 'NA')
                            $data['waiting'] = $row[8];

                        $existingQuery = Pricing::where('start', $start->id)->where('end', $end->id)->where('route', $route->id);
                        $existingRecord = $existingQuery->first();
                        if ($existingRecord->vehicletype == $vehicletype->id) {
                            $existingQuery->update($data);
                        } else {
                            $existingRecord['vehicletype'] = $vehicletype->id;

                            $data = [
                                'start'     => $start->id,
                                'end'    => $end->id,
                                'vehicletype'    => $vehicletype->id,
                                'route'    => $route->id,
                                'journey_price'    => $row[4],
                                'driver_price'    => $row[5],
                                'status' => 1,
                            ];

                            Pricing::create($data);
                        }
                    } else {
                        if (!$start) {
                            $start = Location::create([
                                'location' => $row[0],
                                'status' => 1,
                            ]);
                        }
                        if (!$end) {
                            $end = Location::create([
                                'location' => $row[1],
                                'status' => 1,
                            ]);
                        }
                        if (!$route && isntEmpty($row[2])) {
                            $route = Location::create([
                                'location' => $row[2],
                                'status' => 1,
                            ]);
                        }
                        $data = [
                            'start'     => $start->id,
                            'end'    => $end->id,
                            'vehicletype'    => $vehicletype->id,
                            'journey_price'    => $row[4],
                            'driver_price'    => $row[5],
                            'status' => 1,
                        ];
                        if ($route)
                            $data['route'] = $route->id;
                        if (isntEmpty($row[6]) && $row[6] != 'NA')
                            $data['km'] = $row[6];
                        if (isntEmpty($row[7]) && $row[7] != 'NA')
                            $data['extra'] = $row[7];
                        if (isntEmpty($row[8]) && $row[8] != 'NA')
                            $data['waiting'] = $row[8];

                        Pricing::create($data);
                    }
                }
            }
        }
    }
}
