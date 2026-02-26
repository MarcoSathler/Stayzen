<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        $services = [
            // --- USER 2: São Paulo (Urban/Business) ---
            ["name" => "Modern Downtown Loft", "description" => "Industrial style loft with city views.", "price" => 189.00, "type" => "apartment"], // ID 1
            ["name" => "Paulista Avenue Studio", "description" => "Compact studio near subway and museums.", "price" => 145.00, "type" => "apartment"], // ID 2
            ["name" => "Luxury Jardins Suite", "description" => "High-end hotel suite in upscale district.", "price" => 320.00, "type" => "hotel"], // ID 3
            ["name" => "Bohemian Vila Madalena House", "description" => "Artistic house with private garden.", "price" => 210.00, "type" => "hotel"], // ID 4
            ["name" => "Tech Hub Hostel Bed", "description" => "Pod-style bed in coworking hostel.", "price" => 55.00, "type" => "hostel"], // ID 5

            // --- USER 3: Rio de Janeiro (Beach/Luxury) ---
            ["name" => "Copacabana Ocean View", "description" => "Apartment with direct ocean view.", "price" => 450.00, "type" => "apartment"], // ID 6
            ["name" => "Ipanema Design Flat", "description" => "Modern flat blocks from the beach.", "price" => 380.00, "type" => "apartment"], // ID 7
            ["name" => "Santa Teresa Colonial Villa", "description" => "Historic villa with panoramic bay views.", "price" => 620.00, "type" => "hotel"], // ID 8
            ["name" => "Leblon Boutique Hotel", "description" => "Exclusive room with rooftop pool access.", "price" => 550.00, "type" => "hotel"], // ID 9
            ["name" => "Surf Hostel Arpoador", "description" => "Laid-back hostel for surfers.", "price" => 45.00, "type" => "hostel"], // ID 10

            // --- USER 4: Florianópolis (Nature/Island) ---
            ["name" => "Jurere International Mansion", "description" => "Opulent mansion with pool near clubs.", "price" => 1200.00, "type" => "hotel"], // ID 11
            ["name" => "Lagoa Bungalow", "description" => "Rustic bungalow on the lagoon.", "price" => 280.00, "type" => "hotel"], // ID 12
            ["name" => "Campeche Surf Cabin", "description" => "Wooden cabin near the waves.", "price" => 120.00, "type" => "hotel"], // ID 13
            ["name" => "Downtown Floripa Hotel", "description" => "Business hotel in city center.", "price" => 160.00, "type" => "hotel"], // ID 14
            ["name" => "Backpacker Island Hostel", "description" => "Social hostel with boat trips.", "price" => 40.00, "type" => "hostel"], // ID 15

            // --- USER 5: Salvador (Culture/History) ---
            ["name" => "Pelourinho Historic Home", "description" => "Colorful house in UNESCO site.", "price" => 190.00, "type" => "hotel"], // ID 16
            ["name" => "Barra Oceanfront Apt", "description" => "Modern apt facing the lighthouse.", "price" => 260.00, "type" => "apartment"], // ID 17
            ["name" => "Rio Vermelho Loft", "description" => "Trendy loft in nightlife district.", "price" => 175.00, "type" => "apartment"], // ID 18
            ["name" => "Stella Maris Resort", "description" => "All-inclusive resort room.", "price" => 480.00, "type" => "hotel"], // ID 19
            ["name" => "Bahia Vibes Hostel", "description" => "Hostel with capoeira workshops.", "price" => 35.00, "type" => "hostel"], // ID 20

            // --- USER 6: Gramado (Mountain/Cozy) ---
            ["name" => "Gramado Alpine Chalet", "description" => "European style chalet with fireplace.", "price" => 350.00, "type" => "hotel"], // ID 21
            ["name" => "Downtown Luxury Apt", "description" => "Heated floor apartment in center.", "price" => 420.00, "type" => "apartment"], // ID 22
            ["name" => "Canela Nature Retreat", "description" => "Glass cabin in the woods.", "price" => 290.00, "type" => "hotel"], // ID 23
            ["name" => "Bavarian Hotel & Spa", "description" => "Traditional hotel with chocolate spa.", "price" => 550.00, "type" => "hotel"], // ID 24
            ["name" => "Mountain Hiker Hostel", "description" => "Cozy hostel for nature lovers.", "price" => 60.00, "type" => "hostel"], // ID 25

            // --- USER 7: Brasília (Modernist/Architecture) ---
            ["name" => "Modernist Asa Norte Flat", "description" => "Renovated flat in classic building.", "price" => 160.00, "type" => "apartment"], // ID 26
            ["name" => "Lake Paranoa House", "description" => "House with private pier.", "price" => 800.00, "type" => "hotel"], // ID 27
            ["name" => "Diplomatic Sector Hotel", "description" => "High-end hotel for executives.", "price" => 400.00, "type" => "hotel"], // ID 28
            ["name" => "Garden Studio", "description" => "Ground floor studio with patio.", "price" => 140.00, "type" => "apartment"], // ID 29
            ["name" => "Capital City Hostel", "description" => "Central hostel for budget travelers.", "price" => 45.00, "type" => "hostel"], // ID 30

            // --- USER 8: Recife (Coastal/History) ---
            ["name" => "Boa Viagem Beach Flat", "description" => "Practical flat with rooftop pool.", "price" => 180.00, "type" => "apartment"], // ID 31
            ["name" => "Olinda Colonial Mansion", "description" => "Grand 18th-century mansion.", "price" => 450.00, "type" => "hotel"], // ID 32
            ["name" => "Recife Antigo Loft", "description" => "Industrial loft in tech hub.", "price" => 220.00, "type" => "apartment"], // ID 33
            ["name" => "Muro Alto Resort", "description" => "Bungalow in exclusive resort.", "price" => 650.00, "type" => "hotel"], // ID 34
            ["name" => "Carnival Party Hostel", "description" => "Lively hostel in historic center.", "price" => 30.00, "type" => "hostel"], // ID 35

            // --- USER 9: Manaus (Jungle/River) ---
            ["name" => "Amazon Jungle Lodge", "description" => "Eco-lodge accessible by boat.", "price" => 500.00, "type" => "hotel"], // ID 36
            ["name" => "Theater View Apt", "description" => "Classic apt facing Opera House.", "price" => 200.00, "type" => "apartment"], // ID 37
            ["name" => "Ponta Negra Condo", "description" => "Modern condo with river views.", "price" => 250.00, "type" => "apartment"], // ID 38
            ["name" => "Floating House", "description" => "Houseboat on Rio Negro.", "price" => 300.00, "type" => "hotel"], // ID 39
            ["name" => "Rainforest Hostel", "description" => "Gateway hostel for expeditions.", "price" => 40.00, "type" => "hostel"], // ID 40

            // --- USER 10: Fortaleza (Sun/Kitesurf) ---
            ["name" => "Meireles Oceanfront", "description" => "Luxury condo on main avenue.", "price" => 320.00, "type" => "apartment"], // ID 41
            ["name" => "Beach Park Suite", "description" => "Family suite near water park.", "price" => 580.00, "type" => "hotel"], // ID 42
            ["name" => "Cumbuco Kite House", "description" => "House with gear storage for kiters.", "price" => 280.00, "type" => "hotel"], // ID 43
            ["name" => "Iracema Art Loft", "description" => "Stylish loft near culture center.", "price" => 160.00, "type" => "apartment"], // ID 44
            ["name" => "Windy Dunes Hostel", "description" => "Hostel for wind sports fans.", "price" => 35.00, "type" => "hostel"], // ID 45

            // --- USER 11: BH (Food/City) ---
            ["name" => "Savassi Design Apt", "description" => "Trendy apt near best bars.", "price" => 190.00, "type" => "apartment"], // ID 46
            ["name" => "Pampulha Lake House", "description" => "Mid-century modern house.", "price" => 450.00, "type" => "hotel"], // ID 47
            ["name" => "Central Market Loft", "description" => "Loft for foodies near market.", "price" => 150.00, "type" => "apartment"], // ID 48
            ["name" => "Luxury Hotel Lourdes", "description" => "Traditional 5-star hotel.", "price" => 380.00, "type" => "hotel"], // ID 49
            ["name" => "Minas Culture Hostel", "description" => "Artistic hostel with garden.", "price" => 38.00, "type" => "hostel"], // ID 50
        ];

        foreach ($services as $data) {
            DB::table('services')->insert([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'type' => $data['type'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
