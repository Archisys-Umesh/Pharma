<?php
namespace App\Utils;

class DistanceFinder
{

// Function to calculate the Haversine distance between two points
private function haversineDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; // Radius of the Earth in kilometers

    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLon = deg2rad($lon2 - $lon1);

    $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($deltaLon / 2) * sin($deltaLon / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c;

    return $distance;
}

// Function to calculate the shortest distance between multiple locations
function calculateShortestDistance($locations) {
    $numLocations = count($locations);

    // Create a distance matrix
    $distanceMatrix = [];
    for ($i = 0; $i < $numLocations; $i++) {
        for ($j = 0; $j < $numLocations; $j++) {
            $lat1 = $locations[$i]['latitude'];
            $lon1 = $locations[$i]['longitude'];
            $lat2 = $locations[$j]['latitude'];
            $lon2 = $locations[$j]['longitude'];

            $distanceMatrix[$i][$j] = $this->haversineDistance($lat1, $lon1, $lat2, $lon2);
        }
    }

    // Nearest Neighbor Algorithm
    $visited = [];
    $currentLocation = 0; // Start from the first location
    $visited[] = $currentLocation;
    $totalDistance = 0;

    while (count($visited) < $numLocations) {
        $minDistance = INF;
        $nextLocation = -1;

        for ($i = 0; $i < $numLocations; $i++) {
            if (!in_array($i, $visited) && $distanceMatrix[$currentLocation][$i] < $minDistance) {
                $minDistance = $distanceMatrix[$currentLocation][$i];
                $nextLocation = $i;
            }
        }

        $visited[] = $nextLocation;
        $totalDistance += $minDistance;
        $currentLocation = $nextLocation;
    }

    // Add the distance to return to the starting location
    $totalDistance += $distanceMatrix[$currentLocation][0];

    return $totalDistance;
}

}

/*

// Example usage
$locations = [
    ['latitude' => 40.7128, 'longitude' => -74.0060], // New York City
    ['latitude' => 34.0522, 'longitude' => -118.2437], // Los Angeles
    ['latitude' => 41.8781, 'longitude' => -87.6298], // Chicago
    ['latitude' => 29.7604, 'longitude' => -95.3698], // Houston
];

$shortestDistance = calculateShortestDistance($locations);
echo "The shortest distance between the locations is: " . round($shortestDistance, 2) . " km";

*/