<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = DB::statement("INSERT INTO `unit_translations` (`id`, `unit_name`, `unit_description`, `unit_leader_id`, `created_at`, `updated_at`) VALUES
        (NULL, 'IGD', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'DRIVER', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'LAUNDRY', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'BENSAT', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'KASIR', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'ASOKA-KEMUNING', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'URMIN', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'RM', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'LABORAT', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'RADIOLOGI', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'KAMAR OPERASI', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'MELATI', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'HCU', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'FARMASI', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'PERINA', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'SATPAM', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'KABER', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'POLIKLINIK', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'GIZI', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'SIM', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'CS', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'MAINTENENCE', 'Null', '1', '2024-03-18 10:47:00', NULL),
        (NULL, 'CASEMIX', 'Null', '1', '2024-03-18 10:47:00', NULL);
        ");

        if ($insert) {

        }
    }
}
