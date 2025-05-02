<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\WeatherDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherDataRepository::class)]
class WeatherData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('weather:read')]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['weather:read'])]
    private ?float $temperature = null;

    #[ORM\Column(length: 100)]
    #[Groups(['weather:read'])]
    private ?string $city = null;

    #[ORM\Column]
    #[Groups(['weather:read'])]
    private ?float $windspeed = null;

    #[ORM\Column]
    #[Groups(['weather:read'])]
    private ?int $winddirection = null;

    #[ORM\Column]
    #[Groups(['weather:read'])]
    private ?int $weathercode = null;

    #[ORM\Column]
    #[Groups(['weather:read'])]
    private ?bool $isDay = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['weather:read'])]
    private ?\DateTime $time = null;

    #[ORM\Column]
    #[Groups(['weather:read'])]
    private ?float $latitude = null;

    #[ORM\Column]
    #[Groups(['weather:read'])]
    private ?float $longitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }
    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getWindspeed(): ?float
    {
        return $this->windspeed;
    }

    public function setWindspeed(float $windspeed): static
    {
        $this->windspeed = $windspeed;

        return $this;
    }

    public function getWinddirection(): ?int
    {
        return $this->winddirection;
    }

    public function setWinddirection(int $winddirection): static
    {
        $this->winddirection = $winddirection;

        return $this;
    }

    public function getWeathercode(): ?int
    {
        return $this->weathercode;
    }

    public function setWeathercode(int $weathercode): static
    {
        $this->weathercode = $weathercode;

        return $this;
    }

    public function isDay(): ?bool
    {
        return $this->isDay;
    }

    public function setIsDay(bool $isDay): static
    {
        $this->isDay = $isDay;

        return $this;
    }

    public function getTime(): ?\DateTime
    {
        return $this->time;
    }

    public function setTime(\DateTime $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }
}
