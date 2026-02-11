<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();

        $services = [
            [
                'name' => 'The Grand Sapphire Hotel',
                'description' => 'Experience premium comfort in a central location with concierge service, refined rooms, and a rooftop lounge. Ideal for business trips and special weekends.',
                'price' => 450.00,
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Urban Minimalist Loft',
                'description' => 'A sleek downtown apartment with fast Wi‑Fi, a fully equipped kitchen, and walkable access to cafes and transit. Great for couples and remote workers.',
                'price' => 120.00,
                'image_url' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Backpacker\'s Haven Hostel',
                'description' => 'A social, budget-friendly hostel with shared lounges, a communal kitchen, and organized city meetups. Clean dorms and secure lockers included.',
                'price' => 35.00,
                'image_url' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Sunset Coastal Villa',
                'description' => 'Private villa with ocean views, a spacious terrace, and a pool for slow mornings and golden-hour sunsets. Perfect for families or groups.',
                'price' => 850.00,
                'image_url' => 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Riverside Boutique Hotel',
                'description' => 'Boutique hotel near the riverfront with curated design, artisanal breakfast, and calm rooms for restful nights. A stylish base for city exploration.',
                'price' => 210.00,
                'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Skyline Penthouse Retreat',
                'description' => 'High-floor penthouse with panoramic skyline views, open-plan living, and premium bedding. Designed for celebrations and memorable stays.',
                'price' => 520.00,
                'image_url' => 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Garden Courtyard Inn',
                'description' => 'Quiet inn with a leafy courtyard, cozy rooms, and a relaxed vibe away from the crowds. Great for couples who value calm and comfort.',
                'price' => 140.00,
                'image_url' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Old Town Studio Flat',
                'description' => 'Compact studio in the historic district with smart storage, strong water pressure, and easy access to museums and restaurants. Simple, clean, and practical.',
                'price' => 78.00,
                'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Central Station Hostel Hub',
                'description' => 'Steps from the main station with late check-in, friendly staff, and comfy dorm beds. Ideal for quick stopovers and solo travelers.',
                'price' => 29.00,
                'image_url' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Mountain View Chalet',
                'description' => 'Wooden chalet with mountain views, a fireplace, and warm interiors built for winter nights. A scenic escape for couples and small families.',
                'price' => 260.00,
                'image_url' => 'https://images.unsplash.com/photo-1518732714860-b62714ce0c59?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Seaside Bungalow Hideaway',
                'description' => 'Relaxed bungalow near the shore with breezy living spaces and a private patio. Perfect for unplugging and beach days.',
                'price' => 170.00,
                'image_url' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Downtown Business Hotel',
                'description' => 'Reliable business hotel with a desk-friendly room layout, fast Wi‑Fi, and express breakfast. Built for productivity and convenience.',
                'price' => 165.00,
                'image_url' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Art District Loft Apartment',
                'description' => 'Loft-style apartment surrounded by galleries and coffee shops, featuring high ceilings and natural light. A creative base for city stays.',
                'price' => 135.00,
                'image_url' => 'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Harborfront Resort Suite',
                'description' => 'Resort suite with waterfront access, pool amenities, and spacious rooms for longer stays. Great for families who want everything on-site.',
                'price' => 390.00,
                'image_url' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Cozy Cabin in the Pines',
                'description' => 'Rustic cabin surrounded by pine trees with a firepit and a compact kitchen. A peaceful retreat with nature at your doorstep.',
                'price' => 115.00,
                'image_url' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Lakeside Cottage Escape',
                'description' => 'Charming cottage near the lake with a porch view and a calm, slow-living atmosphere. Ideal for weekend resets and quiet mornings.',
                'price' => 190.00,
                'image_url' => 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'City Center Micro-Apartment',
                'description' => 'A smart micro-apartment with everything you need: comfy bed, compact kitchen, and a great shower. Best for solo travelers who love location.',
                'price' => 62.00,
                'image_url' => 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Rooftop Terrace Apartment',
                'description' => 'Bright apartment featuring a private rooftop terrace for sunsets, meals, and city views. Great for couples and small groups.',
                'price' => 155.00,
                'image_url' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Nomad-Friendly Hostel',
                'description' => 'Hostel designed for digital nomads with coworking corners, stable Wi‑Fi, and quiet hours at night. Social when you want it, calm when you need it.',
                'price' => 41.00,
                'image_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Historic Manor Hotel',
                'description' => 'Stay in a restored historic manor with elegant common areas and modern comfort in every room. A romantic option for heritage lovers.',
                'price' => 280.00,
                'image_url' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Minimal Scandinavian Apartment',
                'description' => 'Clean lines, bright tones, and functional design define this Scandinavian-inspired apartment. A calm, tasteful base for longer stays.',
                'price' => 110.00,
                'image_url' => 'https://images.unsplash.com/photo-1556912167-f556f1f39faa?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Family-Friendly Resort Room',
                'description' => 'Family-oriented resort room near the pool with on-site dining and easy beach access. Built for convenience with kids in mind.',
                'price' => 310.00,
                'image_url' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Hidden Alley Boutique Hostel',
                'description' => 'A small boutique hostel tucked away in a quiet alley, combining privacy with a friendly social vibe. Great value in a great location.',
                'price' => 38.00,
                'image_url' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'City Park View Apartment',
                'description' => 'Comfortable apartment facing a green city park, with natural light and a pleasant walking area nearby. Perfect for relaxed city trips.',
                'price' => 98.00,
                'image_url' => 'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Airport Express Hotel',
                'description' => 'Convenient hotel near the airport with early breakfast, soundproof rooms, and quick transport links. Ideal for layovers and early flights.',
                'price' => 130.00,
                'image_url' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Clifftop Ocean Villa',
                'description' => 'Luxury villa perched above the sea with dramatic views, outdoor dining, and a private lounge area. Designed for unforgettable escapes.',
                'price' => 920.00,
                'image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Countryside Farm Stay',
                'description' => 'Authentic farm stay with open landscapes, fresh air, and simple comforts. A grounded experience for nature lovers and slow travel.',
                'price' => 88.00,
                'image_url' => 'https://images.unsplash.com/photo-1500076656116-558758c991c1?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Modern Serviced Apartment',
                'description' => 'Serviced apartment with weekly cleaning, a practical kitchen, and a work-friendly layout. Great for business travelers on extended trips.',
                'price' => 145.00,
                'image_url' => 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Riverside Hostel & Cafe',
                'description' => 'Hostel with an on-site cafe and river walks nearby, featuring comfy beds and lively common areas. Easy to meet people and explore.',
                'price' => 33.00,
                'image_url' => 'https://images.unsplash.com/photo-1509600110300-21b9d5fedeb7?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Desert Mirage Resort',
                'description' => 'Resort-style stay with a tranquil pool, bright rooms, and a relaxing atmosphere inspired by desert tones. Perfect for rest and recharge.',
                'price' => 275.00,
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Canal-Side City Apartment',
                'description' => 'A comfortable apartment by the canal with scenic walks and easy access to landmarks. Great for travelers who love city views and calm evenings.',
                'price' => 132.00,
                'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Luxury Spa Hotel Retreat',
                'description' => 'Upscale hotel with a full spa, sauna facilities, and restful rooms designed for deep relaxation. Ideal for wellness weekends.',
                'price' => 480.00,
                'image_url' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Tiny House Getaway',
                'description' => 'A tiny house with clever design, warm lighting, and a private outdoor space. Perfect for a minimalist escape close to nature.',
                'price' => 95.00,
                'image_url' => 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Secluded Jungle Villa',
                'description' => 'Private villa surrounded by lush greenery with an open-air lounge and serene vibes. A nature-forward stay with comfort included.',
                'price' => 610.00,
                'image_url' => 'https://images.unsplash.com/photo-1540979388789-6cee28a1cdc9?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Beachfront Hostel Bunkhouse',
                'description' => 'Beachfront hostel with breezy common areas, surf-friendly storage, and a fun social atmosphere. Ideal for budget beach trips.',
                'price' => 44.00,
                'image_url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Executive Suite Hotel',
                'description' => 'Executive suite with a separate sitting area, premium linens, and a quiet environment. Built for comfort after busy days.',
                'price' => 360.00,
                'image_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Sunny Balcony Apartment',
                'description' => 'Cheerful apartment with a sunny balcony, a modern kitchen, and a welcoming living area. Perfect for morning coffee and late dinners.',
                'price' => 105.00,
                'image_url' => 'https://images.unsplash.com/photo-1554995207-c18c203602cb?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Old Harbor Guesthouse',
                'description' => 'Friendly guesthouse near the old harbor with warm hospitality and simple, tidy rooms. A great base for coastal exploring.',
                'price' => 89.00,
                'image_url' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Alpine Lodge Hotel',
                'description' => 'Alpine lodge-style hotel with wood accents, hearty breakfast, and an inviting fireplace lounge. Ideal for mountain adventures.',
                'price' => 240.00,
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'City Lights Studio Suite',
                'description' => 'Studio suite with city-light views, a comfy bed, and a practical workspace. Perfect for short stays with a modern feel.',
                'price' => 92.00,
                'image_url' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Cultural Quarter Hostel',
                'description' => 'Affordable hostel near theaters and museums with community events and comfortable dorms. Great for social travelers who love culture.',
                'price' => 31.00,
                'image_url' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Private Pool Garden Villa',
                'description' => 'Elegant villa with a private pool, garden seating, and spacious indoor living. Designed for privacy, comfort, and long sunny afternoons.',
                'price' => 780.00,
                'image_url' => 'https://images.unsplash.com/photo-1602343168117-bb8ffe3e2e9f?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Forest Edge Treehouse Stay',
                'description' => 'Unique treehouse-style stay near the forest edge with cozy lighting and a quiet, elevated view. A memorable getaway for adventurous guests.',
                'price' => 160.00,
                'image_url' => 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Marina View Hotel',
                'description' => 'Modern hotel overlooking the marina with a relaxed lounge and bright rooms. Perfect for waterfront walks and sunset dinners.',
                'price' => 205.00,
                'image_url' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Quiet Suburban Apartment',
                'description' => 'Peaceful apartment in a suburban neighborhood with easy parking and a calm atmosphere. Great for families and longer stays.',
                'price' => 84.00,
                'image_url' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Golden Dunes Beach Resort',
                'description' => 'Beach resort with lounge chairs, on-site dining, and bright rooms for effortless vacations. Great for couples and family holidays.',
                'price' => 340.00,
                'image_url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Downtown Capsule Hostel',
                'description' => 'Capsule-style hostel offering privacy on a budget, with secure storage and clean shared bathrooms. Perfect for short urban stays.',
                'price' => 27.00,
                'image_url' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Sunlit Corner Apartment',
                'description' => 'Bright corner apartment with large windows, a cozy living room, and a modern kitchen. A comfortable choice for city breaks.',
                'price' => 112.00,
                'image_url' => 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Wineries & Hills Guest Villa',
                'description' => 'Relaxing villa near rolling hills and wine country with a large patio and scenic views. Great for friends\' getaways and slow weekends.',
                'price' => 430.00,
                'image_url' => 'https://images.unsplash.com/photo-1523217582562-09d0def993a6?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Harbor Steps Hostel',
                'description' => 'Simple, friendly hostel close to the harbor with easy check-in and a cozy communal lounge. Great for budget travelers who want location.',
                'price' => 34.00,
                'image_url' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'name' => 'Royal Lantern Boutique Hotel',
                'description' => 'A refined boutique hotel with curated interiors, high-quality bedding, and excellent service. Ideal for travelers who appreciate details.',
                'price' => 255.00,
                'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1200&auto=format&fit=crop',
                'created_at' => $now, 'updated_at' => $now,
            ],
        ];

        DB::table('services')->insert($services);
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
