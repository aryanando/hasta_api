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
        (NULL, 'IGD', 'Null', '56', '2024-03-18 10:47:00', NULL),
        (NULL, 'DRIVER', 'Null', '160', '2024-03-18 10:47:00', NULL),
        (NULL, 'LAUNDRY', 'Null', '219', '2024-03-18 10:47:00', NULL),
        (NULL, 'BENSAT', 'Null', '150', '2024-03-18 10:47:00', NULL),
        (NULL, 'KASIR', 'Null', '144', '2024-03-18 10:47:00', NULL),
        (NULL, 'ASOKA-KEMUNING', 'Null', '42', '2024-03-18 10:47:00', NULL),
        (NULL, 'URMIN', 'Null', '152', '2024-03-18 10:47:00', NULL),
        (NULL, 'RM', 'Null', '100', '2024-03-18 10:47:00', NULL),
        (NULL, 'LABORAT', 'Null', '122', '2024-03-18 10:47:00', NULL),
        (NULL, 'RADIOLOGI', 'Null', '128', '2024-03-18 10:47:00', NULL),
        (NULL, 'KAMAR OPERASI', 'Null', '7', '2024-03-18 10:47:00', NULL),
        (NULL, 'MELATI', 'Null', '24', '2024-03-18 10:47:00', NULL),
        (NULL, 'HCU', 'Null', '13', '2024-03-18 10:47:00', NULL),
        (NULL, 'FARMASI', 'Null', '111', '2024-03-18 10:47:00', NULL),
        (NULL, 'PERINA', 'Null', '68', '2024-03-18 10:47:00', NULL),
        (NULL, 'SATPAM', 'Null', '213', '2024-03-18 10:47:00', NULL),
        (NULL, 'KABER', 'Null', '84', '2024-03-18 10:47:00', NULL),
        (NULL, 'POLIKLINIK', 'Null', '77', '2024-03-18 10:47:00', NULL),
        (NULL, 'GIZI', 'Null', '133', '2024-03-18 10:47:00', NULL),
        (NULL, 'SIM', 'Null', '109', '2024-03-18 10:47:00', NULL),
        (NULL, 'CS', 'Null', '174', '2024-03-18 10:47:00', NULL),
        (NULL, 'MAINTENENCE', 'Null', '167', '2024-03-18 10:47:00', NULL),
        (NULL, 'HIPERBARIK', 'Null', '22', '2024-03-18 10:47:00', NULL),
        (NULL, 'CASEMIX', 'Null', '95', '2024-03-18 10:47:00', NULL),
        (NULL, 'WASINT', 'Null', '206', '2024-03-18 10:47:00', NULL);
        ");

        if ($insert) {

        }
    }
}
