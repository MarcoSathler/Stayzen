<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceImageSeeder extends Seeder
{
    public function run(): void
    {

        // Bancos de imagens categorizados (Unsplash IDs)
        $imgPool = [
            'apartment_city' => [
                'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', // Interior moderno
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', // Sala
                'https://images.unsplash.com/photo-1484154218962-a1c002085d2f?w=800', // Cozinha
            ],
            'apartment_beach' => [
                'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', // Vista mar
                'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', // Interior praiano
                'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?w=800', // Varanda
            ],
            'house_historic' => [
                'https://images.unsplash.com/photo-1572120360610-d971b9d7767c?w=800', // Colonial
                'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800', // Exterior
                'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', // Jardim
            ],
            'house_modern' => [
                'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800', // Fachada moderna
                'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', // Piscina
                'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800', // Sala vidro
            ],
            'cabin_nature' => [
                'https://images.unsplash.com/photo-1449156493391-d2cfa28e468b?w=800', // Cabana floresta
                'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', // Madeira
                'https://images.unsplash.com/photo-1587595431973-160d0d94add1?w=800', // Interior rústico
            ],
            'hotel_lux' => [
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800', // Hotel fachada
                'https://images.unsplash.com/photo-1616594039964-40891a90b669?w=800', // Quarto hotel
                'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800', // Lobby
            ],
            'hostel' => [
                'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800', // Beliches
                'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=800', // Área comum
                'https://images.unsplash.com/photo-1520277739336-7bf67edfa768?w=800', // Social
            ]
        ];

        // Lógica de Atribuição baseada no ID do serviço
        for ($id = 1; $id <= 50; $id++) {
            $imagesToUse = [];

            // User 2 (SP - Urbano)
            if ($id == 1 || $id == 2) $imagesToUse = $imgPool['apartment_city'];
            elseif ($id == 3) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 4) $imagesToUse = $imgPool['house_modern'];
            elseif ($id == 5) $imagesToUse = $imgPool['hostel'];

            // User 3 (Rio - Praia)
            elseif ($id == 6 || $id == 7) $imagesToUse = $imgPool['apartment_beach'];
            elseif ($id == 8) $imagesToUse = $imgPool['house_historic'];
            elseif ($id == 9) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 10) $imagesToUse = $imgPool['hostel'];

            // User 4 (Floripa - Natureza/Praia)
            elseif ($id == 11) $imagesToUse = $imgPool['house_modern'];
            elseif ($id == 12 || $id == 13) $imagesToUse = $imgPool['cabin_nature'];
            elseif ($id == 14) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 15) $imagesToUse = $imgPool['hostel'];

            // User 5 (Salvador - Histórico/Praia)
            elseif ($id == 16) $imagesToUse = $imgPool['house_historic'];
            elseif ($id == 17 || $id == 18) $imagesToUse = $imgPool['apartment_beach'];
            elseif ($id == 19) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 20) $imagesToUse = $imgPool['hostel'];

            // User 6 (Gramado - Frio/Serra)
            elseif ($id == 21 || $id == 23) $imagesToUse = $imgPool['cabin_nature'];
            elseif ($id == 22) $imagesToUse = $imgPool['apartment_city'];
            elseif ($id == 24) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 25) $imagesToUse = $imgPool['hostel'];

            // User 7 (Brasília - Moderno)
            elseif ($id == 26 || $id == 29) $imagesToUse = $imgPool['apartment_city'];
            elseif ($id == 27) $imagesToUse = $imgPool['house_modern'];
            elseif ($id == 28) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 30) $imagesToUse = $imgPool['hostel'];

            // User 8 (Recife - Histórico/Praia)
            elseif ($id == 31 || $id == 33) $imagesToUse = $imgPool['apartment_beach'];
            elseif ($id == 32) $imagesToUse = $imgPool['house_historic'];
            elseif ($id == 34) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 35) $imagesToUse = $imgPool['hostel'];

            // User 9 (Manaus - Natureza)
            elseif ($id == 36) $imagesToUse = $imgPool['cabin_nature']; // Eco lodge
            elseif ($id == 37 || $id == 38) $imagesToUse = $imgPool['apartment_city'];
            elseif ($id == 39) $imagesToUse = $imgPool['cabin_nature']; // Houseboat
            elseif ($id == 40) $imagesToUse = $imgPool['hostel'];

            // User 10 (Fortaleza - Praia)
            elseif ($id == 41 || $id == 44) $imagesToUse = $imgPool['apartment_beach'];
            elseif ($id == 42) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 43) $imagesToUse = $imgPool['house_modern'];
            elseif ($id == 45) $imagesToUse = $imgPool['hostel'];

            // User 11 (BH - Cidade)
            elseif ($id == 46 || $id == 48) $imagesToUse = $imgPool['apartment_city'];
            elseif ($id == 47) $imagesToUse = $imgPool['house_modern']; // Pampulha
            elseif ($id == 49) $imagesToUse = $imgPool['hotel_lux'];
            elseif ($id == 50) $imagesToUse = $imgPool['hostel'];
            
            // Fallback
            else $imagesToUse = $imgPool['apartment_city'];

            // Inserir as 3 imagens selecionadas para o serviço atual
            foreach ($imagesToUse as $url) {
                DB::table('services_images')->insert([
                    'service_id' => $id,
                    'image_url' => $url,
                ]);
            }
        }
    }
}
