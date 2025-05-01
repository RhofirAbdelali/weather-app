<?php

namespace App\Controller;

use App\Entity\WeatherData;
use App\Repository\WeatherDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{
    #[Route('/api/weather/fetch', name: 'fetch_weather', methods: ['GET'])]
    public function fetchWeather(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $lat = $request->query->get('lat');
        $lon = $request->query->get('lon');
        $city = $request->query->get('city');

        if (!$lat || !$lon || !$city) {
            return $this->json(['error' => 'lat, lon et city requis'], 400);
        }

        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'https://api.open-meteo.com/v1/forecast', [
            'query' => [
                'latitude' => $lat,
                'longitude' => $lon,
                'current_weather' => true,
                'timezone' => 'auto'
            ]
        ]);

        $data = $response->toArray();
        $current = $data['current_weather'];

        $weather = new WeatherData();
        $weather->setTemperature($current['temperature']);
        $weather->setWindspeed($current['windspeed']);
        $weather->setWinddirection($current['winddirection']);
        $weather->setWeathercode($current['weathercode']);
        $weather->setIsDay((bool) $current['is_day']);
        $weather->setTime(new \DateTime($current['time']));
        $weather->setLatitude($lat);
        $weather->setLongitude($lon);
        $weather->setCity($city);

        $em->persist($weather);
        $em->flush();

        return $this->json(['message' => 'Donnée météo enregistrée avec succès']);
    }


    #[Route('/api/weather', name: 'get_weather_all', methods: ['GET'])]
    public function getWeather(WeatherDataRepository $repo): JsonResponse
    {
        $data = $repo->findBy([], ['time' => 'DESC']);
        return $this->json($data, 200, [], ['groups' => 'weather:read']);
    }

    #[Route('/api/weather/{id}', name: 'get_weather_one', methods: ['GET'])]
    public function getOne(WeatherData $weather): JsonResponse
    {
        return $this->json($weather, 200, [], ['groups' => 'weather:read']);
    }

    #[Route('/api/weather/{id}', name: 'update_weather', methods: ['PUT'])]
    public function update(Request $request, WeatherData $weather, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $weather->setTemperature($data['temperature'] ?? $weather->getTemperature());
        $weather->setWindspeed($data['windspeed'] ?? $weather->getWindspeed());

        $em->flush();

        return $this->json(['message' => 'Météo mise à jour']);
    }

    #[Route('/api/weather/{id}', name: 'delete_weather', methods: ['DELETE'])]
    public function delete(WeatherData $weather, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($weather);
        $em->flush();

        return $this->json(['message' => 'Donnée météo supprimée']);
    }
}
