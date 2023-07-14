<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Uncategorized',
                'description' => 'Progetti che non rientrano in specifiche categorie, con caratteristiche uniche o sperimentali. (Projects not fitting specific categories, with unique or experimental characteristics.)',
            ],
            [
                'name' => 'Front-end',
                'description' => 'Progetti focalizzati sugli elementi visivi e l\'esperienza utente, utilizzando HTML, CSS, JavaScript. (Projects focusing on visual elements and user experience, using HTML, CSS, JavaScript.)',
            ],
            [
                'name' => 'Back-end',
                'description' => 'Progetti legati alla logica lato server, alla gestione dei dati e alla configurazione del server. (Projects related to server-side logic, data management, and server configuration.)',
            ],
            [
                'name' => 'Full stack',
                'description' => 'Progetti che coinvolgono sia lo sviluppo front-end che back-end, richiedendo una comprensione completa delle tecniche di sviluppo. (Projects involving both front-end and back-end development, requiring a comprehensive understanding of development techniques.)',
            ],
            [
                'name' => 'Sviluppo Mobile',
                'description' => 'Progetti orientati allo sviluppo di applicazioni per dispositivi mobili, utilizzando tecnologie come React Native o Swift. (Projects oriented towards developing applications for mobile devices, using technologies like React Native or Swift.)',
            ],
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
